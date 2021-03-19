<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_site', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_bts');
            $table->string('site_name', 30);
            $table->unsignedInteger('id_kecamatan');
            $table->timestamps();

            $table->foreign('id_bts')->references('id')->on('tb_data_bts');
            $table->foreign('id_kecamatan')->references('id')->on('tb_kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_site');
    }
}
