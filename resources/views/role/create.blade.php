@extends('default')

@section("contents")
    <table>
    <form action="{{route("roles.store")}}" method="post" class="form-horizontal">
        {{--<table class="table table-bordered table-responsive">--}}

        <h1>添加角色</h1>

        @include("_errors")
        <label class="col-xs-2 control-label">名称</label>
        <div class="form-group">

            <input type="text" name="name" style="width: 500px" class="form-control" value="{{old("name")}}"/>
        </div>

        <label class="col-xs-2 control-label">添加权限</label>
        <div class="form-group">
            @foreach($permissions as $permission)

            <input type="checkbox" name="permission[]" value="{{$permission->name}}">{{$permission->name}}&emsp;
                @endforeach
        </div>
        {{csrf_field()}}
        <button class="btn btn-primary btn-large col-md-offset-3" style="width: 300px">提交</button>
    </form>
        </table>

@endsection
