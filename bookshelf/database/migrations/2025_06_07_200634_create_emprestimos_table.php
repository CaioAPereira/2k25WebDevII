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
        Schema::create('emprestimos', function (Blueprint $table) {
            /* Criando o campo id, chave primária */
            $table->id();

            /* Criando campos no banco relacionado aos livros */
            $table->dateTime('data_emprestimo');
            
            /* Referenciando à livro, chave estrangeira */
            $table->foreignId('livro_id')
                ->constrained('livros')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprestimos');
    }
};
