<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountController extends Controller
{
    //
    public function index(Request $request)
    {
//        dd($request->type);
        $type = $request->type;
        $Marr = [];
        if (empty($type)) {
            return view("count/index",compact("type","Marr"));
        }
        if ($type == "all") {
            //按日进行统计
            $day = $request->day??date("Y-m-d");
            $dayCount = DB::select("SELECT COUNT(*) as `count` FROM orders 
WHERE ( datediff ( created_at , '$day' ) = 0 )")[0]->count;
            //月订单数量
            $month = $request->month??date("m");
            //传入某一个月的值
            $smonth = "2018-" . $month . "-01";
            $emonth = "2018-" . ($month + 1) . "-01";
            $monthCount = DB::select("select COUNT(*) as `count` from orders where created_at>='$smonth' and created_at<'$emonth'")[0]->count;
            //累计数量
            $total = DB::select("select COUNT(*) as `count` from orders")[0]->count;

            return view("count/index", compact("dayCount", "monthCount", "total", "type"));
        }
        if ($type == "shop") {
            //按日进行统计
            $day = $request->day??'2018-07-28';
            $dayCounts = DB::select("SELECT m.id,m.shop_name,count(o.id) as `count` from shops as m JOIN orders as o ON o.shop_id=m.id where  ( datediff ( o.created_at , '{$day}' ) = 0 ) group by o.shop_id ");
            $shops = Shops::select("id", "shop_name")->get();


            $count = count($shops);
            for ($i = 0; $i < $count; $i++) {
                $Marr[$i]["id"] = $shops[$i]->id;
                $Marr[$i]["shop_name"] = $shops[$i]->shop_name;
                foreach ($dayCounts as $dayCount) {
                    if ($dayCount->id === $shops[$i]->id) {
                        $Marr[$i]["dayCount"] = $dayCount->count;
                    }

                }
                if (empty($Marr[$i]["dayCount"])) {
                    $Marr[$i]["dayCount"] = 0;
                }

            }


            //月份显示
            //传入某一个月的值
            $month = $request->month??date("m");
            $smonth = "2018-" . $month . "-01";
            $emonth = "2018-" . ($month + 1) . "-01";
            $monthCounts = DB::select("SELECT m.id,m.shop_name,count(o.id) as `count` from shops as m JOIN orders as o ON o.shop_id=m.id where  o.created_at>='$smonth' and o.created_at<'$emonth' group by o.shop_id ");
//
            for ($i = 0; $i < $count; $i++) {

                foreach ($monthCounts as $monthCount) {
                    if ($monthCount->id === $Marr[$i]['id']) {
                        $Marr[$i]["monthCount"] = $monthCount->count;
                    }

                }
                if (empty($Marr[$i]["monthCount"])) {
                    $Marr[$i]["monthCount"] = 0;
                }

            }

            //总计
            $totals = DB::select("SELECT m.id,m.shop_name,count(o.id) as `count` from shops as m 
JOIN orders as o ON o.shop_id=m.id
group by o.shop_id 
");
            for ($i = 0; $i < $count; $i++) {

                foreach ($totals as $total) {
                    if ($total->id === $Marr[$i]['id']) {
                        $Marr[$i]["total"] = $total->count;
                    }

                }
                if (empty($Marr[$i]["total"])) {
                    $Marr[$i]["total"] = 0;
                }

            }
//            dd($Marr);
            return view("count/index", compact("Marr", "type"));

        }
    }

    public function menus(Request $request)
    {
        $type = $request->type??"";
        $shops = Shops::all();
        if (empty($type)) {


            return view("count/menus", compact("shops", "type"));
        }
//        dd($type);
        //按日进行统计
        $day = $request->day??'2018-07-28';
        $menus = DB::select("select id,goods_name from menus where shop_id='{$type}'");
        $dayCounts = DB::select("SELECT m.id,m.goods_name,count(o.id) as `count` from menus as m JOIN order_goods as o ON o.goods_id=m.id where  ( datediff ( o.created_at , '{$day}' ) = 0 ) AND m.shop_id='{$type}'
group by o.goods_id");
        $Marr = [];
        $count = count($menus);
        for ($i = 0; $i < $count; $i++) {
            $Marr[$i]["id"] = $menus[$i]->id;
            $Marr[$i]["goods_name"] = $menus[$i]->goods_name;
            foreach ($dayCounts as $dayCount) {
                if ($dayCount->id === $menus[$i]->id) {
                    $Marr[$i]["dayCount"] = $dayCount->count;
                }

            }
            if (empty($Marr[$i]["dayCount"])) {
                $Marr[$i]["dayCount"] = 0;
            }

        }
        //月份显示
        //传入某一个月的值
        $month = $request->month??date("m");
        $smonth = "2018-" . $month . "-01";
        $emonth = "2018-" . ($month + 1) . "-01";
        $monthCounts = DB::select("SELECT m.id,m.goods_name,count(o.id) as `count` from menus as m JOIN order_goods as o ON o.goods_id=m.id 
where  o.created_at>='{$smonth}' 
and o.created_at<'{$emonth}' AND m.shop_id='{$type}' group by o.goods_id");
        for ($i = 0; $i < $count; $i++) {

            foreach ($monthCounts as $monthCount) {
                if ($monthCount->id === $Marr[$i]['id']) {
                    $Marr[$i]["monthCount"] = $monthCount->count;
                }

            }
            if (empty($Marr[$i]["monthCount"])) {
                $Marr[$i]["monthCount"] = 0;
            }

        }
        //总计
        $totals = DB::select("SELECT m.id,m.goods_name,count(o.id) as `count` from menus as m JOIN order_goods as o ON o.goods_id=m.id where m.shop_id='{$type}' group by o.goods_id ");
        for ($i = 0; $i < $count; $i++) {

            foreach ($totals as $total) {
                if ($total->id === $Marr[$i]['id']) {
                    $Marr[$i]["total"] = $total->count;
                }

            }
            if (empty($Marr[$i]["total"])) {
                $Marr[$i]["total"] = 0;
            }

        }
//        dd($Marr);

        return view("count/menus", compact("Marr", "type", "shops"));
    }

}
