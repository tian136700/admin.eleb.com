@extends('default')
@section("contents")
    <form action="{{route("goodscategories.store")}}" method="post">
        <h1>添加商品分类</h1>
        @include("_errors")
        <label>分类名称</label>
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="{{old("name")}}"/>
        </div>
        <label>	状态</label>
        <div class="form-group">
            <select name="is_sale" id="" class="form-control">
                <option value="1">显示</option>
                <option value="0">隐藏</option>
            </select>
        </div>
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
@endsection