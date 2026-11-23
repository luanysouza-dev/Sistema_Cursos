<?php

declare(strict_types=1);

use App\Controllers\CategoriasController;
use App\Controllers\CursoController;
use App\Controllers\HomeController;
use Haki\Haki;


$app->get('/', [HomeController::class, 'index']);


$app->group('/categorias', function (Haki $app){
    $app->post('/', [CategoriasController::class, 'criar']);
    $app->get('/', [CategoriasController::class, 'listarTodos']);
    $app->get('/{id}', [CategoriasController::class, 'mostrarCategoria']);
    $app->get('/{id}/curso', [CategoriasController::class, 'curso']);
    $app->put('/{id}', [CategoriasController::class, 'atualizar']);
    $app->delete('/{id}', [CategoriasController::class, 'delete']);
});

$app->group('/cursos', function (Haki $app){
    $app->post('/', [CursoController::class, 'criar']);
    $app->get('/', [CursoController::class, 'listarTodos']);
    $app->get('/{id}', [CursoController::class, 'mostrarCurso']);
    $app->get('/{id}/curso', [CursoController::class, 'curso']);
    $app->put('/{id}', [CursoController::class, 'atualizar']);
    $app->delete('/{id}', [CursoController::class, 'delete']);
});
