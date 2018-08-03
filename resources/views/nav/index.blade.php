@extends('default')
@section("contents")
    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>菜单名称</th>
            <th>上级菜单</th>
            <th>路由地址</th>
            <th>权限</th>
            <th>操作</th>
        </tr>
        @foreach($navs as $nav)
            <tr>
                <td>{{$nav->id}}</td>
                <td>{{$nav->name}}</td>
                <td>{{$nav->pid}}</td>
                <td>{{$nav->url}}</td>
                <td>{{$nav->permission->name}}</td>

                <td>
                    {{--编辑--}}
                    <a href="{{route("navs.edit",["nav"=>$nav])}}">
                        <button class="btn btn-primary btn-xs"><span>编辑</span></button>
                    </a>
                    <form style="margin:0px;display:inline;" action="{{route("navs.destroy",["nav"=>$nav])}}"
                          method="post">
                        {{ method_field('DELETE') }}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>

                    </form>

                </td>

            </tr>
        @endforeach
        <tr>
            <td colspan="9"><a href="{{route("navs.create")}}">
                    <button class="btn btn-primary" type="submit">新增菜单</button>
                </a></td>
        </tr>
    </table>
    {{$navs->links()}}
@endsection