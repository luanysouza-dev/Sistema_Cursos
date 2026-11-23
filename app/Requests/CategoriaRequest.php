<?php

declare(strict_types=1);

namespace App\Requests;

use Haki\Validation\FormRequest;
use Haki\Validation\Rule;

final class CategoriaRequest extends FormRequest
{
    public function rules(Rule $rule): array
    {
        return [
            'nome' => $rule->text()->length(3, 80),
            'descricao' => $rule->text()->length(max:255)->optional(),
            'ativo' => $rule->boolean()->optional(true),
        ];
    }
}
