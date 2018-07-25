@extends('default')

@section("css_files")
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@stop
@section("js_files")
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@stop
@section("contents")
    <form action="{{route("shops.store")}}" method="post" enctype="multipart/form-data" class="form-horizontal">
        {{--<table class="table table-bordered table-responsive">--}}

        <h1>商家注册</h1>

        @include("_errors")
        <label class="col-xs-2 control-label">商家名</label>
        <div class="form-group">

            <input type="text" name="shop_name" style="width: 500px" class="form-control" value="{{old("shop_name")}}"/>
        </div>
        <label class="col-xs-2 control-label">账号名</label>
        <div class="form-group">

            <input type="text" name="name" style="width: 500px" class="form-control" value="{{old("name")}}"/>
        </div>
        <label class="col-xs-2 control-label">email</label>
        <div class="form-group">

            <input type="text" name="email" style="width: 500px" class="form-control" value="{{old("email")}}"/>
        </div>
        <label class="col-xs-2 control-label">密码</label>
        <div class="form-group">

            <input type="password" name="password" style="width: 500px" class="form-control" value=""/>
        </div>
        <label class="col-xs-2 control-label">确认密码</label>
        <div class="form-group">

            <input type="password" name="repassword" style="width: 500px" class="form-control" value=""/>
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
                <option value="1">是</option>
                <option value="0">否</option>
            </select>

            <b>是否准时送达</b>

            <select name="on_time" id="">
                <option value="1">是</option>
                <option value="0">否</option>
            </select>


            <b>是否蜂鸟配送</b>

            <select name="fengniao" id="">
                <option value="1">是</option>
                <option value="0">否</option>
            </select>

            <b>是否保标记</b>

            <select name="bao" id="">
                <option value="1">是</option>
                <option value="0">否</option>
            </select>

            <b>是否票标记</b>

            <select name="piao" id="">
                <option value="1">是</option>
                <option value="0">否</option>
            </select>

            <b>是否准标记</b>

            <select name="zhun" id="">
                <option value="1">是</option>
                <option value="0">否</option>
            </select>

        <br>

        <label class="col-xs-2 control-label">起送金额</label>
        <div class="form-group">
            <input type="number" name="start_send" style="width: 500px" class="form-control" value="{{old("start_send")}}"/>
        </div>
        <label class="col-xs-2 control-label">配送费</label>
        <div class="form-group">
            <input type="number" name="send_cost" style="width: 500px" class="form-control" value="{{old("send_cost")}}"/>
        </div>
        <label class="col-xs-2 control-label">店公告</label>
        <div class="form-group">
            <textarea style="width: 500px" name="notice" class="form-control">{{old("notice")}}</textarea>
        </div>
        <label class="col-xs-2 control-label">优惠信息</label>
        <div class="form-group">
            <input type="number" name="discount" value="{{old("discount")}}"style="width: 500px" class="form-control" value=""/>
        </div>

        <label class="col-xs-2 control-label">店铺图片</label>
        <div class="form-group">
            <input type="hidden" style="width: 500px"id="img_url" name="shop_img"/>
            <!--dom结构部分-->
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker" >选择图片</div>
                <img id="img" alt="">
            </div>
        </div>


        <label class="col-xs-2 control-label">验证码</label>
        <div class="form-group">
            <input id="captcha" style="width: 500px" class="form-control" name="captcha">
            <p class="col-md-offset-2"><img class="thumbnail captcha" src="{{ captcha_src('flat') }}"
                                            onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码"></p>

        </div>
        {{--<div class="row">--}}
        {{--<p>--}}
        {{--<img class="thumbnail captcha"  src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">--}}
        {{--</p>--}}


        {{--</div>--}}
        {{--<div class="container">--}}
        {{--<div class="row"  >--}}
        {{--<div class="text-center ">--}}

        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{csrf_field()}}
        <button class="btn btn-primary btn-large col-md-offset-3" style="width: 300px">提交</button>

        </table>
    </form>
@endsection
@section("js")

    <script>

        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
//            swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: "{{route("upload")}}",

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData:{
                _token:'{{csrf_token()}}'
            },
        });
        uploader.on( 'uploadSuccess', function( file,response ) {
            // do some things.
            console.debug(response.filename)
            $("#img").attr('src',response.filename);
            $("#img_url").val(response.filename);
        });
    </script>
@stop