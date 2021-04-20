<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectwinccProjecttiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectwincc_projecttia', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('projectwincc_id')->unsigned()->default(0);
            $table->foreign('projectwincc_id')->references('id')->on('projectwinccs')->
            onDelete('restrict')->onUpdate('restrict');

            $table->integer('projecttia_id')->unsigned()->default(0);
            $table->foreign('projecttia_id')->references('id')->on('projecttias')->
                    onDelite('restrict')->onUpdate('restrict');

            $table->string('info_controller', 1500)->default('н\д');        


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
        Schema::dropIfExists('projectwincc_projecttia');
    }
}
