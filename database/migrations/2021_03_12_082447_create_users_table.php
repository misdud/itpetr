<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('depart_id')->unsigned()->default(0);
            $table->integer('subdepart_id')->unsigned()->default(0);
            $table->integer('position_id')->unsigned()->default(0);
            $table->string('fio_full',60)->index();
            $table->string('login', 10)->unique();
            $table->string('password', 120);
            $table->string('tel_belki', 30)->default('н\д');
            $table->string('tel_mob', 30)->default('н\д');
            $table->string('room', 20)->default('н\д');
            $table->date('dr')->default('20210101');
            $table->smallInteger('prioritet')->default(0); //-------для фильтрации при сортировке вывода
            $table->boolean('activ')->default(0); 
            $table->boolean('itr')->default(0);
            $table->boolean('show_manager')->default(0); //для вкладки руководства

            $table->foreign('depart_id')->references('id')->on('departmens')->
            onDelite('restrict')->onUpdate('restrict');
            
            $table->foreign('subdepart_id')->references('id')->on('subdepartmens')->
            onDelite('restrict')->onUpdate('restrict');
            
            $table->foreign('position_id')->references('id')->on('positions')->
            onDelite('restrict')->onUpdate('restrict');   

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
