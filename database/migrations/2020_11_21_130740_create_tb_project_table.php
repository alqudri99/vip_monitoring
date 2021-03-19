<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_project', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_site');
            $table->string('activity_name', 30);
            $table->string('methode', 30);
            $table->enum('qc_status', ['Closed', 'Waiting']);
            $table->date('tanggal_mulai');
            $table->date('acceptance_date');
            $table->timestamps();

            $table->foreign('id_site')->references('id')->on('tb_site');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_project');
    }
}
