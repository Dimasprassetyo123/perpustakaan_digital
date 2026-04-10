<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            // 🔹 PRIMARY KEY
            $table->id('id_anggota');

            // 🔹 DATA ANGGOTA
            $table->string('nama_anggota');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->text('alamat');

            // 🔹 FOTO
            $table->string('image')->nullable();

            // 🔹 RELASI KE USERS
            $table->unsignedBigInteger('id_user');

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');

            // 🔹 DEFAULT BATAS PINJAM (opsional)
            $table->integer('max_pinjam')->default(3);

            // 🔹 TIMESTAMP
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
