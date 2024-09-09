<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Permissions;
use App\Utils\ResponseUtil;
use App\Utils\PermissionUtil;
use Illuminate\Support\Facades\Hash;
use App\Utils\JwtUtil;

class AuthController extends Controller
{

    protected $jwtUtil;

    public function __construct(JwtUtil $jwtUtil)
    {
        $this->jwtUtil = $jwtUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //
        try{
            $results = Users::getUserFromEmail($request->email);
            if($results == null){
                return ResponseUtil::Unauthorized(null, "Login failed, either your User Id isn't registered in our system or your password is incorrect");
            }

            $compare = Hash::check($request->password, $results->password);
            if(!$compare){
                return ResponseUtil::Unauthorized(null, "Login failed, either your User Id isn't registered in our system or your password is incorrect");
            }

            $permission = Permissions::getPermissionById($results->role_id);
            // echo $permission;
            if(!$permission){
                return ResponseUtil::Unauthorized(null, "Login failed, either your User Id isn't registered in our system or your password is incorrect");
            }

            $object_permission = PermissionUtil::createObjectPermission($permission);

            $results = [
                'user_id' => $results->user_id,
                'name' => $results->name,
                'foto_profile' => $results->photo,
                'role_id' => $results->role_id,
                'role_name' => $results->role_name,
                'permission' => $object_permission,
                'token' => $this->jwtUtil->generateToken($results->user_id, $results->role_id),
            ];


            return ResponseUtil::Ok(null, "Successfully Get Users", $results);
        }catch(\Exception $e){
            return ResponseUtil::InternalServerError(null, $e);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
