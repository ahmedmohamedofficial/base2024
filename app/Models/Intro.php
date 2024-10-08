<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Intro extends BaseModel
{
    use HasTranslations;

    const IMAGEPATH        = 'intros';
    const searchAttributes = ['title', 'description'];

    protected $fillable     = ['title', 'description', 'image'];
    public    $translatable = ['title', 'description'];

}
