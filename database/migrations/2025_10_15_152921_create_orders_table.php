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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('correlatives')->nullable();
            $table->foreignId('cod_sucursal')->constrained(); // Sucursal que pide
            $table->foreignId('user_id')->constrained(); // Gerente que registra
            $table->enum('status', ['Pendiente', 'Confirmado', 'Anulado'])->default('Pendiente');
            $table->date('order_date')->nullable();
            $table->decimal('total_amount',8,2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
