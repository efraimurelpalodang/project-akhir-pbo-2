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
        Schema::create('barang_keluar_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bk_id')->constrained(
                table: 'barang_keluars',
                indexName: 'bk_detail_bk_id'
            );
            $table->foreignId('barang_id')->constrained(
                table: 'barangs',
                indexName: 'bk_detail_barang_id'
            );
            $table->integer('jumlah_keluar', unsigned: true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar_details');
    }
};
