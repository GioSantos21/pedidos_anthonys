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
       Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->string('name')->nullable();
        $table->string('description')->nullable();
        $table->string('unit')->nullable();
        $table->decimal('cost', 8, 2)->nullable(); // Costo de producción (opcional, para reportes internos)
        $table->enum('status',['Activo','Inactivo'])->default('Activo');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
