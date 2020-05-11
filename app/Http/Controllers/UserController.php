<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user.create', ['only' => ['create','store']]);
        $this->middleware('permission:user.show', ['only' => ['index','show', 'ajaxIndex', 'ajaxSearch']]);
        $this->middleware('permission:user.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user.delete', ['only' => ['destroy', 'destroyMany']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (Auth::user()->hasRole('super-admin')) {
            return response()->view('superadmin.users.index');
//        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return response()->view('superadmin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|string|max:80',
            'email' => 'bail|required|email|unique:users',
            'student_id' => 'bail|required|alpha_num|unique:users',
            'ic_number' => 'bail|required|unique:users',
            'phone_number' => 'bail|required|numeric|unique:users',
            'biography' => 'bail|required|string|max:200',
            'profile_image_path' => 'bail|nullable|string',
            'password' => 'bail|required|min:16|confirmed',
            'role' => 'bail|required|exists:roles,id',
            'active' => 'bail|required|boolean',
        ]);

        $email_verified_at = $request->has('email_verified') ? now() : null;

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'student_id' => $request->input('student_id'),
            'ic_number' => $request->input('ic_number'),
            'phone_number' => $request->input('phone_number'),
            'biography' => $request->input('biography'),
            'profile_image_path' => $request->input('profile_image_path'),
            'password' => Hash::make($request->input('password')),
            'active' => $request->input('active'),
            'email_verified_at' => $email_verified_at,
        ]);

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
        return response()->view('superadmin.users.show', compact('user'));
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
        return response()->view('superadmin.users.edit', compact('user', 'roles'));
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
            'name' => 'bail|required|string|max:80',
            'email' => 'bail|required|email|unique:users,email,' . $user->id,
            'student_id' => 'bail|required|alpha_num|unique:users,student_id,' . $user->id,
            'ic_number' => 'bail|required|unique:users,ic_number,' . $user->id,
            'phone_number' => 'bail|required|numeric|unique:users,phone_number,' . $user->id,
            'biography' => 'bail|required|string|max:200',
            'profile_image_path' => 'bail|nullable|string',
            'password' => 'bail|nullable|min:16|confirmed',
            'role' => 'bail|required|exists:roles,id',
            'active' => 'bail|required|boolean',
        ]);

        if ($request->input('profile_image_path')) {
            Storage::delete($user->profile_image_path);
            $profile_image_path = $request->input('profile_image_path');
        } else {
            $profile_image_path = $user->profile_image_path;
        }

        $password = $request->input('password') ? Hash::make($request->input('password')) : $user->password;

        $email_verified_at = $request->input('email_verified') ? now() : null;

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'student_id' => $request->input('student_id'),
            'ic_number' => $request->input('ic_number'),
            'phone_number' => $request->input('phone_number'),
            'biography' => $request->input('biography'),
            'profile_image_path' => $profile_image_path,
            'password' => $password,
            'active' => $request->input('active'),
            'email_verified_at' => $email_verified_at,
        ]);

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
        Storage::delete($user->profile_image_path);
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

        foreach ($userIds as $userId) {
            $user = User::find($userId);
            Storage::delete($user->profile_image_path);
        }

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
