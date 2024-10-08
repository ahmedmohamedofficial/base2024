<?php

namespace App\Models;


class IntroMessages extends BaseModel
{

    const searchAttributes = ['name','phone','email'];
    protected $fillable = ['name','phone','email','message'];
}
