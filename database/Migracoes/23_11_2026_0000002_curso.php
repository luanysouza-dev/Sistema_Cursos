<?php

use Elo\Coluna;
use Elo\Migracao;
use Elo\Tabela;

return new class extends Migracao{

    public function subir(): void
    {
        Tabela::criar('cursos',[
            'categoria_id' => Coluna::pertenceA('categorias')->aoExcluir('RESTRICT')->indice(),
            'titulo' => Coluna::texto(100),
            'descricao' => Coluna::textoLongo(),
            'carga_horaria' => Coluna::inteiro()->padrao(0),
            'nivel'=> Coluna::texto(100),
        ],[
            'exclusao_logica' => true
        ]);
    }

    public function descer(): void
    {
        Tabela::apagar('cursos');
    }
}

?>