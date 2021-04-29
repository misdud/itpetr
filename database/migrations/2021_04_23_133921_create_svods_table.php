<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSvodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('svods', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned()->default(0);

                $table->string('post', 200)->index();  
                $table->string('info', 7000)->default('н\д');  

                $table->foreign('user_id')->references('id')->on('users')->
                onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('svods');
    }
}
