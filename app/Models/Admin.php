<?php

namespace App\Models;


class Admin extends AuthBaseModel {

  const IMAGEPATH = 'admins';
  const searchAttributes = ['name', 'phone', 'email'];

  protected $fillable = [
    'name',
    'phone',
    'email',
    'password',
    'avatar',
    'role_id',
    'is_notify',
    'is_blocked',
    'type',
  ];


  protected $casts = [
    'is_notify'  => 'boolean',
    'is_blocked' => 'boolean',
  ];

  public function role() {
    return $this->belongsTo(Role::class)->withTrashed();
  }
}
