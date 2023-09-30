<?php

declare(strict_types=1);

namespace App\Doctrine\Type\Purchase;

use App\Doctrine\Type\AbstractEnumType;
use App\Enum\Status;

class PurchaseStatusType extends AbstractEnumType
{
    public const NAME = 'purchase_status_type';

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME;
    }

    public static function enumClass(): string
    {
        return Status::class;
    }
}
