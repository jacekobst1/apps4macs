<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Facades\App;

enum Coupon
{
    case FirstMonthOneDollar;

    public function getStripeId(): string
    {
        // TEST
        if (!App::isProduction()) {
            return match ($this) {
                self::FirstMonthOneDollar => 'wFXghcPS',
            };
        }

        // LIVE
        return match ($this) {
            self::FirstMonthOneDollar => 'xsmiIghe',
        };
    }
}
