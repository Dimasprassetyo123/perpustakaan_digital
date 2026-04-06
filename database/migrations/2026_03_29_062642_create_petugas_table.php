<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetugasTable extends Migration
{
    public function up(): void
{
    Schema::create('petugas', function (Blueprint $table) {
        $table->id('id_petugas');
        $table->string('nama_petugas');
        $table->string('jenis_kelamin');
        $table->date('tanggal_lahir');
        $table->text('alamat');
        $table->string('email')->unique();
        $table->unsignedBigInteger('id_user')->nullable();
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('petugas');
    }
}
