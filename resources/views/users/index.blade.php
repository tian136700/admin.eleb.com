@extends('default')
@section("contents")
    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>头像</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td><img width="100" height="100" src="{{\Illuminate\Support\Facades\Storage::url($user->logo)}}" alt=""></td>
                <td>
{{--                    <a href="{{route("users.show",["article"=>$article])}}">查看</a>--}}
                    <a href="{{route("users.show",["user"=>$user])}}"><button class="btn btn-success btn-xs"><span>查看</span></button></a>
                    {{--编辑--}}
                    <a href="{{route("users.edit",["user"=>$user])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                    <form  style="margin:0px;display:inline;" action="{{route("users.destroy",["user"=>$user])}}"  method="post">
                        {{ method_field('DELETE') }}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>

                    </form>

                </td>
            </tr>
            @endforeach
        <tr><td colspan="5"><a href="{{route("users.create")}}">
                    <button class="btn btn-primary" type="submit">新增数据</button>
                </a></td></tr>
    </table>

    {{$users->links()}}
    @endsection