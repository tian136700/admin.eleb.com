@extends('default')

@section("css_files")
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    @stop
@section("js_files")
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@stop
@section("contents")
    <form action="{{route("shopcategories.store")}}" method="post" >
        <h1>添加商家分类</h1>
        @include("_errors")
        <label>分类名称</label>
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="{{old("name")}}"/>
        </div>
        <label>	状态</label>
        <div class="form-group" style="width: 200px">
            <select name="status" id="" class="form-control">
                <option value="1">显示</option>
                <option value="0">隐藏</option>
            </select>
        </div>
        <label>分类图片</label>
        <input type="hidden" id="img_url" name="img" value=""/>
        <!--dom结构部分-->
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker" >选择图片</div>
            <img id="img" alt="">
        </div>
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
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