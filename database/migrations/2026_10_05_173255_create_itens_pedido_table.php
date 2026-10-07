<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('itens_pedido', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_pedido')
                ->constrained('pedidos')
                ->onDelete('cascade');

            $table->foreignId('id_material')
                ->constrained('materiais');

            $table->integer('quantidade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('itens_pedido');
    }
};