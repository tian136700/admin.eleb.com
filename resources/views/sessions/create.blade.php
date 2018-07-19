@extends('default')
@section("contents")
    <form action="{{route("login")}}" method="post">
        <h1>登陆页</h1>
        @include("_errors")
        <label>用户名</label>
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="{{old("name")}}"/>
        </div>
        <label>密码</label>
        <div class="form-group ">
            <input type="password" name="password" class="form-control" value="{{old("name")}}"/>
        </div>
        <div class="checkbox">
            <label for="">
            <input type="checkbox" name="remember" value="1"/>记住密码
            </label>
        </div>

        {{csrf_field()}}
        <div class="form-group text-center">
            <button class="btn btn-primary ">登陆</button>
        </div>

    </form>
@endsection