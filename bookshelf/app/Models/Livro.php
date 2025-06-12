<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // <-- IMPORTAR!
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'autor',
        'data_publicacao',
        'genero',
        'image',
        // Note que 'user_id' não está aqui, para evitar que seja modificado acidentalmente.
    ];

    protected $casts = [
        'items' => 'array',
        'data_publicacao' => 'date',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // Dentro da classe Livro, adicione o método `users`:
    // Dentro da classe Livro, atualize o método `users`:
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'emprestimos')
            ->using(Emprestimo::class) // <-- Diz para usar o nosso pivot model
            ->withPivot('data_emprestimo')
            ->withTimestamps();
    }
}
