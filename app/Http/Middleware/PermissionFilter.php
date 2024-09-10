<?php

namespace App\Http\Middleware;

use App\Models\Permissions;
use Closure;
use Illuminate\Http\Request;
use App\Utils\ResponseUtil;

class PermissionFilter
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
        $function_id = $request->header('FUNCTION_ID');

        $user_id = $request->attributes->get('user_id');
        $role_id = $request->attributes->get('role_id');

        if($user_id && $role_id && $user_id != "" && $role_id != ""){
            $permission = Permissions::getPermissionByFunctionAndRoleId($function_id, $role_id);

            $method = $request->method();
            $hasAccess = false;
            if($permission){
                if($method === 'GET' && $permission->allowRead == 1){
                    $hasAccess = true;
                }else if($method === 'POST' && $permission->allowCreate == 1){
                    $hasAccess = true;
                    
                }else if($method === 'PUT' && $permission->allowUpdate == 1){
                    $hasAccess = true;
                    
                }else if($method === 'DELETE' && $permission->allowDelete == 1){
                    $hasAccess = true;
                }
            }

            if(!$hasAccess || !$permission){
                return ResponseUtil::Forbidden('Access Denied');
            }
        }else{
            return ResponseUtil::Forbidden('Access Denied');
        }

        return $next($request);
    }
}