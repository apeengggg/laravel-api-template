<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Utils\ResponseUtil;

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
            return ResponseUtil::Unauthorized(null, 'Token not provided');
        }

        try {
            $decoded = JWT::decode($token, new Key($this->key, 'HS256'));
            dd($decoded);

            $request->attributes->set('user_id', $decoded->user_id);

            return $next($request);
        } catch (\Exception $e) {
            return ResponseUtil::Unauthorized(null, 'Token is not valid');
        }
    }
}
