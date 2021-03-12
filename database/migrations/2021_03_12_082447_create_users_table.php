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
            $table->integer('id_depart')->unsigned()->default(0);
            $table->integer('id_subdepart')->unsigned()->default(0);
            $table->integer('id_position')->unsigned()->default(0);
            $table->string('fio_full',60)->index();
            $table->string('login', 10)->unique();
            $table->string('passwd', 20);
            $table->string('tel_belki', 20);
            $table->string('tel_mob', 20);
            $table->string('room', 9);
            $table->date('dr')->default('20210101');
            $table->smallInteger('prioritet'); //-------для фильтрации при сортировке вывода
            $table->boolean('activ')->default(0); 
            $table->boolean('itr')->default(0);
            $table->boolean('show_manager')->default(0); //для вкладки руководства

            $table->foreign('id_depart')->references('id')->on('departmens')->
            onDelite('restrict')->onUpdate('restrict');
            
            $table->foreign('id_subdepart')->references('id')->on('subdepartmens')->
            onDelite('restrict')->onUpdate('restrict');
            
            $table->foreign('id_position')->references('id')->on('positions')->
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
