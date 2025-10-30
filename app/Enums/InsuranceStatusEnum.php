<?php

namespace App\Enums;

/**
 * Insurance states
 */
enum InsuranceStatusEnum: string
{
    case Pending  = 'pending';
    case Active   = 'active';
    case Canceled = 'canceled';
    case Expired  = 'expired';
}
