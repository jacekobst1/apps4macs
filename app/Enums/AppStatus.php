<?php

declare(strict_types=1);

namespace App\Enums;

enum AppStatus: string
{
    case Submitted = 'submitted';
    case Accepted = 'accepted';
    case Rejected = 'rejected';
}
