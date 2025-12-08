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
        Schema::create('barang_masuk_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bm_id')->constrained(
                table: 'barang_masuks',
                indexName: 'bm_detail_bm_id'
            );
            $table->foreignId('barang_id')->constrained(
                table: 'barangs',
                indexName: 'bm_detail_barang_id'
            );
            $table->integer('jumlah_masuk', unsigned: true);
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk_details');
    }
};
