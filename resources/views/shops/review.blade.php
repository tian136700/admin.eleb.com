@extends("default")
@section("contents")
    <form action="{{route("shops.updatereview",[$review])}}" method="post"  enctype="multipart/form-data">
        <table class="table table-bordered table-responsive">
            <tr class="text-center" ><td colspan="7"><label>商家名</label></td></tr>
            <tr>

                <td colspan="7">{{$review->shop_name}}</td>
            </tr>
            <tr class="text-center"><td colspan="7"><label>账号名</label></td></tr>
            <tr>
                <td colspan="7">{{$review->name}}</td>
            </tr>

            <tr class="text-center"><td colspan="7"><label>email</label></td></tr>
            <tr>
                <td colspan="7">{{$review->email}}</td>
            </tr>
            <tr class="text-center">
                <td><label>店铺类别</label></td>
                <td><label for="">是否是品牌</label></td>
                <td><label for="">是否准时送达</label></td>
                <td><label for="">是否蜂鸟配送</label></td>
                <td><label for="">是否保标记</label></td>
                <td><label for="">是否票标记</label></td>
                <td><label for="">是否准标记</label></td></tr>
            <tr>
                <td>{{$review->category->name}}</td>
                <td>{{$review->on_time==1?"是":"否"}}</td>
                <td>{{$review->fengniao==1?"是":"否"}}</td>
                <td>{{$review->bao==1?"是":"否"}}</td>
                <td>{{$review->piao==1?"是":"否"}}</td>
                <td>{{$review->zhun==1?"是":"否"}}</td>
                <td>{{$review->brand==1?"是":"否"}}</td>
            </tr>

            <tr class="text-center"><td colspan="3"><label>起送金额</label></td>
                <td colspan="4">配送费</td>
            </tr>
            <tr class="text-center">
                <td colspan="3">{{$review->start_send}}</td>
                <td colspan="4">{{$review->send_cost}}</td>
            </tr>
            <tr class="text-center"><td colspan="7"><label>评分</label></td></tr>
            <tr>
                <td colspan="7">{{$review->review_rating}}</td>
            </tr>
            <tr class="text-center"><td colspan="7"><label>店公告</label></td></tr>
            <tr>
                <td colspan="7">{{$review->notice}}</td>
            </tr>
            <tr class="text-center"><td colspan="7"><label>优惠信息</label></td></tr>
            <tr>
                <td colspan="7">{{$review->discount}}</td>
            </tr>

            <tr class="text-center" ><td colspan="7"><label>店铺图片</label></td></tr>
            <tr>
                <td colspan="7"><img width="100" height="100" src="{{$review->review_img}}" alt=""></td>
            </tr>
       
        &emsp;<tr> <b>审核状态</b>
            <select name="status" id="">
                <option value="1">正常</option>
                <option value="-1">禁用</option>
                <option value="0">待审核</option>
            </select></tr>

    </table>
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
        </form>
@stop