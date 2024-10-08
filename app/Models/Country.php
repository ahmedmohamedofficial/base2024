<?php
namespace App\Models;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends BaseModel
{
	use HasTranslations, SoftDeletes;

	const IMAGEPATH        = 'countries';
	const searchAttributes = ['name'];

	protected $fillable = ['name', 'image', 'country_code', 'iso2', 'iso3'];

	public $translatable = ['name'];

	public function cities()
	{
		return $this->hasMany(City::class);
	}
}
