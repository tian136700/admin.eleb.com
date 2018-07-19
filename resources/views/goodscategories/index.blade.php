@extends('default')
@section("contents")
    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>商品分类名称</th>
            <th>操作</th>
        </tr>
        @foreach($goodscategories as $goodscategory)
            <tr>
                <td>{{$goodscategory->id}}</td>

                <td>{{$goodscategory->name}}</td>
                <td>
                    <a href="{{route("goodscategories.edit",["goodscategory"=>$goodscategory])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                    <form style="margin:0px;display:inline;"  action="{{route("goodscategories.destroy",["goodscategory"=>$goodscategory])}}"  method="post">

                        {{ method_field('DELETE') }}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>
                    </form>

                </td>
            </tr>
            @endforeach
        <tr><td colspan="5"><a href="{{route("goodscategories.create")}}">
                    <button class="btn btn-primary" type="submit">新增数据</button>
                </a></td></tr>
    </table>
    @endsection