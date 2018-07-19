@extends('default')
@section("contents")
    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>所属商家</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($shopusers as $shopuser)
            <tr>
                <td>{{$shopuser->id}}</td>
                <td>{{$shopuser->name}}</td>
                <td>{{$shopuser->email}}</td>
                <td>{{$shopuser->category->shop_name}}</td>
                <td>{{$shopuser->status==1?"启用":"禁用"}}</td>
<td>
{{--                    <a href="{{route("users.show",["article"=>$article])}}">查看</a>--}}
                    <a href="{{route("shopusers.show",["shopuser"=>$shopuser])}}"><button class="btn btn-success btn-xs"><span>查看</span></button></a>
                    {{--编辑--}}
                    <a href="{{route("shopusers.edit",["user"=>$shopuser])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                    <form  style="margin:0px;display:inline;" action="{{route("shopusers.destroy",["user"=>$shopuser])}}"  method="post">
                        {{ method_field('DELETE') }}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>
</td>
                    </form>

                </td>
            </tr>
            @endforeach
        <tr><td colspan="6"><a href="{{route("shops.create")}}">
                    <button class="btn btn-primary" type="submit">新增数据</button>
                </a></td></tr>
    </table>

    {{$shopusers->links()}}
    @endsection