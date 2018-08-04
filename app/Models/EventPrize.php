<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{

    protected $fillable=["events_id","name","description","shop_id"];

    public function event()
    {
        return $this->belongsTo(Event::class,"events_id","id");

    }
    public function shop()
    {
        return $this->belongsTo(Shops::class,"shop_id","id");

    }
}
