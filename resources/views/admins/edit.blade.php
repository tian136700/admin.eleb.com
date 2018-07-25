@extends('default')
@section("contents")
    <form action="{{route("admins.update",[$admin])}}" method="post">
        <h1>修改管理员</h1>
        @include("_errors")
        <label>用户名</label>
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="@if(old("name")){{old("name")}}@else{{$admin->name}}@endif"/>
        </div>
        <label>email</label>
        <div class="form-group">
            <input type="text" name="email" class="form-control" value="@if(old("email")){{old("email")}}@else{{$admin->email}}@endif"/>
        </div>
        <label>密码</label>
        <div class="form-group">
            <input type="password" name="password" class="form-control" value=""/>
        </div>
        <label>确认密码</label>
        <div class="form-group">
            <input type="password" name="repassword" class="form-control" value=""/>
        </div>

        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
    @endsection