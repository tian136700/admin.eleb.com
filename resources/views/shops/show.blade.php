@extends("default")
@section("contents")
    <table class="table table-bordered table-responsive">
    <tr class="text-center" ><td colspan="7"><label>商家名</label></td></tr>
        <tr>

            <td colspan="7">{{$shop->shop_name}}</td>
        </tr>
        <tr class="text-center"><td colspan="7"><label>账号名</label></td></tr>
        <tr>
            <td colspan="7">{{$shop->name}}</td>
        </tr>

        <tr class="text-center"><td colspan="7"><label>email</label></td></tr>
        <tr>
            <td colspan="7">{{$shop->email}}</td>
        </tr>
        <tr class="text-center">
            <td><label>店铺类别</label></td>
            <td><label for="">是否是品牌</label></td>
            <td><label for="">是否准时送达</label></td>
            <td><label for="">是否蜂鸟配送</label></td>
            <td><label for="">是否保标记</label></td>
            <td><label for="">是否票标记</label></td>
            <td><label for="">是否准标记</label></td></tr>
        <tr class="text-center">
            <td>{{$shop->category->name}}</td>
            <td>{{$shop->on_time==1?"是":"否"}}</td>
            <td>{{$shop->fengniao==1?"是":"否"}}</td>
            <td>{{$shop->bao==1?"是":"否"}}</td>
            <td>{{$shop->piao==1?"是":"否"}}</td>
            <td>{{$shop->zhun==1?"是":"否"}}</td>
            <td>{{$shop->brand==1?"是":"否"}}</td>
        </tr>

        <tr class="text-center"><td colspan="3"><label>起送金额</label></td>
        <td colspan="4">配送费</td>
        </tr>
        <tr class="text-center">
            <td colspan="3">{{$shop->start_send}}</td>
            <td colspan="4">{{$shop->send_cost}}</td>
        </tr>

        <tr class="text-center"><td colspan="7"><label>评分</label></td></tr>
        <tr>
            <td colspan="7">{{$shop->shop_rating}}</td>
        </tr>
        <tr class="text-center"><td colspan="7"><label>店公告</label></td></tr>
        <tr>
            <td colspan="7">{{$shop->notice}}</td>
        </tr>
        <tr class="text-center"><td colspan="7"><label>优惠信息</label></td></tr>
        <tr>
            <td colspan="7">{{$shop->discount}}</td>
        </tr>

        <tr class="text-center" ><td colspan="7"><label>店铺图片</label></td></tr>
        <tr>
            <td colspan="7"><img width="100" height="100" src="{{$shop->shop_img}}" alt=""></td>
        </tr>
    </table>
@stop