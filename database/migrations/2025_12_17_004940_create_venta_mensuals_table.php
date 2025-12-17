<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ingresos_ventas', function (Blueprint $table) {
            $table->id();

            $table->date('fecha_venta');
            $table->string('nombre_cliente', 250);

            $table->enum('tipo_cliente', ['NACIONAL', 'EXTRANJERO']);
            $table->enum('forma_pago', ['DEBITO', 'CREDITO', 'EFECTIVO']);

            $table->decimal('importe', 10, 2);

            $table->unsignedSmallInteger('anio');
            $table->unsignedTinyInteger('mes');

            $table->boolean('archivado')->default(false);

            $table->string('usuario_creacion', 9)->default('sys');
            $table->string('usuario_actualizacion', 9)->default('sys');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingresos_ventas');
    }
};