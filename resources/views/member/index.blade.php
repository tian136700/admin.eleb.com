@extends('default')
@section("contents")
    <div class="row" style="float: left;width: 70%;">
        <form action="{{route("members.index")}}" method="get">
            <div class="col-xs-4">
                <input type="text" class="form-control" name="username" placeholder="查询会员">
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
    </div>
    <br>&emsp;&emsp;&emsp;&emsp;
    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>电话</th>
            <th>创建时间</th>
            <th>最后修改时间</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
            <tr>
                <td>{{$member->id}}</td>
                <td>{{$member->username}}</td>
                <td>{{$member->tel}}</td>
                <td>{{$member->created_at}}</td>
                <td>{{$member->updated_at}}</td>


                <td>
                    <a href="{{route("members.show",["member"=>$member])}}"><button class="btn btn-success btn-xs"><span>查看</span></button></a>
                    @if($member->status==1)
                    <a href="{{route("members.disable",["member"=>$member,"status"=>1])}}"><button class="btn  btn-danger btn-xs"><span>禁用</span></button></a>
@else
                        <a href="{{route("members.disable",["member"=>$member,"status"=>0])}}"><button class="btn btn-primary btn-xs"><span>启用</span></button></a>
@endif
                </td>
            </tr>
            @endforeach
    </table>
    {{ $members->appends($keyword)->links() }}
    @endsection