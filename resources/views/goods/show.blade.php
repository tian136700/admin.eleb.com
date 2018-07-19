@extends("default")
@section("contents")
    <table class="table table-bordered table-responsive">
        <tr class="text-center"><td><label>商品名称</label></td></tr>
        <tr>
            <td>{{$good->name}}</td> 
        </tr>
        <tr class="text-center"><td><label>商品分类</label></td></tr>
        <tr>
            <td>{{$good->category->name}}</td> 
        </tr>
        <tr class="text-center"><td><label>商品价格</label></td></tr>
        <tr>
            <td>{{$good->price}}</td> 
        </tr>
        <tr class="text-center"><td><label>上下架</label></td></tr>
        <tr>
            <td>{{$good->is_sale=="1"?"上架":"下架"}}</td> 
        </tr>
        <tr class="text-center"><td><label>详细信息</label></td></tr>
        <tr>
            <td>{{$good->info}}</td>
        </tr>
        <tr class="text-center"><td><label>商品图片</label></td></tr>
        <tr>
            <td><img width="100" height="100" src="{{\Illuminate\Support\Facades\Storage::url($good->logo)}}" alt=""></td>
        </tr>
    </table>
@stop