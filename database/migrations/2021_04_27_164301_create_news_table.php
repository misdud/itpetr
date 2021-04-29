<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned()->default(0);

                $table->string('news_post', 200)->index();  
                $table->string('news_info', 7000)->default('н\д');
                $table->boolean('news_activ')->default(0);  

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
        Schema::dropIfExists('news');
    }
}
