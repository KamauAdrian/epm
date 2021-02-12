<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreatePassword
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
        $id = $request->route('id');
//        $user = DB::table('users')->where('id',$id)->first();
        $user = User::find($id);
        if($user && $user->password==null){
            return $next($request);
        }elseif($user && $user->password!=null){
            Auth::logout();
            return redirect('/');
        }else{
            return redirect('/')->with('error','Sorry User Not Recognized');
        }

    }
}
