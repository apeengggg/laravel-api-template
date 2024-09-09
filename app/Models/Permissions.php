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

    public static function getPermissionByFunctionAndRoleId($function_id, $role_id){
        return DB::table('m_permissions_laravel as p')
        ->join('m_functions_laravel as f', 'f.function_id', '=', 'p.function_id')
        ->select('p.create_permission as allowCreate',
                    'p.read_permission as allowRead',
                    'p.update_permission as allowUpdate',
                    'p.delete_permission as allowDelete',
                    'p.function_id',
                    'f.function_name'
        )
        ->where('p.role_id', $role_id)
        ->where('p.function_id', $function_id)
        ->first();
    }
}
