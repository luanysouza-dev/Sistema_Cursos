<?php

use Elo\Coluna;
use Elo\Migracao;
use Elo\Tabela;

return new class extends Migracao{

    public function subir(): void
    {
        Tabela::criar('categorias',[
            'nome' => Coluna::texto(100),
            'descricao' => Coluna::textoLongo(),
            'ativo' => Coluna::booleano()->padrao(true),
        ],[
            'exclusao_logica' => true
        ]);
    }

    public function descer(): void
    {
        Tabela::apagar('categorias');
    }
}

?>