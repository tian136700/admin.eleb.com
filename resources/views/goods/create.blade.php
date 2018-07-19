@extends('default')
@section("contents")
    <form action="{{route("goods.store")}}" method="post" enctype="multipart/form-data">
        <h1>添加商品</h1>
        @include("_errors")
        <label>商品名称</label>
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="{{old("name")}}"/>
        </div>
        <label>商品分类</label>
        <div class="form-group">
            <select name="cate_id" id="" class="form-control">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <label>商品价格</label>
        <div class="form-group">
            <input type="text" name="price" class="form-control" value="{{old("price")}}"/>
        </div>
        <label>上下架</label>
        <div class="form-group">
            <select name="is_sale" id="" class="form-control">
                <option value="1">上架</option>
                <option value="0">下架</option>
            </select>
        </div>
        <label>商品图片</label>
        <div class="form-group">
            <input type="file" name="logo"/>
        </div>
        <label>商品详细信息</label>
        <div class="form-group">
            <textarea name="info" class="form-control" rows="5">{{old("info")}}</textarea>
        </div>

        <label>验证码</label>
        <div class="form-group">
            <input id="captcha" class="form-control" name="captcha">
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}"
                 onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>

    </form>
@endsection