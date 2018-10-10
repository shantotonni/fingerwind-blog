<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  \Optional  $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {

        If(!App('Illuminate\Contracts\Auth\Guard')->guest())
        {
            If($request->user()->can_access($permission))
            {
                #exit("can access");
                return $next($request);
            }else{

                #exit("not authorized");
                return response(view('user::user.unauthorized')->render());
            }
        }

        return $next($request);


    }


}
