<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsDetailsOwnedByLoggingUser
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
        $loggedUser = Auth::user();
        $defaultPermissionErrorMsg = ['http_error'=>API_RES_STATUS_UNAUTHORIZED];
        $has_access = false;
        if($request->route('user_id') == $loggedUser->id){
            $has_access = true;
        }
        if($has_access == false){
            return response(['data'=>$defaultPermissionErrorMsg],API_RES_STATUS_SUCCESS)->header('Content-Type', 'application/json');
        }
        return $next($request);
    }
}
