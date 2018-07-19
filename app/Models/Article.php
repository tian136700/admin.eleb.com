<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable=["title","content","categories_id","author_id","logo"];
    //建立文章和学生的关系
    public function student()
    {
        return $this->belongsTo(Users::class,"author_id","id");
    }
    //建立和分类之间的关系
    public function category()
    {
        return $this->belongsTo(ArticleCategories::class,"categories_id","id");
//        return "1111";
    }
}
