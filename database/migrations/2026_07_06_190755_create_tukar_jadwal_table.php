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
        Schema::create('tukar_jadwal', function (Blueprint $table) {
            $table->id();

            // mahasiswa yang mengajukan
            $table->unsignedBigInteger('user_id');

            // jadwal yang ingin ditukar
            $table->unsignedBigInteger('jadwal_awal_id');

            // jadwal pengganti yang dipilih
            $table->unsignedBigInteger('jadwal_pengganti_id');

            $table->text('alasan');

            $table->enum('status', [
                'Pending',
                'Disetujui',
                'Ditolak'
            ])->default('Pending');

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('jadwal_awal_id')
                ->references('id')
                ->on('jadwal_piket')
                ->onDelete('cascade');

            $table->foreign('jadwal_pengganti_id')
                ->references('id')
                ->on('jadwal_piket')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tukar_jadwal');
    }
};
