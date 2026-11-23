<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Curso;
use App\Requests\CursoRequest;
use Haki\Exceptions\HttpException;
use Haki\Http\Response;

class CursoController
{

    public function listarTodos(): array
    {
        return Curso::selecionar()->obter();
    }

    public function criar(CursoRequest $request, Response $response): Response
    {

        $dados = $request->validated();

        $resultado = Curso::criar($dados);

        return $response->json(['mensagem' => 'Curso criada com sucesso!'], 200);
    }


    public function mostrarCurso(int $id, Response $response): Response
    {

        $curso = Curso::onde('id', $id)->obter();

        if (empty($curso)) {
            return $response->json([
                'mensagem' => 'Curso não encontrado!',
                'dados' => $curso,
            ], 404);
        }

        return $response->json([
            'mensagem' => 'Curso encontrado com sucesso!',
            'dados' => $curso,
        ], 200);
    }

    public function curso(int $id, Response $response): Response
    {
        $curso = Curso::buscar($id);

        if (empty($curso)) {
            return $response->json([
                'mensagem' => 'Curso não encontrado!',
                'dados' => $curso,
            ], 404);
        }

        $cursos = Curso::onde('categoria_id', $curso->$id)->obter();

        if (empty($cursos)) {
            return $response->json([
                'mensagem' => 'Nao ha curso!',
            ], 404);
        }

        return $response->json([
            'mensagem' => 'Curso encontrado com sucesso!',
            'dados' => $curso,
        ], 200);
    }

    public function atualizar(int $id, Response $response, CursoRequest $request): Response
    {
        $curso = Curso::buscar($id);

        if (empty($curso)) {
            return $response->json([
                'mensagem' => 'Curso não encontrado!',
                'dados' => $curso,
            ], 404);
        }

        $curso->preencher([
            'titulo' => $request->validated()['titulo'],
            'descricao' => $request->validated()['descricao'],
            'carga_horaria' => $request->validated()['carga_horaria'],
            'nivel' => $request->validated()['nivel']
        ]);

        $curso->salvar();

        return $response->json([
            'mensagem' => 'Curso atualizado com sucesso!',
            'dados' => $curso,
        ], 200);
    }

    public function delete(int $id, Response $response): Response
    {
        $curso = Curso::buscar($id);

        if (empty($curso)) {
            return $response->json([
                'mensagem' => 'Curso não encontrado!',
                'dados' => $curso,
            ], 404);
        }

        $curso->excluir();

        return $response->json([
            'mensagem' => 'Curso excluido com sucesso!',
            'dados' => $curso,
        ], 200);
    }
}
?>