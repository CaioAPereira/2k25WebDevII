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
            $table->id();

            // Chave estrangeira para o livro que foi emprestado
            $table->foreignId('livro_id')
                  ->constrained('livros')
                  ->onDelete('cascade');

            // Chave estrangeira para o usuário que pegou o empréstimo
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Data em que o empréstimo foi feito
            $table->date('data_emprestimo');

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
