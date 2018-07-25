@extends('default')

@section("css_files")
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@stop
@section("js_files")
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@stop
@section("contents")
    <form action="{{route("shops.update",[$shop])}}" method="post">
        <h1>商家修改</h1>
        @include("_errors")
        <label class="col-xs-2 control-label">商家名</label>
        <div class="form-group">
            <input type="text" name="shop_name" style="width: 500px" class="form-control" value="@if(old("shop_name")){{old("shop_name")}}@else{{$shop->shop_name}}@endif"/>
        </div>
        <label class="col-xs-2 control-label">账号名</label>
        <div class="form-group">
            <input type="text" name="name" class="form-control" style="width: 500px" value="@if(old("name")){{old("name")}}@else{{$shop->name}}@endif"/>
        </div>
        <label class="col-xs-2 control-label">email</label>
        <div class="form-group">
            <input type="text" name="email" class="form-control" style="width: 500px" value="@if(old("email")){{old("email")}}@else{{$shop->email}}@endif"/>
        </div>

        <b>店铺类别</b>
        <select name="shop_category_id" id="">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        &emsp;
        <b>是否是品牌</b>

        <select name="brand" id="">
            <option value="1" {{$shop->brand==1?"selected":""}}>是</option>
            <option value="0" {{$shop->brand==0?"selected":""}}>否</option>
        </select>

        <b>是否准时送达</b>

        <select name="on_time" id="">
            <option value="1" {{$shop->on_time==1?"selected":""}}>是</option>
            <option value="0" {{$shop->on_time==0?"selected":""}}>否</option>
        </select>


        <b>是否蜂鸟配送</b>

        <select name="fengniao" id="">
            <option value="1" {{$shop->fengniao==1?"selected":""}}>是</option>
            <option value="0" {{$shop->fengniao==0?"selected":""}}>否</option>
        </select>

        <b>是否保标记</b>

        <select name="bao" id="">
            <option value="1" {{$shop->bao==1?"selected":""}}>是</option>
            <option value="0" {{$shop->bao==0?"selected":""}}>否</option>
        </select>

        <b>是否票标记</b>

        <select name="piao" id="">
            <option value="1" {{$shop->piao==1?"selected":""}}>是</option>
            <option value="0" {{$shop->piao==0?"selected":""}}>否</option>
        </select>

        <b>是否准标记</b>

        <select name="zhun" id="">
            <option value="1" {{$shop->zhun==1?"selected":""}}>是</option>
            <option value="0" {{$shop->zhun==0?"selected":""}}>否</option>
        </select>

        <br><br>
        <label class="col-xs-2 control-label">起送金额</label>
        <div class="form-group">
            <input type="number" name="start_send" class="form-control" style="width: 500px" value="@if(old("start_send")){{old("start_send")}}@else{{$shop->start_send}}@endif"/>
        </div>
        <label class="col-xs-2 control-label">配送费</label>
        <div class="form-group">
            <input type="number" name="send_cost" class="form-control" style="width: 500px" value="@if(old("send_cost")){{old("send_cost")}}@else{{$shop->send_cost}}@endif"/>
        </div>
        <label class="col-xs-2 control-label">评分</label>
        <div class="form-group">
            <input type="number" name="shop_rating" class="form-control" style="width: 500px" value="@if(old("shop_rating")){{old("shop_rating")}}@else{{$shop->shop_rating}}@endif"/>
        </div>
        <label class="col-xs-2 control-label">店公告</label>
        <div class="form-group">
            <textarea style="width: 500px" name="notice" class="form-control">@if(old("notice")){{old("notice")}}@else{{$shop->notice}}@endif</textarea>
        </div>



        <label class="col-xs-2 control-label">优惠信息</label>
        <div class="form-group">
            <input type="text" name="discount" class="form-control" style="width: 500px" value="@if(old("discount")){{old("discount")}}@else{{$shop->discount}}@endif"/>
        </div>

        <label>店铺图片</label>
        <input type="hidden" id="img_url" name="shop_img" value=""/>
        <!--dom结构部分-->
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
            <img id="img" src="{{$shop->shop_img}}" alt="">
        </div>



        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
@endsection
