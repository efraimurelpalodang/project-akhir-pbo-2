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
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->constrained(
                table: 'penggunas',
                indexName: 'bm_pengguna_id'
            );
            $table->date('tanggal_masuk');
            $table->enum('asal_barang', ['pembelian', 'return']);
            $table->text('keterangan');
            $table->decimal('harga', 15, 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};
