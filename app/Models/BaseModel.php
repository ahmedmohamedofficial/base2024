<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UploadTrait;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class BaseModel extends Model
{
    use UploadTrait, SearchTrait, HasFactory;

    const searchAttributes = [];

    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            $image = $this->getImage($this->attributes['image'], static::IMAGEPATH);
        } else {
            $image = $this->defaultImage(static::IMAGEPATH);
        }
        return $image;
    }

    public function setImageAttribute($value)
    {
        if (null != $value && is_file($value)) {
            isset($this->attributes['image']) ? $this->deleteFile($this->attributes['image'], static::IMAGEPATH) : '';
            $this->attributes['image'] = $this->uploadAllTyps($value, static::IMAGEPATH);
        }
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getCreatedAtFormatAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('j F Y g:i A');
    }

    public static function boot()
    {
        parent::boot();
        /* creating, created, updating, updated, deleting, deleted, forceDeleted, restored */

        static::deleted(function ($model) {
            if (isset($model->attributes['image'])) {
                $model->deleteFile($model->attributes['image'], static::IMAGEPATH);
            }
        });

    }

}