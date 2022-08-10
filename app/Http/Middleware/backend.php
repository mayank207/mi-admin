<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Models\User;
use Illuminate\Http\Request;

class backend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(Session::has('user_email')){

            $user  = User::where(['status'=>1,'role_id'=>1,'email'=>Session::get('user_email')])->first();
            if($user!='null'){
                return $next($request);
            }
        }

        return redirect('backend/login');
        abort(403);

    }
}
