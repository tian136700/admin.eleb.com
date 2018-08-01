@extends('default')
@section("contents")
    <form action="{{route("admins.store")}}" method="post" enctype="multipart/form-data">
        <h1>新增管理员</h1>
        @include("_errors")
        <label>用户名</label>
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="{{old("name")}}"/>
        </div>
        <label>email</label>
        <div class="form-group">
            <input type="text" name="email" class="form-control" value="{{old("email")}}"/>
        </div>

        <label>密码</label>
        <div class="form-group">
            <input type="password" name="password" class="form-control" value=""/>
        </div>
        <label>确认密码</label>
        <div class="form-group">
            <input type="password" name="repassword" class="form-control" value=""/>
        </div>
        <label>角色</label>
        <div class="form-group">
            @foreach($roles as $role)

                <input type="checkbox" name="role[]" value="{{$role->id}}">{{$role->name}}&emsp;
            @endforeach
        </div>
        
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
@endsection