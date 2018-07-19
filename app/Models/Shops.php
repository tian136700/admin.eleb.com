<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{

    protected $fillable=["shop_name","shop_category_id","brand","on_time","fengniao","bao","piao","zhun","start_send","send_cost","notice","discount","shop_img"];
    //建立和分类之间的关系
    public function category()
    {
        return $this->belongsTo(ShopCategories::class,"shop_category_id","id");

    }
}
