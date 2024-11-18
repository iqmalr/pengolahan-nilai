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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa');
            $table->foreignId('mapel_id')->constrained('mata_pelajaran');
            $table->decimal('nilai', 5, 2);
            $table->date('tanggal_penilaian');
            $table->enum('jenis_penilaian', ['Ujian', 'Tugas', 'Ulangan Harian', 'UTS', 'UAS']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
