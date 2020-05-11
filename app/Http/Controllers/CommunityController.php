<?php

namespace App\Http\Controllers;

use App\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommunityController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:community.create', ['only' => ['create','store']]);
        $this->middleware('permission:community.show', ['only' => ['index','show', 'ajaxIndex', 'ajaxSearch']]);
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
//        if (Auth::user()->hasRole('super-admin')) {
            return response()->view('superadmin.communities.index');
//        }
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

        return response()->view('superadmin.communities.show', compact('community', 'acronym'));
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

        $community->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'fee' => $request->input('fee'),
            'max_members' => $request->input('max_members'),
            'logo_path' => $logo_path,
            'active' => $request->input('active'),
            'user_id' => $request->input('admin'),
        ]);

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

            if ($request->input('columns.4.search.value')) {
                $fromTo = explode(" - ", $request->input('columns.4.search.value'));
                $communities = Community::whereBetween('created_at', [$fromTo[0], $fromTo[1]]);
            }

            return datatables()->of($communities)
                ->addColumn('admin', function ($community) {
                    return $community->admin->name;
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
}
