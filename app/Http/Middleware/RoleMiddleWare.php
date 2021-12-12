<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// use App\Models\User;

class RoleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next , $role)
    {

        // if (!$request()->user()->userHasRole($role)) {
        //     abort(404, 'you are not authorized');
        // }
        // return $next($request);

        
        if ( !$request->user()->userHasRole($role)) {
            abort(403, 'you are not authorized');
        }

        return $next($request);


    }


}
