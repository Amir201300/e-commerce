<?php

namespace App\Http\Middleware;

use Closure,Auth;

class checkRole
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
        if( Auth::guard('Admin')->user() === null){
       return redirect('/manage/login');
        }

        $actions=$request->route()->getAction();
        $roles=isset($actions['roles']) ? $actions['roles']: null;


        if(Auth::guard('Admin')->user()->hasAnyRole($roles) || !$roles){

        return $next($request);

        }
        
       return redirect('/manage/login');


    }
}
