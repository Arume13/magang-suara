<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controller as BaseController;
use Spatie\Permission\Models\Permission;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('permission:show-user|edit-user|delete-user', ['only' => ['index','show']]);
        $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }
    
    // Display a listing of users
    public function index()
    {
        $users = User::query()->with(['status','roles'])->paginate(5);
        // return response()->json($users);
        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    // Show the form for creating a new user
    public function create()
    {
        $status = UserStatus::get();
        // dd($status);
        return Inertia::render('Users/Create', [
            'status' => $status,
        ]);
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_status_id' => 'required',
        ]);


        $users = new User;
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = bcrypt($request->input('password'));
        $users->user_status_id = $request->user_status_id;

        // Handle the avatar upload

        if ($request->hasFile('avatar')) {
            // Store the avatar and get the path
            $path = $request->file('avatar')->store('avatars', 'public');
            $users->avatar = $path; // Save the path to the avatar in the user record
        }
        // Save the user to the database
        $users->save();

        return redirect()->route('users.index')->with('success', 'User  created successfully.');
    }

    // Display the specified user
    public function show($id)
    {   
        // Retrieve the user by ID or fail with a 404 error if not found
        $user = User::findOrFail($id);
        $status = UserStatus::get();
        return Inertia::render('Users/Show', [
            'user' => $user,
            'status' => $status,
        ]);
    }

    // Show the form for editing the specified user
    public function edit($id)
    {
        $roles = Role::query()->get();
        $permission = Permission::query()->get();
        // return response()->json($permission);
        $user = User::query()->with('roles')->where('id', '=', $id)->firstOrFail();
        $status = UserStatus::get();
        return Inertia::render('Users/Edit', [
            'user' => $user,
            'status' => $status,
            'roles' => $roles,
            'permission' => $permission
        ]);
    }

    // Update the specified user in storage
    public function update(Request $request, $id)
    {
        $user = User::query()->where('id', '=', $id)->firstOrFail();
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'user_status_id' => 'required',
            'role_id' => 'required',
            'permission_id' => 'required'
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }
        $password = $request->password;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_status_id = $request->user_status_id;
        if ($password) {
            $user->password = bcrypt($password);
        }
        $user->save();
        $user->syncRoles([$request->role_id]);
        $user->syncPermissions([$request->permission_id]);
        return redirect()->route('users.index')->with('success', 'User  updated successfully.');
    }

    // Remove the specified user from storage
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User  deleted successfully.');
    }

    //export and import data

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,csv,xls']);
        Excel::import(new UsersImport, $request->file('file'));
        return back()->with('success', 'Users imported successfully.');
    }
}
