@extends('default')
@section("contents")
    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>描述</th>

            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->id}}</td>

                <td>{{$role->name}}</td>
                <td>{{$role->guard_name}}</td>
<td>
                    {{--编辑--}}
                    <a href="{{route("roles.edit",["role"=>$role])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                    <form  style="margin:0px;display:inline;" action="{{route("roles.destroy",["role"=>$role])}}"  method="post">
                        {{ method_field('DELETE') }}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>

                    </form>

                </td>

            </tr>
            @endforeach
        <tr><td colspan="9"><a href="{{route("roles.create")}}">
                    <button class="btn btn-primary" type="submit">新增角色</button>
                </a></td></tr>
    </table>

    {{$roles->links()}}
    @endsection