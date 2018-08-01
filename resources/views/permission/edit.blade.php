@extends('default')
@section("contents")
    <form action="{{route("permissions.update",[$permission])}}" method="post">
        <h1>修改权限</h1>
        @include("_errors")
        <label class="col-xs-2 control-label">名称</label>
        <div class="form-group">
            <input type="text" name="name" style="width: 500px" class="form-control"
                   value="{{$permission->name}}"/>
        </div>
        <label class="col-xs-2 control-label">描述</label>
        <div class="form-group">
            <input type="text" name="guard_name" class="form-control" style="width: 500px"
                   value="@if(old("guard_name")){{old("guard_name")}}@else{{$permission->guard_name}}@endif"/>
        </div>

        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
@endsection
