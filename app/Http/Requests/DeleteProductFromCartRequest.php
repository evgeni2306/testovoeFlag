<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProductFromCartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['int', 'exists:products,id'],
        ];
    }
}
