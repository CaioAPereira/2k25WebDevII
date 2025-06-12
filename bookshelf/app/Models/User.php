<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // <-- IMPORTAR!
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Pega todos os livros cadastrados pelo usuário.
     */
    public function livros(): HasMany
    {
        return $this->hasMany(Livro::class);
    }

    /**
     * Os livros que este usuário participa (emprestou).
     */
    public function livrosAsParticipant(): BelongsToMany
    {
        return $this->belongsToMany(Livro::class, 'emprestimos')
            ->using(Emprestimo::class) // <-- Diz para usar o nosso pivot model
            ->withPivot('data_emprestimo')
            ->withTimestamps();
    }
}
