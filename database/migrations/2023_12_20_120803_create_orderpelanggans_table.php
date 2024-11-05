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
        Schema::create('orderpelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_order');
            $table->string('nama_pelanggan')->nullable();
            $table->string('alamat_pelanggan')->nullable();
            $table->string('no_telp_pelanggan')->nullable();

            // user_id
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderpelanggans');
    }
};
