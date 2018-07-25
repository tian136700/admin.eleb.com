<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ShopUsers extends Authenticatable
{
    use Notifiable;

    protected $fillable=["name","password","email","status","shop_id"];
    //建立和商家之间的关系
    public function category()
    {
        return $this->belongsTo(Shops::class,"shop_id","id");

    }

    protected $hidden = [
        'password', 'remember_token',
    ];
}
