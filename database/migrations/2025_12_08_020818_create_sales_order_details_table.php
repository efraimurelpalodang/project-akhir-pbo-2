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
        Schema::create('sales_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('so_id')->constrained(
                table: 'sales_orders',
                indexName: 'so_detail_so_id'
            );
            $table->foreignId('barang_id')->constrained(
                table: 'barangs',
                indexName: 'so_detail_barang_id'
            );
            $table->integer('jumlah', unsigned: true);
            $table->decimal('harga_satuan', 15,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_order_details');
    }
};
