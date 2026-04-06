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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman');

            $table->unsignedBigInteger('id_petugas')->nullable();
            $table->unsignedBigInteger('id_buku');
            $table->unsignedBigInteger('id_anggota');

            $table->date('tanggal_pinjam');
            $table->date('wajib_kembali');
            $table->date('tanggal_kembali')->nullable();

            $table->enum('status', [
                'menunggu',
                'dipinjam',
                'ditolak',
                'menunggu_pengembalian',
                'dikembalikan',
                'terlambat'
            ])->default('menunggu');

            $table->timestamps();

            // Foreign key constraints (opsional, jika tabel terkait ada)
            // $table->foreign('id_petugas')->references('id')->on('petugas')->onDelete('set null');
            // $table->foreign('id_buku')->references('id')->on('bukus')->onDelete('cascade');
            // $table->foreign('id_anggota')->references('id')->on('anggotas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
