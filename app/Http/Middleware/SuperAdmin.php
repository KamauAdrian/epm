<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
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
            $user = Auth::user();
            if ($user->role->name != 'Su Admin'){
                return redirect('/');
            }
            return $next($request);
        }
        else{
            return redirect('/');
        }

    }
}
