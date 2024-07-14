<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {

        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role_id; 
        
            switch ($role) {
               case 1:
                 return redirect('/panel/dashboard');
                 break;
               case 2:
                 return redirect('/');
                 break;
               case 3:
                  return redirect('/panel/dashboard');
                  break;
               case 4:
                  return redirect('/panel/dashboard');
                  break;
               default:
                 return redirect('/'); 
                 break;
            }
          }
          return $next($request);
    }
}
