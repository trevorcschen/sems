<?php

namespace App\Http\Controllers;

use App\Community;
use App\Event;
use App\User;
use App\Notifications\PeopleNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use stdClass;

class CommunityController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('permission:community.create', ['only' => ['create','store']]);
        $this->middleware('permission:community.show', ['only' => ['index', 'ajaxSearch']]);
        $this->middleware('permission:community.index', ['only' => ['index', 'ajaxIndex']]);
        $this->middleware('permission:community.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:community.delete', ['only' => ['destroy', 'destroyMany']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('super-admin')) {
            return response()->view('superadmin.communities.index');
        } elseif (Auth::user()->hasAnyRole(['community-admin', 'student'])) {
            return response()->view('student.communities.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('superadmin.communities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|string|max:80|unique:communities',
            'description' => 'bail|required|string|max:200',
            'fee' => 'bail|required|numeric|min:0',
            'max_members' => 'bail|required|numeric|min:1',
            'logo_path' => 'bail|nullable|string',
            'active' => 'bail|required|boolean',
            'admin' => 'bail|required|exists:users,id',
        ]);

        $community = Community::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'fee' => $request->input('fee'),
            'max_members' => $request->input('max_members'),
            'logo_path' => $request->input('logo_path'),
            'active' => $request->input('active'),
            'user_id' => $request->input('admin'),
        ]);

        $user = User::find($request->input('admin'));
        $user->syncRoles('community-admin');

        return redirect()->route('communities.index')
            ->withSuccess('Community <strong>' . $community->name . '</strong> created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community)
    {
        $words = preg_split("/\s+/", $community->name);
        $acronym = "";

        $i = 0;
        foreach ($words as $w) {
            if ($i == 3) break;
            $acronym .= strtoupper($w[0]);
            $i++;
        }

        if (Auth::user()->hasRole('super-admin')) {
            return response()->view('superadmin.communities.show', compact('community', 'acronym'));
        } elseif (Auth::user()->hasAnyRole(['community-admin', 'student'])) {
            return response()->view('student.communities.show', compact('community', 'acronym'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        return response()->view('superadmin.communities.edit', compact('community'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Community $community)
    {
        $request->validate([
            'name' => 'bail|required|string|max:80|unique:communities,name,' . $community->id,
            'description' => 'bail|required|string|max:200',
            'fee' => 'bail|required|numeric|min:0',
            'max_members' => 'bail|required|numeric|min:1',
            'logo_path' => 'bail|nullable|string',
            'active' => 'bail|required|boolean',
            'admin' => 'bail|required|exists:users,id',
        ]);

        if ($request->input('logo_path')) {
            Storage::delete($community->logo_path);
            $logo_path = $request->input('logo_path');
        } else {
            $logo_path = $community->logo_path;
        }

        $oldAdminId = $community->admin->id;

        $community->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'fee' => $request->input('fee'),
            'max_members' => $request->input('max_members'),
            'logo_path' => $logo_path,
            'active' => $request->input('active'),
            'user_id' => $request->input('admin'),
        ]);

        $user = User::find($request->input('admin'));
        $user->syncRoles(['community-admin']);

        $otherCommunitiesforOldAdmin = Community::where('user_id', $oldAdminId)->whereNotIn('id', array($community->id));

        if (!$otherCommunitiesforOldAdmin->exists()) {
            $oldCommunityAdmin = User::find($oldAdminId);
            $oldCommunityAdmin->syncRoles('student');
        }

        return redirect()->route('communities.index')
            ->withSuccess('Community <strong>' . $community->name . '</strong> updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        Storage::delete($community->logo_path);
        $community->delete();

        return redirect()->route('communities.index')
            ->withSuccess('Community <strong>' . $community->name . '</strong> deleted successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyMany($ids)
    {
        $communityIds = explode(",", $ids);

        foreach ($communityIds as $communityId) {
            $community = Community::find($communityId);
            Storage::delete($community->logo_path);
        }

        $deleteSuccess = Community::destroy($communityIds);

        if ($deleteSuccess) {
            return redirect()->route('communities.index')
                ->withSuccess('Communities <strong>' . implode(", ", $communityIds) . '</strong> deleted successfully.');
        } else {
            return redirect()->route('communities.index')
                ->with('errors', 'Communities <strong>' . implode(", ", $communityIds) . '</strong> failed to delete.');
        }
    }

    public function ajaxIndex(Request $request)
    {
        if ($request->ajax()) {

            $communities = Community::all();

            if ($request->input('columns.6.search.value')) {
                $fromTo = explode(" - ", $request->input('columns.6.search.value'));
                $communities = Community::where('active', true)->whereBetween('created_at', [$fromTo[0].' 00:00:00', $fromTo[1].' 23:59:59']);
            }

            return datatables()->of($communities)
                ->addColumn('admin', function ($community) {
                    return $community->admin->name;
                })
                ->editColumn('active', function ($community) {
                    return $community->active ? '1' : '0';
                })
                ->editColumn('created_at', function ($community) {
                    return $community->created_at->format('Y-m-d');
                })
                ->toJson();
        }
    }

    public function ajaxIndexPublic(Request $request)
    {
        if ($request->ajax()) {

            $communities = Community::where('active', true);

            if ($request->input('columns.5.search.value')) {
                $fromTo = explode(" - ", $request->input('columns.5.search.value'));
                $communities = Community::where('active', true)->whereBetween('created_at', [$fromTo[0].' 00:00:00', $fromTo[1].' 23:59:59']);
            }

            return datatables()->of($communities)
                ->addColumn('admin', function ($community) {
                    return $community->admin->name;
                })
                ->editColumn('active', function ($community) {
                    return $community->active ? '1' : '0';
                })
                ->editColumn('created_at', function ($community) {
                    return $community->created_at->format('Y-m-d');
                })
                ->toJson();
        }
    }

    public function ajaxSearch(Request $request)
    {
        if($request->has('q')) {
            $search = $request->input('q');

            $communities = Community::where('name','LIKE',"%$search%")
                ->orderBy('name', 'desc')
                ->paginate(5);

            return response()->json($communities, $status=200, $headers=[], $options=JSON_PRETTY_PRINT);
        }
    }

    public function join(Community $community)
    {
        $community->users()->attach(Auth::user()->id);
        return redirect()->route('communities.show', $community)->withSuccess('Community <strong>' . $community->name . '</strong> joined successfully.');
    }

    // Trevor Module
    public function communityPage($id)
    {
        $events = Event::where('community_id', $id)->where('active', 1)->where('start_time' ,'>=', Carbon::now()->toDateString('Y-m-d'))->paginate(12);
        foreach ($events as $event) {
        $event->current_participants = $event->users->count();

        $event->percentage = round($event->current_participants / $event->max_participants * 100, 0);
        }

        $count = Event::where('community_id', $id)->where('active', 1)->where('start_time' ,'>=', Carbon::now()->toDateString('Y-m-d'))->get();
        $community = Community::where('id', $id)->first();
        Session::flash('communityID', $community->id);
        return view('communityadmin.community.group', compact('events','community'))->with('count', $count->count())->with('past', false)->with('ongoing', true);
    }

    public function communityMembers(Community $community)
    {
       return view('communityadmin.community.members', compact('community'));
    }

    public function pastEventList($id)
    {
        $events = Event::where('community_id', $id)->where('active', 1)->where('start_time' ,'<', Carbon::now()->toDateString('Y-m-d'))->paginate(12);
        foreach ($events as $event) {
            $event->current_participants = $event->users->count();
            $event->percentage = round($event->current_participants / $event->max_participants * 100, 0);
        }
        $count = Event::where('community_id', $id)->where('start_time' ,'<', Carbon::now()->toDateString('Y-m-d'))->get();
        $community = Community::where('id', $id)->first();
        Session::flash('communityID', $community->id);
        return view('communityadmin.community.group', compact('events','community'))->with('count', $count->count())->with('past', true)->with('ongoing', false);
    }

    public function aJaxUpdateCom(Request $request)
    {
        if($request->get('isNewImage') == "true") {
            $base64_image = $request->get('base64URL');
            @list($type, $file_data) = explode(';', $base64_image);
            @list(, $type) = explode('/', $type);
            @list(, $file_data) = explode(',', $file_data);
            $newFileName = mt_rand().time() . '.' . $type;
            Storage::put('images/community/'. $request->get('id').'/'.$newFileName, base64_decode($file_data)); // store img locally
            $community = Community::where('id' , $request->get('id'))->first();
            $community->description = $request->get('description');
            $community->fee = (double) $request->get('fees');
            $community->max_members = $request->get('max_mem');
            if($community->isDirty()) {
                $community->logo_path = $newFileName;
                $community->update();
                $this->sendNotification($community);
                return response()->json(['status'=> '1', 'messaged' => 'received', 'isDirty' => 'true'], 200);

            } else {
                $this->sendNotification($community);
                $community->logo_path = $newFileName;
                $community->update();
                return response()->json(['status'=> '1', 'messaged' => 'received', 'isDirty' => 'false'], 200);
            }
        } else {
            $community = Community::where('id' , $request->get('id'))->first();
            $community->description = $request->get('description');
            $community->fee = (double) $request->get('fees');
            $community->max_members = $request->get('max_mem');
            if($community->isDirty()) {
                $community->update();
                Session::flash('message', "Customization on Community Details worked perfectly !!.");
                $this->sendNotification($community);
                return response()->json(['status'=> '1', 'messaged' => 'received', 'isDirty' => 'true', $community->getDirty()], 200);

            } else {
                return response()->json(['status'=> '0', 'messaged' => 'received but nothing else changed', ], 200);
            }
        }


    }

    public function sendNotification(Community $cM)
    {
        // from community master
        $community = new stdClass();
        $community->message = strip_tags($cM->name) ." just updated their policy and community details";
        $community->request = 0;
        $community->action = 0; // 0 -> no action given 1 -> action given 2 -> action performed
        $community->routing = 'commi'; // user and commi
        $community->routingID = $cM->id;
        $community->group = $cM->name;
        $community->groupID = $cM->id;
        $community->type0 = 'commi';
        $community->permit = 1; // to view the notification redirect
        Notification::send($cM->users, new PeopleNotification($community));
        event(new \App\Events\CommunityNotification($cM->name ." just updated their policy and community details", str_replace(" ", "-", strtolower($cM->name))));
    }

}
