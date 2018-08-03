@extends('default')
@section("contents")
    <form action="{{route("eventprizes.update",[$eventprize])}}" method="post">
        <h1>修改抽奖活动奖品</h1>
        @include("_errors")
        <label class="col-xs-2 control-label">活动名称</label>
        <div class="form-group">
            <div class="form-group">
                <select name="events_id" id="">
                    @foreach($events as $event)
                        <option value="{{$event->id}}"  {{$event->id==$eventprize->event->id?"selected":""}}>{{$event->title}}</option>
                    @endforeach
                </select>
        </div>
            <label class="col-xs-2 control-label">奖品名称</label>
            <div class="form-group">
                <input type="text" name="name" style="width: 500px" class="form-control"
                       value="@if(old("name")){{old("name")}}@else{{$eventprize->name}}@endif"/>
            </div>
        <label class="col-xs-2 control-label">奖品详情</label>
        <div class="form-group">
            <textarea name="description" id="" cols="70" rows="10">@if(old("description")){{old("description")}}@else{{$eventprize->description}}@endif</textarea>
            
        </div>

      
        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
            </div>
    </form>
    </div>
@endsection
