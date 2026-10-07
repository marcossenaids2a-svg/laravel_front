<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('itens_emprestimo', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_emprestimo')
                ->constrained('emprestimos')
                ->onDelete('cascade');

            $table->foreignId('id_material')
                ->constrained('materiais');

            $table->integer('quantidade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('itens_emprestimo');
    }
};