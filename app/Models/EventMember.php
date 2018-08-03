<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventMember extends Model
{
    public function category()
    {
        return $this->belongsTo(Shops::class,"shop_id","id");
    }
}
