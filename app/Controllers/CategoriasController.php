<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Categoria;
use App\Models\Curso;
use App\Requests\CategoriaRequest;
use Haki\Exceptions\HttpException;
use Haki\Http\Response;

class CategoriasController
{

    public function listarTodos(): array
    {
        return Categoria::selecionar()->obter();
    }

    public function criar(CategoriaRequest $request, Response $response): Response
    {

        $dados = $request->validated();

        $resultado = Categoria::criar($dados);

        return $response->json(['mensagem' => 'Categoria criada com sucesso!'], 200);
    }


    public function mostrarCategoria(int $id, Response $response): Response
    {

        $categoria = Categoria::onde('id', $id)->obter();

        if (empty($categoria)) {
            return $response->json([
                'mensagem' => 'Categoria não encontrada!',
                'dados' => $categoria,
            ], 404);
        }

        return $response->json([
            'mensagem' => 'Categoria encontrada com sucesso!',
            'dados' => $categoria,
        ], 200);
    }

    public function curso(int $id, Response $response): Response
    {
        $categoria = Categoria::buscar($id);

        if (empty($categoria)) {
            return $response->json([
                'mensagem' => 'Curso dessa categoria não encontrada!',
                'dados' => $categoria,
            ], 404);
        }

        $cursos = Curso::onde('categoria_id', $categoria->$id)->obter();

        if (empty($cursos)) {
            return $response->json([
                'mensagem' => 'Nao ha cursos para essa categoria!',
            ], 404);
        }

        return $response->json([
            'mensagem' => 'Curso de uma Categoria encontrada com sucesso!',
            'dados' => $cursos,
        ], 200);
    }

    public function atualizar(int $id, Response $response, CategoriaRequest $request): Response
    {
        $categoria = Categoria::buscar($id);

        if (empty($categoria)) {
            return $response->json([
                'mensagem' => 'Categoria não encontrada!',
                'dados' => $categoria,
            ], 404);
        }

        $categoria->preencher([
            'nome' => $request->validated()['nome'],
            'descricao' => $request->validated()['descricao'],
            'ativo' => $request->validated()['ativo']
        ]);

        $categoria->salvar();

        return $response->json([
            'mensagem' => 'Categoria atualizada com sucesso!',
            'dados' => $categoria,
        ], 200);
    }

    public function delete(int $id, Response $response): Response
    {
        $categoria = Categoria::buscar($id);

        $cursos = Curso::buscarPor("categoria_id", $id);
        
        if (empty($categoria)) {
            return $response->json([
                'mensagem' => 'Categoria não encontrada!',
                'dados' => $categoria,
            ], 404);
        }

        if ($cursos != null) {
            throw new HttpException(409, 'A categoria tem curso e não pode ser excluida.');
        }

        $categoria->excluir();

        return $response->json([
            'mensagem' => 'Categoria excluida com sucesso!',
            'dados' => $categoria,
        ], 200);
    }
}
