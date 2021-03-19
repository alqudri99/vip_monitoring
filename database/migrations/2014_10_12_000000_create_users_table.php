<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_karyawan', 20);
            $table->unsignedInteger('id_jabatan');
            $table->string('name', 40);
            $table->string('email', 30)->unique();
            $table->string('tempat_lahir', 25);
            $table->date('tanggal_lahir');
            $table->string('no_hp', 13);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 17);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_jabatan')->references('id')->on('tb_jabatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
