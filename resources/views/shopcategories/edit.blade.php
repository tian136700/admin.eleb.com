@extends('default')
@section("contents")
    <form action="{{route("shopcategories.update",[$shopcategory])}}" method="post">
        <h1>修改商家分类</h1>
        @include("_errors")
        <label>分类名称</label>
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="@if(old("name")){{old("name")}}@else{{$shopcategory->name}}@endif"/>
        </div>
        <label>	状态</label>
        <div class="form-group" style="width: 200px">
            <select name="status" id="" class="form-control">
                <option value="1" {{$shopcategory->is_sale==1?"selected":""}}>显示</option>
                <option value="0"  {{$shopcategory->is_sale==0?"selected":""}}>隐藏</option>
            </select>
        </div>
        <label>图片</label>
        <div class="form-group">
            <input type="file" name="logo"/>
            <img width="100" height="100" src="{{\Illuminate\Support\Facades\Storage::url($shopcategory->logo)}}" alt="">

        </div>
        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
    @endsection