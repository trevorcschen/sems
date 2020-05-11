<?php

namespace App\Http\Controllers;

use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VenueController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:venue.create', ['only' => ['create','store']]);
        $this->middleware('permission:venue.show', ['only' => ['index','show', 'ajaxIndex', 'ajaxSearch']]);
        $this->middleware('permission:venue.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:venue.delete', ['only' => ['destroy', 'destroyMany']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (Auth::user()->hasRole('super-admin')) {
            return response()->view('superadmin.venues.index');
//        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('superadmin.venues.create');
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
            'name' => 'bail|required|string|max:80|unique:venues',
            'description' => 'bail|required|string|max:200',
            'capacity' => 'bail|required|numeric|min:1',
            'air_conditioned' => 'bail|required|boolean',
            'active' => 'bail|required|boolean',
            'venue_image_path' => 'bail|nullable|string',
        ]);

        $venue = Venue::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'capacity' => $request->input('capacity'),
            'air_conditioned' => $request->input('air_conditioned'),
            'active' => $request->input('active'),
            'venue_image_path' => $request->input('venue_image_path'),
        ]);

        return redirect()->route('venues.index')
            ->withSuccess('Venue <strong>' . $venue->name . '</strong> created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        $words = preg_split("/\s+/", $venue->name);
        $acronym = "";

        $i = 0;
        foreach ($words as $w) {
            if ($i == 3) break;
            $acronym .= strtoupper($w[0]);
            $i++;
        }

        return response()->view('superadmin.venues.show', compact('venue', 'acronym'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function edit(Venue $venue)
    {
        return response()->view('superadmin.venues.edit', compact('venue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue)
    {
        $request->validate([
            'name' => 'bail|required|string|max:80|unique:venues,name,' . $venue->id,
            'description' => 'bail|required|string|max:200',
            'capacity' => 'bail|required|numeric|min:1',
            'air_conditioned' => 'bail|required|boolean',
            'active' => 'bail|required|boolean',
            'venue_image_path' => 'bail|nullable|string',
        ]);

        if ($request->input('venue_image_path')) {
            Storage::delete($venue->venue_image_path);
            $venue_image_path = $request->input('venue_image_path');
        } else {
            $venue_image_path = $venue->venue_image_path;
        }

        $venue->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'capacity' => $request->input('capacity'),
            'air_conditioned' => $request->input('air_conditioned'),
            'active' => $request->input('active'),
            'venue_image_path' => $venue_image_path,
        ]);

        return redirect()->route('venues.index')
            ->withSuccess('Venue <strong>' . $venue->name . '</strong> updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue)
    {
        Storage::delete($venue->venue_image_path);
        $venue->delete();

        return redirect()->route('venues.index')
            ->withSuccess('Community <strong>' . $venue->name . '</strong> deleted successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyMany($ids)
    {
        $venueIds = explode(",", $ids);

        foreach ($venueIds as $venueId) {
            $venue = Venue::find($venueId);
            Storage::delete($venue->venue_image_path);
        }

        $deleteSuccess = Venue::destroy($venueIds);

        if ($deleteSuccess) {
            return redirect()->route('venues.index')
                ->withSuccess('Venues <strong>' . implode(", ", $venueIds) . '</strong> deleted successfully.');
        } else {
            return redirect()->route('venues.index')
                ->with('errors', 'Venues <strong>' . implode(", ", $venueIds) . '</strong> failed to delete.');
        }
    }

    public function ajaxIndex(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Venue::all())
                ->toJson();
        }
    }

    public function ajaxSearch(Request $request)
    {
        if($request->has('q')) {
            $search = $request->input('q');

            $venues = Venue::where('name','LIKE',"%$search%")
                ->orderBy('name', 'desc')
                ->paginate(5);

            return response()->json($venues, $status=200, $headers=[], $options=JSON_PRETTY_PRINT);
        }
    }
}
