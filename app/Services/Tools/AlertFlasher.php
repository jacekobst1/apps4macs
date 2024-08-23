<?php

declare(strict_types=1);

namespace App\Services\Tools;

final readonly class AlertFlasher
{
    public static function success(string $text = 'Success'): void
    {
        session()->flash('alertSuccess', $text);
    }
}
