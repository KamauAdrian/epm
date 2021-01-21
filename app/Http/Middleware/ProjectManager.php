<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectManager
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
            $user_role = Auth::user()->role->name;
            if ($user_role != 'Project Manager'){
                return redirect('/');
            }
            return $next($request);
        }
        return redirect('/');
    }
}
