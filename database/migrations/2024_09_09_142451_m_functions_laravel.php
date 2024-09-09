<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MFunctionsLaravel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('m_functions_laravel', function (Blueprint $table) {
            $table->string('function_id', 100)->primary();
            $table->string('function_name', 50);
            $table->string('parent_function_id', 100);
            $table->timestamp('created_dt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('created_by', 100);
            $table->timestamp('updated_dt');
            $table->string('updated_by', 100);
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
        Schema::dropIfExists('m_functions_laravel');
    }
}
