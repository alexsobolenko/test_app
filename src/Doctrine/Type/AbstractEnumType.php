<?php

declare(strict_types=1);

namespace App\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

abstract class AbstractEnumType extends Type
{
    /**
     * @param array $column
     * @param AbstractPlatform $platform
     * @return string
     */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'TEXT';
    }

    /**
     * @param $value
     * @param AbstractPlatform $platform
     * @return int|mixed|string|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof \BackedEnum ? $value->value : null;
    }

    /**
     * @param $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (false === enum_exists($this::enumClass(), true)) {
            throw new \LogicException('This class should be an enum');
        }

        return $this::enumClass()::tryFrom($value);
    }

    /**
     * @return string
     */
    abstract public static function enumClass(): string;
}
