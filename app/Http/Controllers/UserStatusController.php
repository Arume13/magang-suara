<?php

namespace App\Http\Controllers;

use App\Models\UserStatus;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userStatuses = UserStatus::all();
        return response()->json($userStatuses);
        return Inertia::render('UserStatus/Index', [
            'userStatuses' => $userStatuses,
        ]);
    }

    public function activate($id)
    {
        $userStatus = UserStatus::find($id);
        if ($userStatus) {
            $userStatus->active = 1; // Set to active
            $userStatus->save();
            return redirect()->back()->with('message', 'User  activated successfully.');
        }
        return redirect()->back()->with('error', 'User  not found.');
    }

    // Deactivate a user
    public function in_activate($id)
    {
        $userStatus = UserStatus::find($id);
        if ($userStatus) {
            $userStatus->active = 0; // Set to inactive
            $userStatus->save();
            return redirect()->back()->with('message', 'User  in-activated successfully.');
        }
        return redirect()->back()->with('error', 'User  not found.');
    }

    // Get user status
    public function getStatus($id)
    {
        $userStatus = UserStatus::find($id);
        if ($userStatus) {
            return response()->json(['active' => $userStatus->active]);
        }
        return response()->json(['message' => 'User  not found.'], 404);
    }
}
