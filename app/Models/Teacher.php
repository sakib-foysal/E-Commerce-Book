<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Teacher extends Authenticatable
{
use Notifiable;
protected $guard = 'teacher';
 protected $fillable = [
        'name',
        'email',
        'password',
    ];
protected $hidden = [
'password', 'remember_token',
];
}
