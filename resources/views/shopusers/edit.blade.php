@extends('default')
@section("contents")
    <form action="{{route("shopusers.update",[$shopuser])}}" method="post"  enctype="multipart/form-data">
        <h1>修改用户</h1>
        @include("_errors")
        <label>用户名</label>
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="@if(old("name")){{old("name")}}@else{{$shopuser->name}}@endif"/>
        </div>
        <label>密码</label>
        <div class="form-group">
            <input type="password" name="password" class="form-control" value=""/>
        </div>
        <label>确认密码</label>
        <div class="form-group">
            <input type="password" name="repassword" class="form-control" value=""/>
        </div>


        <label>邮箱</label>
        <div class="form-group">
            <input type="text" name="email" class="form-control" value="@if(old("email")){{old("email")}}@else{{$shopuser->email}}@endif"/>
        </div>
        <label>状态</label>
        <div class="form-group">
            <select name="status" id="">
                <option value="1">启用</option>
                <option value="0">禁用</option>
            </select>

        </div>
        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
@endsection