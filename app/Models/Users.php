<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    protected $primaryKey = "user_id";
    protected $fillable = [
        "user_id", "role_id", "nip", "name", "email", "phone", "password", "status", "photo",
        "created_dt", "created_by", "updated_dt", "updated_by"
    ];

    public static function getUserFromEmail($email){
        return DB::table('m_users_laravel as u')
        ->join('m_roles_laravel as r', 'u.role_id', '=', 'r.role_id')
        ->select('u.user_id', 'u.name', 'u.email', 'u.password', 'u.role_id', 'r.role_name', 'u.photo')
        ->where('u.email', $email)
        ->first();
    } 

    public static function getUserFromUserId($user_id){
        return DB::table('m_users_laravel as u')
        ->join('m_roles_laravel as r', 'u.role_id', '=', 'r.role_id')
        ->select('u.user_id', 'u.name', 'u.email', 'u.password', 'u.role_id', 'r.role_name', 'u.photo')
        ->where('u.user_id', $user_id)
        ->first();
    } 
}
