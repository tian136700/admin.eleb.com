@extends("default")
@section("contents")
    <table class="table table-bordered table-responsive">
        <tr class="text-center">
            <td colspan="7"><label>名称</label></td>
        </tr>
        <tr>

            <td colspan="7">{{$activity->title}}</td>
        </tr>
        <tr class="text-center">
            <td colspan="7"><label>活动开始时间</label></td>
        </tr>
        <tr>

            <td colspan="7">{{$activity->start_time}}</td>
        </tr><tr class="text-center">
            <td colspan="7"><label>活动结束时间</label></td>
        </tr>
        <tr>

            <td colspan="7">{{$activity->end_time}}</td>
        </tr>

        <tr class="text-center">
            <td colspan="7"><label>活动详情</label></td>
        </tr>
        <tr>
            <td colspan="7">{!! $activity->content !!}</td>
        </tr>


    </table>
@stop