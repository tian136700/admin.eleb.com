@extends('default')
@section("contents")
    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>描述</th>

            <th>操作</th>
        </tr>
        @foreach($permissions as $permission)
            <tr>
                <td>{{$permission->id}}</td>

                <td>{{$permission->name}}</td>
                <td>{{$permission->guard_name}}</td>
<td>
                    {{--编辑--}}
                    <a href="{{route("permissions.edit",["permission"=>$permission])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                    <form  style="margin:0px;display:inline;" action="{{route("permissions.destroy",["permission"=>$permission])}}"  method="post">
                        {{ method_field('DELETE') }}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>

                    </form>

                </td>

            </tr>
            @endforeach
        <tr><td colspan="9"><a href="{{route("permissions.create")}}">
                    <button class="btn btn-primary" type="submit">新增权限</button>
                </a></td></tr>
    </table>

    {{$permissions->links()}}
    @endsection