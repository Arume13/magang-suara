<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AvatarController extends Controller
{
    public function index()
    {
        $users = User::all();
        return Inertia::render('Avatars/Index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('avatar')->store('avatars', 'public');

        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar' => $path,
        ]);

        return redirect()->route('avatars.index');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('avatars.index');
    }

    public function destroy(User $user)
    {
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('avatars.index');
    }
}