@extends("default")
@section("contents")
    <table class="table table-bordered table-responsive">
        <tr class="text-center">
            <td colspan="7"><label>名称</label></td>
        </tr>
        <tr>

            <td colspan="7">{{$event->title}}</td>
        </tr>
        <tr class="text-center">
            <td colspan="7"><label>详情</label></td>
        </tr>
        <tr>
            <td colspan="7">{{$event->content}}</td>
        </tr>

        <tr class="text-center">
            <td colspan="7"><label>报名开始时间</label></td>
        </tr>
        <tr>
            <td colspan="7">{{date("Y-m-d H:i",$event->signup_start)}}</td>
        </tr>

        <tr class="text-center">
            <td colspan="3"><label>报名结束时间</label></td>
            <td colspan="4">开奖日期</td>
        </tr>
        <tr class="text-center">
            <td colspan="3">{{date("Y-m-d H:i",$event->signup_end)}}</td>
            <td colspan="4">{{date("Y-m-d H:i",$event->prize_date)}}</td>
        </tr>

        <tr class="text-center">
            <td colspan="7"><label>报名人数限制</label></td>
        </tr>
        <tr>
            <td colspan="7">{{$event->signup_num}}</td>
        </tr>
        <tr class="text-center">
            <td colspan="7"><label>是否已开奖</label></td>
        </tr>
        <tr>
            <td colspan="7">{{$event->is_prize==1?"已开奖":"未开奖"}}</td>
        </tr>
        @if($event->is_prize!=1)
            <tr class="text-center">
                <td colspan="9">
                    <a href="{{route("events.eventresult",["event"=>$event])}}">
                        <button class="btn btn-danger btn-lg"><span>抽奖</span></button>
                    </a>
                </td>
            </tr>
        @endif
    </table>
@stop