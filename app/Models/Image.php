<?php

namespace App\Models;


class Image extends BaseModel
{
    const IMAGEPATH = 'images';

    const searchAttributes = [];
    protected $fillable = ['image'];
}
