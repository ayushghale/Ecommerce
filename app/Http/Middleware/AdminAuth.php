<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('adminLogin')) {

            $user = User::find($request->session()->get('adminLogin'));

            if ($user->role == 1) {
                return $next($request);
            } else {
                return redirect()->route('admin.login');
            }

        }

        return redirect()->route('admin.login');
    }
}
