<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacancy_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Optional: Store applicant details if different from User profile, but requirements say "Form Pendaftaran Magang". 
            // Often applications need specific details not in User table.
            // "field wajib sesuai Tabel Transaksi Pendaftar" - "ID, LOWONGAN_ID, NAMA, EMAIL, NO_HP, TGL_DAFTAR, STATUS"
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp');
            // tgl_daftar is created_at
            $table->string('status')->default('P'); // P=Pending, A=Accepted, R=Rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
