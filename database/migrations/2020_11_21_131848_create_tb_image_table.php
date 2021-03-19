<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_image', function (Blueprint $table) {
            $table->increments('id', 6);
            $table->unsignedInteger('project_id');
            $table->string('image_link');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('tb_project');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_image');
    }
}
