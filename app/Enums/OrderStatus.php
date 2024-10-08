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
class OrderStatus extends Base
{
    public const NEW      = 0;
    public const ACCEPTED = 1;
    public const REFUSED  = 2;
    public const CANCEL   = 3;
    public const FINISHED = 4;
}
