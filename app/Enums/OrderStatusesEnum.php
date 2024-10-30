<?php

declare(strict_types=1);

namespace App\Enums;
enum OrderStatusesEnum: string
{
    case Awaiting = 'Awaiting';
    case Paid = 'Paid';
    case Cancelled = 'Cancelled';
}
