<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            // ❌ JANGAN tambah tanggal_kembali lagi (sudah ada)

            // ✅ hanya tambah denda
            if (!Schema::hasColumn('peminjaman', 'denda')) {
                $table->integer('denda')->default(0)->after('tanggal_kembali');
            }

        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            if (Schema::hasColumn('peminjaman', 'denda')) {
                $table->dropColumn('denda');
            }

        });
    }
};
