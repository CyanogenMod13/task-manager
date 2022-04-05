<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('type');
        });

        Schema::table('assigned_users', function (Blueprint $table) {
            $table->foreignId('role_id')->references('id')->on('roles');
        });

        DB::table('roles')->insert(['type' => 'admin']);
        DB::table('roles')->insert(['type' => 'user']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assigned_users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('role_id');
        });
        Schema::dropIfExists('roles');
    }
}
