<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (auth()->user()->role == $role) {
            return $next($request);
        }
        if (auth()->user()->role == 'admin') {
            return redirect('admin');
        } else if (auth()->user()->role == 'owner') {
            return redirect('admin/owner');
        } else {
            return redirect('user');
        }
        
    }
}
