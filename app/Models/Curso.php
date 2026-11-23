<?php

namespace App\Models;
use Elo\Modelo;


class Curso extends Modelo{

    protected bool $exclusaoLogica = true;
    
    protected array $pertenceA = [
        'categorias' => Categoria::class
    ];

    protected array $ocultos = ['excluido_em'];
}