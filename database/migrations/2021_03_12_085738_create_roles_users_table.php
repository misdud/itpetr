<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_users', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('id_role')->unsigned()->default(0);
            $table->foreign('id_role')->references('id')->on('roles')->
            onDelete('restrict')->onUpdate('restrict');

            $table->integer('id_user')->unsigned()->default(0);
            $table->foreign('id_user')->references('id')->on('users')->
                    onDelite('restrict')->onUpdate('restrict');


            $table->timestamps();
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_users');
    }
}
