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
        Schema::create('transaksi_penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->constrained(
                table: 'penggunas',
                indexName: 'tp_pengguna_id'
            );
            $table->foreignId('so_id')->constrained(
                table: 'sales_orders',
                indexName: 'tp_sales_order'
            );
            $table->date('tanggal_transaksi');
            $table->date('tanggal_antar');
            $table->decimal('total_harga', 15, 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_penjualans');
    }
};
