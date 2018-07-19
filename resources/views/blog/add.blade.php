@extends("default")
@section("contents")
{{--<form action="{{route("saveBlog")}}" method="post">--}}
    {{--<div class="form-group">--}}
    {{--标题：<input type="text"  class="form-control input-sm"  placeholder="col-xs-4" name="title"><br>--}}
    {{--</div>--}}
    {{--内容：<textarea name="content" id="" cols="50" rows="20"></textarea><br>--}}
    {{--{{csrf_field()}}--}}
    {{--<input type="submit">--}}

{{--</form>--}}
<form class="form-horizontal">
    <div class="form-group">
        <div class="col-xs-8">
           <span>标题：</span> <input class="form-control input-lg" type="text" placeholder="" >
        </div>
        <div class="col-xs-8">
            <span>内容：</span> <textarea class="form-control input-lg" type="text" placeholder="" rows="20" cols="50" ></textarea>
        </div><br>

        {{--<input type="submit" class="btn btn-primary">--}}

    </div>
    <button type="button" class="btn btn-primary">提交按钮</button>
</form>
    @endsection