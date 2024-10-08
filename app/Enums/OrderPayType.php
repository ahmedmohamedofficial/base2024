<?php

namespace App\Enums;

/**
 * @method static string all()
 * @method static string allKeys()
 * @method static string|null nameFor($value)
 * @method static array toArray()
 * @method static array forApi()
 * @method static string slug(int $value)
 * @method static array withTitle(string $file = 'enums', string $prefix = '')
 * @method static array toResource(int $value, string $file = 'enums', string $prefix = '')
 * @method static int|string randomValue()
 */
class OrderPayType extends Base
{
    public const UNDEFINED = 0;
    public const CASH      = 1;
    public const WALLET    = 2;
    public const BANK      = 3;
    public const ONLINE    = 4;
}
