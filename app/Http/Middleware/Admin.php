<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(Auth::check()) { //proverava da li je user logovan
            if(Auth::user()->isAdmin()) { //metod koji vraca logovanog usera
                return $next($request);
            }
        }

        return redirect('/');
    }
}
