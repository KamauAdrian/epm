<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $logged_in = Auth::check();
        if ($logged_in){
            $admin = Auth::user();
            if ($admin->is_admin == 1 && $admin->role_id != 0){
                return $next($request);
            }
        }else{
            return redirect('/');
        }


    }
}
