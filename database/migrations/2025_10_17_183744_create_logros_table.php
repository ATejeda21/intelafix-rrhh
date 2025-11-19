<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleado_id')->constrained('empleados')->onDelete('cascade');
            $table->string('tipo'); // 'Positivo' o 'Negativo'
            $table->text('descripcion');
            $table->date('fecha_ocurrencia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logros');
    }
};