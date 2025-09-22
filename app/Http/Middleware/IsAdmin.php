<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_admin) {  // Canvia 'auth()' per 'Auth::check()' i 'Auth::user()'
            return $next($request);
        }

        return abort(403, 'Access denied');
    }
}
