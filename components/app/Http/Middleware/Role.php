<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $req, Closure $next, ...$roles)
    {
        foreach($roles as $role){
            if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == $role) {
                return $next($req);
            }
        }
        return redirect()->route('login');
    }
}
