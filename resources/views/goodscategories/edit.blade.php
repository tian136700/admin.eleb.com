@extends('default')
@section("contents")
    <form action="{{route("goodscategories.update",[$goodscategory])}}" method="post">
        <h1>修改商品分类</h1>
        @include("_errors")
        <label>分类名称</label>
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="@if(old("name")){{old("name")}}@else{{$goodscategory->name}}@endif"/>
        </div>

        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
    @endsection