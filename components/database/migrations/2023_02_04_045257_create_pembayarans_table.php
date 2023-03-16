<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->uuid('id_pembayaran')->primary();
            $table->uuid('id_petugas');
            $table->string('nisn', 10);
            $table->date('tgl_bayar');
            $table->json('bulan_dibayar');
            $table->string('tahun_dibayar', 4);
            $table->uuid('id_spp');
            $table->integer('jumlah_bayar');
            $table->string('status')->nullable();
            $table->string('metode')->nullable();
            $table->string('order_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
