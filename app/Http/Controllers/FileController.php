<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $path = Storage::putFile('images', $request->file('file'));
        return response()->json(['url'=>Storage::url($path), 'logo_path'=>$path]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        if ($request->input('logo_path')) {
            Storage::delete($request->input('logo_path'));
            return response()->json(['success'=>'true']);
        }
    }
}
