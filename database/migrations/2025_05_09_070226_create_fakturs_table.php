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
        Schema::create('fakturs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_faktur');
            $table->string('kode_customer');
            $table->date('tanggal_faktur');
            $table->foreignId('customer_id')->constrained('customers', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('keterangan_faktur')->nullable();
            $table->double('total');
            $table->double('nominal_charge');
            $table->double('charge');
            $table->double('total_final');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakturs');
    }
};
