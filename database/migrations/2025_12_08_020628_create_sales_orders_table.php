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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained(
                table: 'transaksi_penjualans',
                indexName: 'so_transaksi_id'
            );
            $table->foreignId('pengguna_id')->constrained(
                table: 'penggunas',
                indexName: 'so_pengguna_id'
            );
            $table->date('tanggal_so');
            $table->enum('status', ['menunggu','siap dikirim', 'dikirim']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
