<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Utils\ResponseUtil;
use App\Models\Users;

class AuthFilter
{
    /**
     * The key used to sign the JWT.
     *
     * @var string
     */
    protected $key;

    /**
     * Create a new middleware instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->key = env('JWT_SECRET'); // Your JWT secret key from .env
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return ResponseUtil::Unauthorized('Token not provided');
        }

        try {
            $decoded = JWT::decode($token, new Key($this->key, 'HS256'));
            $data = $decoded->data;

            $user = Users::getUserFromUserId($data->user_id);
            if($user && $user->role_id != $data->role_id){
                return ResponseUtil::Unauthorized('Token is not valid because role has been changed');
            }else if($user){
                $request->attributes->set('name', $user->name);
                $request->attributes->set('user_id', $user->user_id);
                $request->attributes->set('role_id', $user->role_id);
                return $next($request);
            }else{
                return ResponseUtil::Unauthorized('User does not exist anymore');
            }
        } catch (\Exception $e) {
            return ResponseUtil::Unauthorized('Token is not valid');
        }
    }
}
