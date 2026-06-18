<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckFirstAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->must_change_password) {
            if(!$request->routeIs('password.change', 'password.update-first', 'logout')) {
                return redirect()->route('password.change')
                ->with('warning', 'Por favor, altere sua senha no primeiro acesso');
            };
        } 
    
        return $next($request);
    }
}
