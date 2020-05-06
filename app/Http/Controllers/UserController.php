<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return response()->view('users.create', compact('roles'));
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
            'password' => 'bail|required|min:16|confirmed',
            'role' => 'bail|required|exists:roles,id',
            'active' => 'bail|required|boolean',
        ]);

        if ($request->has('email_verified')) {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'student_id' => $request->input('student_id'),
                'ic_number' => $request->input('ic_number'),
                'phone_number' => $request->input('phone_number'),
                'password' => Hash::make($request->input('password')),
                'active' => $request->input('active'),
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
                'active' => $request->input('active'),
            ]);
        }

        $user->syncRoles($request->input('role'));

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
        $roles = Role::all('id', 'name');
        return response()->view('users.edit', compact('user', 'roles'));
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
            'password' => 'bail|nullable|min:16|confirmed',
            'role' => 'bail|required|exists:roles,id',
            'active' => 'bail|required|boolean',
        ]);

        $password = empty($request->input('password')) ? $user->password : Hash::make($request->input('password'));

        if ($request->has('email_verified')) {
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'student_id' => $request->input('student_id'),
                'ic_number' => $request->input('ic_number'),
                'phone_number' => $request->input('phone_number'),
                'password' => $password,
                'active' => $request->input('active'),
                'email_verified_at' => now(),
            ]);
        } else {
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'student_id' => $request->input('student_id'),
                'ic_number' => $request->input('ic_number'),
                'phone_number' => $request->input('phone_number'),
                'password' => $password,
                'active' => $request->input('active'),
            ]);
        }

        $user->syncRoles($request->input('role'));

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

    public function ajaxIndex(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(User::all())
                ->removeColumn('email_verified_at')
                ->addColumn('role', function ($user) {
                    if(!empty($user->getRoleNames())) {
                        return $user->getRoleNames()[0];
                    }
                })
                ->addColumn('email_verified', function ($user) {
                    return $user->email_verified_at ? '1' : '0';
                })
                ->toJson();
        }
    }

    public function ajaxSearch(Request $request)
    {
        if($request->has('q')) {
            $search = $request->input('q');

            $users = User::where('name','LIKE',"%$search%")
                ->orderBy('name', 'desc')
                ->paginate(5);

            return response()->json($users, $status=200, $headers=[], $options=JSON_PRETTY_PRINT);
        }
    }
}
