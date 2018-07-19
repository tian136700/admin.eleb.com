<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopUsers extends Model
{
    //
    protected $fillable=["name","password","email","status"];
    //建立和商家之间的关系
    public function category()
    {
        return $this->belongsTo(Shops::class,"shop_id","id");

    }
}
