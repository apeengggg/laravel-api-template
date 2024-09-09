<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $primaryKey = "user_id";
    protected $fillable = [
        "user_id", "role_id", "nip", "name", "email", "phone", "password", "status", "photo",
        "created_dt", "created_by", "updated_dt", "updated_by"
    ];
}
