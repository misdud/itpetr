<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjecttiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projecttias', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('organization',150);
            $table->string('name',150);
            $table->string('fio_dev',120)->default('н\д');
            $table->string('tel_dev', 50)->default('н\д');
            $table->string('ip', 18);
            $table->string('room_set', 50)->default('н\д');
            $table->string('info', 1000)->default('н\д');
            
            $table->collation = 'utf8mb4_unicode_ci';
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projecttias');
    }
}
