<?php

namespace App\Models;

use Elo\Modelo;


class Categoria extends Modelo
{

    protected array $temMuitos = [
        'curso' => Curso::class
    ];

    protected array $ocultos = ['excluido_em'];
}
