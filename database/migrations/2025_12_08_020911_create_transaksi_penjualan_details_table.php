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
        Schema::create('transaksi_penjualan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained(
                table: 'transaksi_penjualans',
                indexName: 'tp_detail_transaksi_id'
            );
            $table->foreignId('barang_id')->constrained(
                table: 'barangs',
                indexName: 'tp_detail_barang_id'
            );
            $table->integer('jumlah', unsigned: true);
            $table->decimal('harga_satuan', 15, 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_penjualan_details');
    }
};
