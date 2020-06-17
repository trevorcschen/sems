<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        return response()->view('profiles.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return response()->view('profiles.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'bail|required|string|max:80',
            'email' => 'bail|required|email|unique:users,email,' . $user->id,
            'student_id' => 'bail|required|alpha_num|unique:users,student_id,' . $user->id,
            'ic_number' => 'bail|required|unique:users,ic_number,' . $user->id,
            'phone_number' => 'bail|required|numeric|unique:users,phone_number,' . $user->id,
            'biography' => 'bail|required|string|max:200',
            'profile_image_path' => 'bail|nullable|string',
            'password' => 'bail|nullable|min:16|confirmed',
        ]);

        if ($request->input('profile_image_path')) {
            Storage::delete($user->profile_image_path);
            $profile_image_path = $request->input('profile_image_path');
        } else {
            $profile_image_path = $user->profile_image_path;
        }

        $password = $request->input('password') ? Hash::make($request->input('password')) : $user->password;

        $successString = '';
        if ($request->input('email') == $user->email) {
            $email_verified_at = $user->email_verified_at;
        } else {
            $email_verified_at = null;
            //resend confimation email
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'student_id' => $request->input('student_id'),
            'ic_number' => $request->input('ic_number'),
            'phone_number' => $request->input('phone_number'),
            'biography' => $request->input('biography'),
            'profile_image_path' => $profile_image_path,
            'password' => $password,
            'email_verified_at' => $email_verified_at,
        ]);

        return redirect()->route('profiles.show')
            ->withSuccess('Profile updated successfully.');
    }
}
