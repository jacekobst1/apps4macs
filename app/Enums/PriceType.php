<?php

declare(strict_types=1);

namespace App\Enums;

enum PriceType: string
{
    case Monthly = 'monthly';
    case Yearly = 'yearly';

    public function getStripeId(): string
    {
        if (app()->isLocal()) {
            return match ($this) {
                self::Monthly => 'price_1PihkO2K1g0VVPPwg6aerZjo',
                self::Yearly => 'price_1Pihkw2K1g0VVPPwfAmgBakm',
            };
        }

        return match ($this) {
            self::Monthly => 'todo',
            self::Yearly => 'todo',
        };
    }
}
