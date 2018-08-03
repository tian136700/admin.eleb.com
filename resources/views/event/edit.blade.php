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
            <textarea name="content" id="" cols="70" rows="10">@if(old("content")){{old("content")}}@else{{$event->content}}@endif</textarea>
            
        </div>
        <label class="col-xs-2 control-label">报名开始时间</label>
        <div class="form-group">
            <input type="datetime-local" name="signup_start" style="width: 500px" class="form-control"
                   value="@if(old("signup_start")){{old("signup_start")}}@else{{date("Y-m-d",strtotime($event->signup_start))}}@endif"/>
        </div>
        <label class="col-xs-2 control-label">报名结束时间</label>
        <div class="form-group">
            <input type="datetime-local" name="signup_start" style="width: 500px" class="form-control"
                   value="@if(old("signup_end")){{old("signup_end")}}@else{{date("Y-m-d",strtotime($event->signup_end))}}@endif"/>
        </div>
        <label class="col-xs-2 control-label">开奖日期</label>
        <div class="form-group">
            <input type="datetime-local" name="prize_date" style="width: 500px" class="form-control"
                   value="@if(old("prize_date")){{old("prize_date")}}@else{{$event->prize_date}}@endif"/>
        </div>
        <label class="col-xs-2 control-label">报名人数限制</label>
        <div class="form-group">
            <input type="number" name="signup_num" style="width: 500px" class="form-control"
                   value="@if(old("signup_num")){{old("signup_num")}}@else{{$event->signup_num}}@endif"/>
        </div>
      
        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
@endsection
