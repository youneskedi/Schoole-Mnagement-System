<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use function GuzzleHttp\default_user_agent;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role ;
            switch ($role){
                case 'admin':
                    return redirect('/admin/dashboard');
                    break;
                case 'student':
                    return redirect('/student/dashboard');
                    break;
                case 'teacher':
                    return redirect('/teacher/dashboard');
                default :
                    return redirect('/');
                    break;
            }
        }
        return $next($request);
    }
}
