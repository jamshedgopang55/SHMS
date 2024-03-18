<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('employee')->check()) {
            // User is logged in as an employee
            return $next($request);
        }

        // Redirect to employee login route if not logged in as an employee
        return redirect()->route('employee.login');
    }
}
