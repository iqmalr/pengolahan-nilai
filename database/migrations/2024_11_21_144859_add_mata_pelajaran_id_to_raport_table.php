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
        Schema::table('raport', function (Blueprint $table) {
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raport', function (Blueprint $table) {
            $table->dropForeign(['mata_pelajaran_id']);
            $table->dropColumn('mata_pelajaran_id');
        });
    }
};
