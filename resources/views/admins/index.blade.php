@extends('default')
@section("contents")
    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>email</th>
            <th>创建时间</th>
            <th>修改时间</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->id}}</td>

                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>{{$admin->created_at}}</td>
                <td>{{$admin->updated_at}}</td>
                <td>
                    <a href="{{route("admins.edit",["admin"=>$admin])}}">
                        <button class="btn btn-primary btn-xs"><span>编辑</span></button>
                    </a>
                    <form style="margin:0px;display:inline;" action="{{route("admins.destroy",["admin"=>$admin])}}"
                          method="post">
                        {{ method_field('DELETE') }}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>

                    </form>

                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6"><a href="{{route("admins.create")}}">
                    <button class="btn btn-primary" type="submit">新增数据</button>
                </a></td>
        </tr>
    </table>
@endsection