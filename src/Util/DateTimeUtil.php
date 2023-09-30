<?php

declare(strict_types=1);

namespace App\Util;

final class DateTimeUtil
{
    /**
     * @return \DateTimeImmutable
     */
    public static function now(): \DateTimeImmutable
    {
        return new \DateTimeImmutable('now');
    }
}
