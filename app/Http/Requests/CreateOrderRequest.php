<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\TypesOfPaymentEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payment_type' => [new Enum(TypesOfPaymentEnum::class)],
        ];
    }
}
