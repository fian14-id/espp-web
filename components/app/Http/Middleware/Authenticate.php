<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (Auth::guard('petugas')->check()) {
            if (Auth::guard('petugas')->user()->level == 'admin') {
                return route('admin.dash');
            }
            return route('petugas.dash');
        }
        if (!Auth::check()) {
            return route('login');
        }
        
        // if (!$request->expectsJson()) {
        //     return route('login');
        // }
    }
}
