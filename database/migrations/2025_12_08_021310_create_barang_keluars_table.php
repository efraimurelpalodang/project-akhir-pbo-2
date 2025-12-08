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
        Schema::create('barang_keluars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->constrained(
                table: 'penggunas',
                indexName: 'bk_pengguna_id'
            );
            $table->foreignId('so_id')->constrained(
                table: 'sales_orders',
                indexName: 'bk_so_id'
            );
            $table->date('tanggal_keluar');
            $table->enum('asal_transaksi', ['penjualan','rusak']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluars');
    }
};
