<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends BaseModel
{
    use HasTranslations;

    const searchAttributes = ['title'];

    protected $fillable     = ['title', 'slug', 'content'];
    public    $translatable = ['title', 'content'];

	public function getSlugTextAttribute() : string
	{
		return __('admin.slug_'.$this->slug);
	}
}
