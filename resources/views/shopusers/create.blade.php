@extends('default')
@section("contents")
    <form action="{{route("users.store")}}" method="post"  enctype="multipart/form-data" class="form-horizontal">
        <h1>用户注册</h1>
        @include("_errors")
        <label class="col-xs-2 control-label">用户名</label>
        <div class="form-group">
            <input type="text" name="name" style="width: 500px" class="form-control" value="{{old("name")}}"/>
        </div>
        <label class="col-xs-2 control-label">密码</label>
        <div class="form-group">
            <input type="password" name="password"style="width: 500px" class="form-control" value=""/>
        </div>
        <label class="col-xs-2 control-label">邮箱</label>
        <div class="form-group">
            <input type="text" name="email"style="width: 500px" class="form-control" value=""/>
        </div>
        <label class="col-xs-2 control-label">头像</label>
        <div class="form-group">
            <input type="file"style="width: 500px" name="logo"/>
        </div>
        <label class="col-xs-2 control-label">验证码</label>
        <div class="form-group">
        <input id="captcha" style="width: 500px"class="form-control" name="captcha" >
            <p class="col-md-offset-2"><img class="thumbnail captcha"  src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码"></p>

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
    </form>
@endsection