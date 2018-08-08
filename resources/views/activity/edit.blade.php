@extends('default')

@section("css_files")
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@stop
@section("js_files")
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@stop
@include('vendor.ueditor.assets')
@section("contents")
    <form action="{{route("activities.update",[$activity])}}" method="post" enctype="multipart/form-data" class="form-horizontal">
        {{--<table class="table table-bordered table-responsive">--}}

        <h1>修改活动</h1>

        @include("_errors")
        <label class="col-xs-2 control-label">活动名称</label>
        <div class="form-group">

            <input type="text" name="title" style="width: 500px" class="form-control"
                   value="@if(old("title")){{old("title")}}@else{{$activity->title}}@endif"/>
        </div>

        <label class="col-xs-2 control-label" style="font-size: 30px">活动详情</label>
        <div class="form-group">
            <script id="container" name="content" type="text/plain"></script>
        </div>
        <label class="col-xs-2 control-label">活动开始时间</label>
        <div class="form-group">
            <input type="datetime-local" style="width: 500px" name="start_time"/>
        </div>
        <label class="col-xs-2 control-label">活动结束时间</label>
        <div class="form-group">
            <input type="datetime-local" style="width: 500px" name="end_time"/>
        </div>


        {{method_field("PATCH")}}
        {{csrf_field()}}
        <button class="btn btn-primary btn-large col-md-offset-3" style="width: 300px">提交</button>
        <br><br><br><br><br>
        </table>
    </form>
@endsection
@section("js")
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@stop
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