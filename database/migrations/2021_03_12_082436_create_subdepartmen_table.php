<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubdepartmenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subdepartmens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_depart')->unsigned()->default(0);
            $table->string('name_subdepart', 120);
            $table->unsignedSmallInteger('priori_sub')->default(0);
            $table->timestamps();

            $table->foreign('id_depart')->references('id')->on('departmens')->
            onDelite('restrict')->onUpdate('restrict');    

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
        Schema::dropIfExists('subdepartmen');
    }
}
