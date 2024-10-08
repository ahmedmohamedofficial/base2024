<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class
Device extends Model
{
    const searchAttributes = [''];
    protected $fillable = ['device_type', 'device_id', 'morph_id', 'morph_type', 'is_notify'];
    protected $casts    = [
        'is_notify' => 'boolean',
    ];

    public function morph()
    {
        return $this->morphTo();
    }
}
