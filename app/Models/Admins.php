<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Database\Eloquent\Model;

class Admins extends Authenticatable
{
    //
    use Notifiable;
    protected $fillable=["name","password","email"];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
