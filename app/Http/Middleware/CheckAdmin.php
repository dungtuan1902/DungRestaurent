<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check() && in_array(Auth::guard('admin')->user()->role_id, [7, 8, 9]) && in_array(Auth::guard('admin')->user()->department_id, [14, 15, 16, 17, 18])) {
            return $next($request);
        } else {
            notify()->error('You do not have access');
            return redirect()->route('admin.login');
        }
    }
}
