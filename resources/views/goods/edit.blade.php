@extends('default')
@section("contents")
    <form action="{{route("goods.update",[$good])}}" method="post" enctype="multipart/form-data">
        <h1>修改商品</h1>
        @include("_errors")
        <label>商品名称</label>
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="@if(old("name")){{old("name")}}@else{{$good->name}}@endif"/>
        </div>
        <label>商品分类</label>
        <div class="form-group">
            <select name="cate_id" id="" class="form-control">
                @foreach($categories as $category)
                    <option value="{{$category->id}}"  {{$good->cate_id==$category->id?"selected":""}}>{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <label>商品价格</label>
        <div class="form-group">
            <input type="text" name="price" class="form-control" value="@if(old("price")){{old("price")}}@else{{$good->price}}@endif"/>
        </div>
        <label>上下架</label>
        <div class="form-group">
            <select name="is_sale" id="" class="form-control">
                    <option value="1" {{$good->is_sale==1?"selected":""}}>上架</option>
                    <option value="0" {{$good->is_sale==0?"selected":""}}>下架</option>
            </select>
        </div>
        <label>商品图片</label>
        <div class="form-group">
            <input type="file" name="logo"/>
            <img width="100" height="100" src="{{\Illuminate\Support\Facades\Storage::url($good->logo)}}" alt="">

        </div>
        <label>商品详细信息</label>
        <div class="form-group">
            <textarea name="info" class="form-control" rows="5">@if(old("info")){{old("info")}}@else{{$good->info}}@endif</textarea>
        </div>
        {{csrf_field()}}
        {{ method_field('PATCH') }}
        <button class="btn btn-primary">提交</button>
    </form>
@endsection