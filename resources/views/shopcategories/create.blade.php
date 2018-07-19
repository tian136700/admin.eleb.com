@extends('default')
@section("contents")
    <form action="{{route("shopcategories.store")}}" method="post" enctype="multipart/form-data">
        <h1>添加商家分类</h1>
        @include("_errors")
        <label>分类名称</label>
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="{{old("name")}}"/>
        </div>
        <label>	状态</label>
        <div class="form-group" style="width: 200px">
            <select name="status" id="" class="form-control">
                <option value="1">显示</option>
                <option value="0">隐藏</option>
            </select>
        </div>
        <label>分类图片</label>
        <input type="file" name="img" value="{{old("img")}}"/>
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
@endsection