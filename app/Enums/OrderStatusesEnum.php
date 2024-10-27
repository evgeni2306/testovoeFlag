<?php

namespace App\Enums;
enum OrderStatusesEnum: string
{
    case Awaiting = 'Awaiting';
    case Paid = 'Paid';
    case Cancelled = 'Cancelled';
}
