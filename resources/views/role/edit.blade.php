@extends('default')
@section("contents")
    <form action="{{route("roles.update",[$role])}}" method="post">
        <h1>修改角色</h1>
        @include("_errors")
        <label class="col-xs-2 control-label">名称</label>
        <div class="form-group">
            <input type="text" name="name" style="width: 500px" class="form-control"
                   value="{{$role->name}}"/>
        </div>
        <label class="col-xs-2 control-label">描述</label>
        <div class="form-group">
            <input type="text" name="guard_name" class="form-control" style="width: 500px"
                   value="@if(old("guard_name")){{old("guard_name")}}@else{{$role->guard_name}}@endif"/>
        </div>
        <div class="form-group">
            @foreach($permissions as $permission)

                <input type="checkbox" name="permission[]" value="{{$permission->name}}">{{$permission->guard_name}}&emsp;
            @endforeach
        </div>
        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
@endsection
