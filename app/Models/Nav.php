<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Nav extends Model
{
    //
    protected $fillable = ["name", "url", "permission_id", "pid"];

    public function permission()
    {
        return $this->belongsTo(Permission::class, "permission_id", "id");

    }

    public function children()
    {
        return $this->hasMany(self::class, "pid");
    }

//获取导航菜单栏
    public static function getNavHtml()
    {
        $html = "";

        foreach (self::where("pid", 0)->get() as $nav) {

            $children_html = "";
            foreach ($nav->children as $child) {
                if (auth()->user()->can($child->permission->name)) {
                    $children_html .= '<li><a href="' . route($child->url) . '">' . $child->name . '</a></li>';
                }

            }
            if (empty($children_html)) continue;
            $html .= '<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">' . $nav->name . '<span class="caret"></span></a>
                        <ul class="dropdown-menu">';


            $html .= $children_html;
            $html .= '</ul>
                    </li>';

        }

        return $html;
    }
}
