<?php

namespace App\Http\Controllers;

use App\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('venues.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('venues.create');
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
            'name' => 'bail|required|string|unique:venues',
            'capacity' => 'bail|required|numeric|min:1',
        ]);

        $venue = Venue::create([
            'name' => $request->input('name'),
            'capacity' => $request->input('capacity'),
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
        return response()->view('venues.show', compact('venue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function edit(Venue $venue)
    {
        return response()->view('venues.edit', compact('venue'));
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
            'name' => 'bail|required|string|unique:venues',
            'capacity' => 'bail|required|numeric|min:1',
        ]);

        $venue->update([
            'name' => $request->input('name'),
            'capacity' => $request->input('capacity'),
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
}
