<?php

namespace App\Models;


class Coupon extends BaseModel
{

    const searchAttributes = ['coupon_num'];
    protected $fillable = ['coupon_num','type','discount','max_discount','expire_date','max_use','use_times','status'];
}
