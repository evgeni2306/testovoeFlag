<?php

declare(strict_types=1);

namespace App\Enums;

enum TypesOfPaymentEnum: string
{
    case Visa = 'Visa';
    case Mastercard = 'Mastercard';
    case Mir = 'Mir';
}
