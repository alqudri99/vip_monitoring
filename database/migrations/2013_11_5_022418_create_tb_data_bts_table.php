<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbDataBtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_data_bts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_bts', 25);
            $table->string('rbs_type', 15);
            $table->string('type_ru', 20);
            $table->string('company', 40);
            $table->string('tac', 10);
            $table->string('ci', 10);
            $table->string('ip_address', 15);
            $table->string('frekuensi', 10);
            $table->string('band', 10);
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
        Schema::dropIfExists('tb_data_bts');
    }
}
