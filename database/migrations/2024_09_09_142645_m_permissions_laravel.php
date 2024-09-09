<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MPermissionsLaravel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('m_permissions_laravel', function (Blueprint $table) {
            $table->string('permission_id', 100)->primary();
            $table->string('role_id', 100);
            $table->string('function_id', 100);
            $table->integer('create_permission');
            $table->integer('read_permission');
            $table->integer('update_permission');
            $table->integer('delete_permission');
            $table->timestamp('created_dt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('created_by', 100);
            $table->timestamp('updated_dt')->nullable();
            $table->string('updated_by', 100)->nullable();

            // Foreign key constraints
            $table->foreign('role_id')->references('role_id')->on('m_roles_laravel')->onDelete('cascade');
            $table->foreign('function_id')->references('function_id')->on('m_functions_laravel')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('m_permissions_laravel');
    }
}
