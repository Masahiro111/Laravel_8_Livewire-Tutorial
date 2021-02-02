<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EnsureUserRoleIsAllowedToAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        echo 'The middleware for access role <br>';

        $userRole = auth()->user()->role;
        $currentRouteName = Route::currentRouteName();

        echo 'UserRole: ' . $userRole . '<br>';
        echo 'Current Route Name: ' . $currentRouteName . '<br>';


        return $next($request);
    }
}
