<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman');

            $table->unsignedBigInteger('id_buku');
            $table->unsignedBigInteger('id_anggota');
            $table->unsignedBigInteger('id_petugas')->nullable();

            $table->date('tanggal_pinjam');
            $table->date('wajib_kembali');
            $table->date('tanggal_kembali')->nullable();

            // 🔥 PENTING: VARCHAR (BEBAS ERROR)
            $table->string('status', 50);

            $table->timestamps();

            // 🔗 RELASI
            $table->foreign('id_buku')->references('id_buku')->on('buku')->cascadeOnDelete();
            $table->foreign('id_anggota')->references('id_anggota')->on('anggota')->cascadeOnDelete();
            $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
