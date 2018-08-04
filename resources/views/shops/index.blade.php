@extends('default')
@section("contents")
    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>店铺名称</th>
            <th>店铺分类</th>
            <th>店铺图片</th>
            <th>评分</th>
            <th>起送金额</th>
            <th>配送费</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>

                <td>{{$shop->shop_name}}</td>
                <td>{{$shop->category->name}}</td>
                <td><img width="50" height="50" src="{{$shop->shop_img}}" alt=""></td>
                <td>{{$shop->shop_rating}}</td>
                <td>{{$shop->start_send}}</td>
                <td>{{$shop->send_cost}}</td>
                <td>{{$shop->status==1?"正常":($shop->status==0?"待审核":"禁用")}}</td>

                {{--<td><img width="100" height="100" src="{{\Illuminate\Support\Facades\Storage::url($shop->logo)}}" alt=""></td>--}}
                <td>
{{--                    <a href="{{route("shops.show",["article"=>$article])}}">查看</a>--}}
                    <a href="{{route("shops.show",["shop"=>$shop])}}"><button class="btn btn-success btn-xs"><span>查看</span></button></a>
                    {{--编辑--}}
                    {{--@can("editshop")--}}
                    <a href="{{route("shops.edit",["shop"=>$shop])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                    {{--@endcan--}}
                    <form  style="margin:0px;display:inline;" action="{{route("shops.destroy",["shop"=>$shop])}}"  method="post">
                        {{ method_field('DELETE') }}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>

                    </form>
                    <a href="{{route("shops.review",["shop"=>$shop])}}"><button class="btn btn-warning btn-xs"><span>商家审核</span></button></a>
                    <a href="{{route("shops.reset",["shop"=>$shop])}}"><button class="btn btn-danger btn-xs"><span>重置密码</span></button></a>
                </td>

            </tr>
            @endforeach
        <tr><td colspan="9"><a href="{{route("shops.create")}}">
                    <button class="btn btn-primary" type="submit">新增数据</button>
                </a></td></tr>
    </table>

    {{$shops->links()}}
    @endsection