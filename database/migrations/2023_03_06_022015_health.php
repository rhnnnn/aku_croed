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
        Schema::create('health', function (Blueprint $table) {
            $table->id();
            $table->text('NAMA');
            $table->enum('KATEGORI', ['Apotek', 'Klinik', 'Rumah Sakit', 'Puskesmas']);
            $table->text('ALAMAT');
            $table->text('KOORDINAT')->nullable();
            $table->string('TEL_CUST')->nullable();
            $table->string('PIC_CUST')->nullable();
            $table->string('AM');
            $table->string('TEL_AM');
            $table->text('STO');
            $table->string('HERO');
            $table->string('TEL_HERO');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health');
    }
};
