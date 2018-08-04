@extends('default')

@section("contents")
    <table>
        <form action="{{route("events.store")}}" method="post" class="form-horizontal">
            {{--<table class="table table-bordered table-responsive">--}}

            <h1>添加抽奖</h1>

            @include("_errors")
            <label class="col-xs-2 control-label">名称</label>
            <div class="form-group">

                <input type="text" name="title" style="width: 500px" class="form-control" value="{{old("title")}}"/>
            </div>
            <label class="col-xs-2 control-label">详情</label>
            <div class="form-group">
                <textarea name="content" id="" cols="70" rows="10">{{old("title")}}</textarea>
            </div>
            <label class="col-xs-2 control-label">报名开始时间</label>
            <div class="form-group">

                <input type="datetime-local" name="signup_start" style="width: 500px" class="form-control"
                       value="{{old("signup_start")}}"/>
            </div>
            <label class="col-xs-2 control-label">报名结束时间</label>
            <div class="form-group">

                <input type="datetime-local" name="signup_end" style="width: 500px" class="form-control"
                       value="{{old("signup_end")}}"/>
            </div>
            <label class="col-xs-2 control-label">开奖日期</label>
            <div class="form-group">

                <input type="datetime-local" name="prize_date" style="width: 500px" class="form-control"
                       value="{{old("prize_date")}}"/>
            </div>
            <label class="col-xs-2 control-label">报名人数限制</label>
            <div class="form-group">

                <input type="number" name="signup_num" style="width: 500px" class="form-control"
                       value="{{old("signup_num")}}"/>
            </div>


            {{csrf_field()}}
            <button class="btn btn-primary btn-large col-md-offset-3" style="width: 300px">提交</button>
        </form>
    </table>

@endsection
