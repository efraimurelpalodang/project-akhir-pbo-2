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
        Schema::create('surat_jalans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('so_id')->constrained(
                table: 'sales_orders',
                indexName: 'surat_jalan_so_id'
            );
            $table->foreignId('pengguna_id')->constrained(
                table: 'penggunas',
                indexName: 'surat_jalan_pengguna_id'
            );
            $table->date('tanggal_sj');
            $table->date('tanggal_pengantaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_jalans');
    }
};
