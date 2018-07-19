@extends("default")
@section("contents")
    <table class="table table-bordered table-responsive">
    <tr class="text-center"><td><label>商家名</label></td></tr>
        <tr>

            <td>{{$shop->shop_name}}</td>
        </tr>
        <tr class="text-center"><td><label>账号名</label></td></tr>
        <tr>
            <td>{{$shop->name}}</td>
        </tr>

        <tr class="text-center"><td><label>email</label></td></tr>
        <tr>
            <td>{{$shop->email}}</td>
        </tr>
        <tr class="text-center"><td><label>店铺类别</label></td></tr>
        <tr>
            <td>{{$shop->shop_category_id}}</td>
        </tr>
        <tr class="text-center"><td><label>是否是品牌</label></td></tr>
        <tr>
            <td>{{$shop->brand}}</td>
        </tr>
        <tr class="text-center"><td><label>是否准时送达</label></td></tr>
        <tr>
            <td>{{$shop->on_time}}</td>
        </tr>
        <tr class="text-center"><td><label>是否蜂鸟配送</label></td></tr>
        <tr>
            <td>{{$shop->fengniao}}</td>
        </tr>
        <tr class="text-center"><td><label>是否保标记</label></td></tr>
        <tr>
            <td>{{$shop->bao}}</td>
        </tr>
        <tr class="text-center"><td><label>是否票标记</label></td></tr>
        <tr>
            <td>{{$shop->piao}}</td>
        </tr>
        <tr class="text-center"><td><label>是否准标记</label></td></tr>
        <tr>
            <td>{{$shop->zhun}}</td>
        </tr>
        <tr class="text-center"><td><label>起送金额</label></td></tr>
        <tr>
            <td>{{$shop->start_send}}</td>
        </tr>
        <tr class="text-center"><td><label>配送费</label></td></tr>
        <tr>
            <td>{{$shop->send_cost}}</td>
        </tr>
        <tr class="text-center"><td><label>评分</label></td></tr>
        <tr>
            <td>{{$shop->shop_rating}}</td>
        </tr>
        <tr class="text-center"><td><label>店公告</label></td></tr>
        <tr>
            <td>{{$shop->notice}}</td>
        </tr>
        <tr class="text-center"><td><label>优惠信息</label></td></tr>
        <tr>
            <td>{{$shop->discount}}</td>
        </tr>

        <tr class="text-center" ><td><label>店铺图片</label></td></tr>
        <tr>
            <td><img width="100" height="100" src="{{\Illuminate\Support\Facades\Storage::url($shop->shop_img)}}" alt=""></td>
        </tr>
    </table>
@stop