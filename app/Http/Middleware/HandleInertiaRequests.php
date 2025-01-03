<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request)
    {   
        $user = $request->user()? Auth::user(): null;
        // $permissions = $request->user()? $user->getAllPermissions() : null;
        // return response()->json($request->user()->with(['permissions']));
        // dd($request->user()->with(['permissions'])->toArray());
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user,
                'permissions' => $user? $user->roles[0]->permissions : null,
                
            ],
        ];
    }
}
