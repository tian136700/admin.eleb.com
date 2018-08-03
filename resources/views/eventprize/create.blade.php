@extends('default')

@section("contents")
    <table>
    <form action="{{route("eventprizes.store")}}" method="post" class="form-horizontal">
        {{--<table class="table table-bordered table-responsive">--}}

        <h1>添加抽奖活动奖品</h1>

        @include("_errors")
        <label class="col-xs-2 control-label">活动名称</label>
        <div class="form-group">
            <select name="events_id" id="">
                @foreach($events as $event)
                <option value="{{$event->id}}">{{$event->title}}</option>
                @endforeach
            </select>

        </div>

        <label class="col-xs-2 control-label">奖品名称</label>
        <div class="form-group">

            <input type="text" name="name" style="width: 500px" class="form-control" value="{{old("name")}}"/>
        </div>
        <label class="col-xs-2 control-label">奖品详情</label>
        <div class="form-group">
            <textarea name="description" id="" cols="70" rows="10"></textarea>

        </div>



        {{csrf_field()}}
        <button class="btn btn-primary btn-large col-md-offset-3" style="width: 300px">提交</button>
    </form>
        </table>

@endsection
