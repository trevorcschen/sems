<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(User::all())
                ->removeColumn('email_verified_at')
                ->addColumn('email_verified', function ($user) {
                    return $user->email_verified_at ? '1' : '0';
                })
                ->toJson();
        }

        return response()->view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|string',
            'email' => 'bail|required|email|unique:users',
            'student_id' => 'bail|required|alpha_num|unique:users',
            'ic_number' => 'bail|required|unique:users',
            'phone_number' => 'bail|required|numeric|unique:users',
            'password' => 'bail|required|min:6|confirmed',
//            'roles' => 'bail|required|exists:roles,id',
        ]);

        if ($request->has('email_verified')) {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'student_id' => $request->input('student_id'),
                'ic_number' => $request->input('ic_number'),
                'phone_number' => $request->input('phone_number'),
                'password' => Hash::make($request->input('password')),
                'email_verified_at' => now(),
            ]);
        } else {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'student_id' => $request->input('student_id'),
                'ic_number' => $request->input('ic_number'),
                'phone_number' => $request->input('phone_number'),
                'password' => Hash::make($request->input('password')),
            ]);
        }

//        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->withSuccess('User <strong>' . $user->name . '</strong> created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return response()->view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'bail|required|string',
            'email' => 'bail|required|email|unique:users,email,' . $user->id,
            'student_id' => 'bail|required|alpha_num|unique:users,student_id,' . $user->id,
            'ic_number' => 'bail|required|unique:users,ic_number,' . $user->id,
            'phone_number' => 'bail|required|numeric|unique:users,phone_number,' . $user->id,
//            'roles' => 'bail|required|exists:roles,id',
        ]);

        if ($request->has('email_verified')) {
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'student_id' => $request->input('student_id'),
                'ic_number' => $request->input('ic_number'),
                'phone_number' => $request->input('phone_number'),
                'email_verified_at' => now(),
            ]);
        } else {
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'student_id' => $request->input('student_id'),
                'ic_number' => $request->input('ic_number'),
                'phone_number' => $request->input('phone_number'),
            ]);
        }

//        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->withSuccess('User <strong>' . $user->name . '</strong> updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess('User <strong>' . $user->name . '</strong> deleted successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyMany($ids)
    {
        $userIds = explode(",", $ids);

        $deleteSuccess = User::destroy($userIds);

        if ($deleteSuccess) {
            return redirect()->route('users.index')
                ->withSuccess('Users <strong>' . implode(", ", $userIds) . '</strong> deleted successfully.');
        } else {
            return redirect()->route('users.index')
                ->with('errors', 'Users <strong>' . implode(", ", $userIds) . '</strong> failed to delete.');
        }
    }
}
