<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permissions extends Model
{
    use HasFactory;

    protected $primaryKey = 'permission_id';
    protected $fillable = ['permission_id', 'role_id', 'function_id', 'created_permission', 'read_permission', 'updated_permission', 'delete_permission', 'created_dt', 'created_at', 'updated_dt', 'updated_at'];

    public static function getPermissionById($id){
        $data = DB::table('m_functions_laravel as f')
        ->leftJoin('m_permissions_laravel as p', 'f.function_id', '=', 'p.function_id')
        ->select('f.function_id', 'f.function_name', 'f.parent_function_id', 'create_permission', 'read_permission', 'update_permission', 'delete_permission')
        ->where('p.role_id', $id)
        ->orWhere('f.parent_function_id', NULL)
        ->get();

        return $data;
    }
}
