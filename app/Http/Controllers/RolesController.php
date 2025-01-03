<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role ::all();
        // return response ()->json($roles);
        return Inertia :: render ('Roles/Index', [
            'role' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get();
        return Inertia :: render ('Roles/Create', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $roles = new Role;
        $roles->name = $request->input('name');
        $roles->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permissions = Permission::query()->get();
        $roles = Role::query()->where('id', '=', $id)->with('permissions')->firstOrFail();
        // return response()->json($permissions);
        return Inertia::render ('Roles/Edit', [
            'role' => $roles,
            'permission' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $roles = Role::query()->where('id', '=', $id)->firstOrFail();
        $request->validate([
            'name' => 'required|string|max:255',
            'permission_id' => 'required'
        ]);
        $roles->name = $request->name;
        $roles->syncPermissions([$request->permission_id]);
        $roles->save();
        return redirect()->route('roles.index')->with('success', 'User  updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
