@extends('default')
@section("contents")
    <form action="{{route("navs.update",[$nav])}}" method="post">
        <h1>修改菜单</h1>
        @include("_errors")
        <label class="col-xs-2 control-label">菜单名称</label>
        <div class="form-group">
            <input type="text" name="name" style="width: 500px" class="form-control"
                   value="{{$nav->name}}"/>
        </div>
        <label class="col-xs-2 control-label">路由地址</label>
        <div class="form-group">
            <input type="text" name="url" style="width: 500px" class="form-control"
                   value="{{$nav->url}}"/>
        </div>

        <label class="col-xs-2 control-label">上级菜单</label>
        <div class="form-group">
            <select name="pid" id="">
                <option value="">--选择上级菜单--</option>
                <option value="0">顶级菜单</option>
                @foreach($navs as $lnav)
                    <option value="{{$lnav->id}}" {{$lnav->id==$nav->pid?"selected":""}}>{{$lnav->name}}</option>
                @endforeach
            </select>

        </div>

        <label class="col-xs-2 control-label">添加权限</label>
        <div class="form-group">
            <select name="permission_id" id="">
                <option value="">--选择权限--</option>
                @foreach($permissions as $permission)
                    <option value="{{$permission->id}}" {{$permission->id==$nav->permission_id?"selected":""}}>{{$permission->name}}</option>
                @endforeach
            </select>
        </div>
        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
@endsection
