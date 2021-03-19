<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCrewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_crew', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_project');
            $table->unsignedInteger('id_user');
            $table->timestamps();
            $table->foreign('id_project')->references('id')->on('tb_project');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_crew');
    }
}
