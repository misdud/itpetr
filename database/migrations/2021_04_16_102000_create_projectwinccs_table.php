<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectwinccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectwinccs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name_otdelenie');          
            $table->string('name_project');
            $table->string('name_controller', 5000);
            $table->string('create_project');
            $table->string('map_project');
            $table->string('tel_project');
            $table->string('info_project');

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
        Schema::dropIfExists('projects');
    }
}
