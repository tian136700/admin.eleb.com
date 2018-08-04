@extends('default')
@section("contents")
    <form action="{{route("events.update",[$event])}}" method="post">
        <h1>修改抽奖</h1>
        @include("_errors")
        <label class="col-xs-2 control-label">名称</label>
        <div class="form-group">
            <input type="text" name="title" style="width: 500px" class="form-control"
                   value="@if(old("title")){{old("title")}}@else{{$event->title}}@endif"/>
        </div>
        <label class="col-xs-2 control-label">详情</label>
        <div class="form-group">
            <textarea name="content" id="" cols="70"
                      rows="10">@if(old("content")){{old("content")}}@else{{$event->content}}@endif</textarea>

        </div>
        <label class="col-xs-2 control-label">报名开始时间</label>
        <div class="form-group">
            <input type="datetime-local" name="signup_start"
                   value="{{date("Y-m-d",$event->signup_start)."T".date("H:i",$event->signup_start)}}">
        </div>

        {{--<input type="datetime-local" name="test">--}}
        <label class="col-xs-2 control-label">报名结束时间</label>
        <div class="form-group">
            <input type="datetime-local" name="signup_end"
                   value="{{date("Y-m-d",$event->signup_end)."T".date("H:i",$event->signup_end)}}"/>
        </div>
        <label class="col-xs-2 control-label">开奖日期</label>
        <div class="form-group">
            <input type="datetime-local" name="prize_date"
                   value="{{date("Y-m-d",$event->prize_date)."T".date("H:i",$event->prize_date)}}"/>
        </div>
        <label class="col-xs-2 control-label">报名人数限制</label>
        <div class="form-group">
            <input type="number" name="signup_num" style="width: 200px" class="form-control"
                   value="@if(old("signup_num")){{old("signup_num")}}@else{{$event->signup_num}}@endif"/>
        </div>

        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
@endsection
