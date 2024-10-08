<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntroSocial extends BaseModel
{

    const searchAttributes = ['key'];
    protected $fillable = ['key','url','icon'];
}
