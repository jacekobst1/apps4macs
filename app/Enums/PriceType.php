<?php

declare(strict_types=1);

namespace App\Enums;

enum PriceType: string
{
    case Monthly = 'monthly';
    case Yearly = 'yearly';

    public function getStripeId(): string
    {
        return match ($this) {
            self::Monthly => 'abc',
            self::Yearly => 'def',
        };
    }
}
