@extends('default')
@section("contents")
    <form action="{{route("users.update",[$user])}}" method="post"  enctype="multipart/form-data">
        <h1>修改用户</h1>
        @include("_errors")
        <label>用户名</label>
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="@if(old("name")){{old("name")}}@else{{$user->name}}@endif"/>
        </div>
        <label>密码</label>
        <div class="form-group">
            <input type="password" name="password" class="form-control" value=""/>
        </div>
        <label>邮箱</label>
        <div class="form-group">
            <input type="text" name="email" class="form-control" value="@if(old("email")){{old("email")}}@else{{$user->email}}@endif"/>
        </div>
        <label>头像</label>
        <div class="form-group">
            <input type="file" name="logo"/>
            <img width="100" height="100" src="{{\Illuminate\Support\Facades\Storage::url($user->logo)}}" alt="">
        </div>
        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
@endsection