<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_usuario')
                ->constrained('usuarios');

            $table->dateTime('data_emprestimo');
            $table->dateTime('data_devolucao')->nullable();

            $table->string('status')->default('ativo');
            $table->text('observacao')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emprestimos');
    }
};