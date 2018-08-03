@extends('default')
@section("contents")
    <h1>抽奖活动奖品管理</h1>
    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>活动名称</th>
            <th>奖品名称</th>
            <th>奖品详情</th>
            <th>中奖商家账号id</th>

            <th>操作</th>
        </tr>
        @foreach($eventprizes as $eventprize)
            <tr>
                <td>{{$eventprize->id}}</td>

                <td>{{$eventprize->event->title}}</td>
                <td>{{$eventprize->name}}</td>
                <td>{{$eventprize->description}}</td>
                <td>{{$eventprize->member_id}}</td>
<td>

                    {{--编辑--}}
    
                    <a href="{{route("eventprizes.edit",["eventprize"=>$eventprize])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                    <form  style="margin:0px;display:inline;" action="{{route("eventprizes.destroy",["eventprize"=>$eventprize])}}"  method="post">
                        {{ method_field('DELETE') }}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>

                    </form>

                </td>

            </tr>
            @endforeach
        <tr><td colspan="9"><a href="{{route("eventprizes.create")}}">
                    <button class="btn btn-primary" type="submit">新增奖品</button>
                </a></td></tr>
    </table>

    {{$eventprizes->links()}}
    @endsection