@extends('ldefault')
@section("contents")
    <div style="padding-left: 287px;padding-top: 9px">
    <form action="{{route("slogin")}}" method="post">
        <div style="padding-left: 201px;font-size: 25px; font-family:'微软雅黑';">登陆页</div>
        @include("_errors")
        <label>用户名</label>
        <div class="form-group">
            <input type="text" name="name" style="width: 500px" class="form-control" value="{{old("name")}}"/>
        </div>
        <label>密码</label>
        <div class="form-group ">
            <input type="password" name="password"  style="width: 500px" class="form-control" value="{{old("name")}}"/>
        </div>
        <div class="checkbox">
            <label for="">
            <input type="checkbox" name="remember" value="1"/>记住密码
            </label>
        </div>

        {{csrf_field()}}
        <div class="form-group" style="padding-left: 195px">
            <button class="btn btn-primary ">登陆</button>
        </div>

    </form>
    </div>
@endsection