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
        // 🔹 Tabel USERS
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user'); // primary key custom
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->enum('role', ['anggota', 'petugas', 'kepala']);

            // pakai timestamps biar fleksibel
            $table->timestamps();
        });

        // 🔹 Tabel PASSWORD RESET
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 🔹 Tabel SESSIONS
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();

            // relasi ke users (id_user)
            $table->unsignedBigInteger('user_id')->nullable()->index();

            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();

            // foreign key
            $table->foreign('user_id')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // urutan dibalik biar aman
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
