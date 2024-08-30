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
        Schema::create('t_detailpeminjaman', function (Blueprint $table) {
            $table->id('f_id');
            $table->unsignedBigInteger('f_idpeminjaman');
            $table->foreign('f_idpeminjaman')->references('f_id')->on('t_peminjaman')->cascadeOnDelete();
            $table->unsignedBigInteger('f_iddetailbuku');
            $table->foreign('f_iddetailbuku')->references('f_id')->on('t_detailbuku')->cascadeOnDelete();
            $table->date('f_tanggalkembali')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_detailpeminjaman');
    }
};
