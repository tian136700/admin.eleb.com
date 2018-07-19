@extends('default')
@section("contents")
    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>商品名称</th>
            <th>商品分类</th>
            <th>价格</th>
            <th>是否上架</th>
            <th>商品图片</th>
            <th>商品浏览次数</th>
            <th>操作</th>
        </tr>
        @foreach($goods as $good)
            <tr>
                <td>{{$good->id}}</td>

                <td>{{$good->name}}</td>

                <td>{{$good->category->name}}</td>
                <td>{{$good->price}}</td>
                <td>{{$good->is_sale=="1"?"上架":"下架"}}</td>
                <td><img width="100" height="100" src="{{\Illuminate\Support\Facades\Storage::url($good->logo)}}"
                         alt=""></td>
                <td>{{$good->num}}</td>
                <td>
                    <a href="{{route("goods.show",["good"=>$good])}}">
                        <button class="btn btn-success btn-xs"><span>查看</span></button>
                    </a>
                    <a href="{{route("goods.edit",["good"=>$good])}}">
                        <button class="btn btn-primary btn-xs"><span>编辑</span></button>
                    </a>
                    <form style="margin:0px;display:inline;" action="{{route("goods.destroy",["good"=>$good])}}"
                          method="post">
                        {{ method_field('DELETE') }}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>

                    </form>

                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="8"><a href="{{route("goods.create")}}">
                    <button class="btn btn-primary" type="submit">新增数据</button>
                </a></td>
        </tr>
    </table>
    @if(empty($name))
        {{$goods->links()}}
    @else
        {{$goods->appends(['name'=>$name])->links()}}
    @endif


@endsection