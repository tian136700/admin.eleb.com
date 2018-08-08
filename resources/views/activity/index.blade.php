@extends('default')
@section("contents")

    <div>
        <p><a href="{{route("activityStatic")}}">一键生成或更新活动静态页</a></p>
        <ul class="nav nav-tabs">
            <li role="presentation"><a href="{{route("activities.index",["status"=>2])}}">全部</a></li>
            <li role="presentation" ><a href="{{route("activities.index",["status"=>1])}}">未结束</a></li>
            <li role="presentation"><a href="{{route("activities.index",["status"=>0])}}">已结束</a></li>

        </ul>
    <table class="table table-bordered table-responsive">
        <tr class="text-center">
            <th class="text-center">id</th>
            <th>活动名称</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>活动状态</th>

            <th>操作</th>
        </tr>
        @foreach($activities as $activity)
            <tr>
                <td>{{$activity->id}}</td>

                <td>{{$activity->title}}</td>
                <td>{{$activity->start_time}}</td>


                <td>{{$activity->end_time}}</td>
                <td>{{$activity->status==1?"未结束":"已结束"}}</td>

                <td>
                    <a href="{{route("activities.show",["activity"=>$activity])}}"><button class="btn btn-success btn-xs"><span>查看</span></button></a>
                    {{--编辑--}}
                    <a href="{{route("activities.edit",["activity"=>$activity])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                    <form  style="margin:0px;display:inline;" action="{{route("activities.destroy",["activity"=>$activity])}}"  method="post">
                        {{ method_field('DELETE') }}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>

                    </form>

                </td>
            </tr>
            @endforeach
        <tr><td colspan="9"><a href="{{route("activities.create")}}">
                    <button class="btn btn-primary" type="submit">新增数据</button>
                </a></td></tr>
    </table>
    </div>

    {{$activities->links()}}
    @endsection