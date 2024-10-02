<?php

declare(strict_types=1);

namespace App\Enums;

use App\Traits\ArrayableEnumeration;

enum RoleEnum: int
{
    use ArrayableEnumeration;

    case GUEST = 0;
    case USER = 1;
    case MASTER = 2;
    case SUDO = 3;
    case ROOT = 4;
    case DEVELOPER = 5;
    case ADMINISTRATOR = 6;
    case MODERATOR = 7;
}
