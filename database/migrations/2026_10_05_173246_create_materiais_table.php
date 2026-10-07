<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materiais', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nome');
            $table->text('descricao')->nullable();

            $table->foreignId('id_categoria')
                ->constrained('categorias');

            $table->foreignId('id_localizacao')
                ->constrained('localizacoes');

            $table->integer('quantidade')->default(0);
            $table->integer('quantidade_disponivel')->default(0);
            $table->integer('quantidade_minima')->default(0);

            $table->string('estado')->default('Disponível');
            $table->string('tipo_material')->nullable();

            $table->string('foto')->nullable();
            $table->string('qr_code')->nullable();

            $table->date('data_cadastro')->nullable();
            $table->date('atualizado_em')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materiais');
    }
};