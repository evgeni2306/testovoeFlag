<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['int', 'exists:orders,id'],
        ];
    }
}
