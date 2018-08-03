@extends('default')

@section("contents")
    <table>
        <form action="{{route("navs.store")}}" method="post" class="form-horizontal">
            {{--<table class="table table-bordered table-responsive">--}}

            <h1>添加菜单</h1>

            @include("_errors")
            <label class="col-xs-2 control-label">菜单名称</label>
            <div class="form-group">

                <input type="text" name="name" style="width: 500px" class="form-control" value="{{old("name")}}"/>
            </div>

            <label class="col-xs-2 control-label">上级菜单</label>
            <div class="form-group">
                <select name="pid" id="">
                    <option value="">--选择上级菜单--</option>
                    <option value="0">顶级菜单</option>
                    @foreach($navs as $nav)
                        <option value="{{$nav->id}}">{{$nav->name}}</option>
                    @endforeach
                </select>

            </div>
            <label class="col-xs-2 control-label">路由（地址）</label>
            <div class="form-group">

                <input type="text" name="url" style="width: 500px" class="form-control" value="{{old("url")}}"/>
            </div>
            <label class="col-xs-2 control-label">添加权限</label>
            <div class="form-group">
                <select name="permission_id" id="">
                    <option value="">--选择权限--</option>
                    @foreach($permissions as $permission)
                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                    @endforeach
                </select>
            </div>
            {{csrf_field()}}
            <button class="btn btn-primary btn-large col-md-offset-3" style="width: 300px">提交</button>

        </form>
    </table>

@endsection
