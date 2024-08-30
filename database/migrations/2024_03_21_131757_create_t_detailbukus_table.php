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
        Schema::create('t_detailbuku', function (Blueprint $table) {
            $table->id('f_id');
            $table->unsignedBigInteger('f_idbuku');
            $table->integer('f_stok');
            $table->foreign('f_idbuku')->references('f_id')->on('t_buku')->cascadeOnDelete();
            $table->enum('f_status', ['Tersedia', 'Tidak Tersedia']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_detailbuku');
    }
};
