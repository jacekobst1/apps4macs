<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Facades\App;

enum PriceType: string
{
    case Monthly = 'monthly';
    case Yearly = 'yearly';

    public function isMonthly(): bool
    {
        return $this === self::Monthly;
    }

    public function getStripeId(): string
    {
        // TEST
        if (!App::isProduction()) {
            return match ($this) {
                self::Monthly => 'price_1PihkO2K1g0VVPPwg6aerZjo',
                self::Yearly => 'price_1Pihkw2K1g0VVPPwfAmgBakm',
            };
        }

        // LIVE
        return match ($this) {
            self::Monthly => 'price_1Pignj2K1g0VVPPwAULjCHcd',
            self::Yearly => 'price_1PignK2K1g0VVPPwx3wqmity',
        };
    }
}
