<?php

declare(strict_types=1);

namespace App\Requests;

use Haki\Validation\FormRequest;
use Haki\Validation\Rule;

final class CursoRequest extends FormRequest
{
    public function rules(Rule $rule): array
    {
        return [
            'categoria_id' => $rule->integer(),
            'titulo' => $rule->text()->length(5, 120),
            'descricao' => $rule->text()->length(min:10),
            'carga_horaria' => $rule->integer(),
            'nivel' => $rule->text()
        ];
    }
}
