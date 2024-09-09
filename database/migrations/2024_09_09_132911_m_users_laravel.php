<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MUsersLaravel extends Migration
{

    public function up()
    {
        Schema::create('m_users_laravel', function (Blueprint $table) {
            $table->string('user_id', 100)->primary();
            $table->string('role_id', 100);
            $table->string('nip', 20);
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('phone', 15);
            $table->string('password', 255);
            $table->timestamp('created_dt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('created_by', 100);
            $table->timestamp('updated_dt')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->integer('status')->default(1);
            $table->text('photo');

            // Foreign key constraint
            $table->foreign('role_id')->references('role_id')->on('m_roles_laravel')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_users_laravel');
    }
}
