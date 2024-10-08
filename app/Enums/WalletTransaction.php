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
class WalletTransaction extends Base
{
    public const CHARGE     = 0;
    public const DEBT       = 1;
    public const PAYORDER   = 2;
}
