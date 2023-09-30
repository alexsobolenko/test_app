<?php

declare(strict_types=1);

namespace App\Enum;

enum Status: string
{
    case NEW = 'new';
    case PENDING = 'pending';
    case OK = 'ok';
    case FAIL = 'fail';
}
