<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class admin_teacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check())
            return redirect('/home');

        $user = Auth::user();
        if($user->role == 'admin' || $user->role=='teacher')
            return $next($request);

        abort(403, 'You do not have permission to access this resource.');
    }
}
