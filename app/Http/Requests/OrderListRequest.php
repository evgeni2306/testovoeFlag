<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\OrderStatusesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class OrderListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'sort_type' => ['string', 'ends_with:asc,desc'],
            'status_filter' => [new Enum(OrderStatusesEnum::class)],
        ];
    }
}
