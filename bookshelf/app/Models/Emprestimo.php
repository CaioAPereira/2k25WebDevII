<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Emprestimo extends Pivot
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // CORRIGIDO: Casting para 'date' em vez de 'datetime'
        'data_emprestimo' => 'date',
    ];
}
