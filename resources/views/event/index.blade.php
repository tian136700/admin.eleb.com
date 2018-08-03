@extends('default')
@section("contents")
    <h1>抽奖活动管理</h1>
    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖日期</th>
            <th>报名人数限制</th>
            <th>是否已开奖</th>

            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{$event->id}}</td>

                <td>{{$event->title}}</td>
                <td>{{$event->signup_start}}</td>
                <td>{{$event->signup_end}}</td>
                <td>{{$event->prize_date}}</td>
                <td>{{$event->signup_num}}</td>
                <td>{{$event->is_prize==1?"已开奖":"未开奖"}}</td>
<td>
    <a href="{{route("events.show",["event"=>$event])}}"><button class="btn btn-success btn-xs"><span>查看</span></button></a>
                    {{--编辑--}}
    
                    <a href="{{route("events.edit",["event"=>$event])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                    <form  style="margin:0px;display:inline;" action="{{route("events.destroy",["event"=>$event])}}"  method="post">
                        {{ method_field('DELETE') }}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>

                    </form>
    {{--<a href="{{route("events.start",["event"=>$event])}}"><button class="btn btn-success btn-xs"><span>进入抽奖</span></button></a>--}}
                </td>

            </tr>
            @endforeach
        <tr><td colspan="9"><a href="{{route("events.create")}}">
                    <button class="btn btn-primary" type="submit">新增抽奖</button>
                </a></td></tr>
    </table>

    {{$events->links()}}
    @endsection