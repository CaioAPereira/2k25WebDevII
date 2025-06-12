<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;

/*Rota que Encaminha para Raiz*/
Route::get('/', [LivroController::class, 'index']);
/*Rota que Encaminha para Inserção de Livro*/
Route::get('/livros/create', [LivroController::class, 'create'])->middleware(
    'auth'
);
/*Rota que Encaminha para amostragem de livro específico*/
Route::get('/livros/{id}', [LivroController::class, 'show']);
/*Rota que Encaminha para DashBoard*/
Route::get('/dashboard', [LivroController::class, 'dashboard'])->middleware(
    'auth'
);

// Rota para cadastrar um livro
Route::post('/livros', [LivroController::class, 'store']);

// Rota para deletar um livro
Route::delete('/livros/{id}', [LivroController::class, 'destroy']);

// Rota para mostrar o formulário de edição
Route::get('/livros/edit/{id}', [LivroController::class, 'edit'])->name(
    'livros.edit'
);

// Rota para processar a atualização do livro
Route::put('/livros/update/{id}', [LivroController::class, 'update'])->name(
    'livros.update'
);

Route::middleware(['auth'])->group(function () {
    Route::post('/livros/emprestar/{id}', [
        LivroController::class,
        'emprestarLivro',
    ])->name('livros.emprestar');
    Route::delete('/livros/devolver/{id}', [
        LivroController::class,
        'devolverLivro',
    ])->name('livros.devolver');
});
