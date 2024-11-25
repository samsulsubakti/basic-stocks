<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\BaseCrud\Traits\HasBaseTable;
use App\Services\BaseCrud\Traits\HasBaseOwner;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{

  use Notifiable;
  use HasFactory, HasBaseTable, HasBaseOwner;
  use SoftDeletes;

  protected $table = 'users';

  protected $fillable = [
    "uuid",
    "name",
    "email",
    "email_verified_at",
    "password",
    "username",
    "is_active",
    "remember_token",
  ];

  protected $hidden = [
    "password",
    "remember_token",
  ];

  protected $casts = [
    "is_active" => "boolean",
  ];
}
