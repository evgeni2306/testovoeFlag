<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetProductListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'sort_type' => ['string', 'ends_with:asc,desc'],
        ];
    }
}
