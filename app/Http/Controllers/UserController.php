<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    // Display a listing of users
    public function index()
    {
        $users = User::query()->paginate(5);
        // return response()->json($users);
        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    // Show the form for creating a new user
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $users= new User;
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = bcrypt($request->input('password'));
        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password),
        // ]);

        return redirect()->route('users.index')->with('success', 'User  created successfully.');
    }

    // Display the specified user
    public function show(User $user)
    {
        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => $user,
        ]);
    }

    // Update the specified user in storage
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $password = $request->password;
        // $user->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => $request->password ? bcrypt($request->password) : $user->password,
        // ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($password) {
            $user->password = bcrypt($password);
        }
        $user->save();
        return redirect()->route('users.index')->with('success', 'User  updated successfully.');
    }

    // Remove the specified user from storage
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User  deleted successfully.');
    }
}