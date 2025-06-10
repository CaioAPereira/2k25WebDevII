<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;

Route::get('/', [LivroController::class, 'index']);
Route::get('/livros/create', [LivroController::class, 'create'])->middleware('auth');
Route::get('/livros/{id}', [LivroController::class, 'show']);
Route::post('/livros', [LivroController::class, 'store']);
Route::delete('/livros/{id}', [LivroController::class, 'destroy']);
Route::get('/livros/edit/{id}', [LivroController::class, 'edit'])->middleware(
    'auth'
);
Route::put('/livros/update/{id}', [
    LivroController::class,
    'update',
])->middleware('auth');

Route::get('/dashboard', [LivroController::class, 'dashboard'])->middleware(
    'auth'
);

Route::post('/livros/join/{id}', [
    LivroController::class,
    'joinLivro',
])->middleware('auth');

Route::delete('/livros/leave/{id}', [
    LivroController::class,
    'leaveLivro',
])->middleware('auth');

/*
Route::get('produtos/', function () {

    $busca = request('search');

    return view('/produtos', ['busca' => $busca]);
});

Route::get('produtos_teste/{id?}', function ($id = null) {

    return view('/product', ['id' => $id]);
});
*/
