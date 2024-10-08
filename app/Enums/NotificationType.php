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
class NotificationType extends Base
{
    public const ADMIN_NOTIFY           = 'admin_notify';
    public const OWNER_APPROVED         = 'owner_approved';
    public const OWNER_REJECTED         = '';
    public const BLOCK                  = 'block';
    public const UN_BLOCK               = 'un_blocked';
}
