@extends('default')
@section("contents")
    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>商家分类</th>
            <th>分类图片</th>
            <th>操作</th>
        </tr>
        @foreach($shopcategories as $shopcategory)
            <tr>
                <td>{{$shopcategory->id}}</td>

                <td>{{$shopcategory->name}}</td>
                <td><img width="50" height="50" src="{{\Illuminate\Support\Facades\Storage::url($shopcategory->img)}}" alt=""></td>

                <td>
                    <a href="{{route("shopcategories.edit",["shopcategory"=>$shopcategory])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                    <form style="margin:0px;display:inline;"  action="{{route("shopcategories.destroy",["shopcategory"=>$shopcategory])}}"  method="post">
                        {{ method_field('DELETE') }}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>

                    </form>

                </td>
            </tr>
            @endforeach
        <tr><td colspan="5"><a href="{{route("shopcategories.create")}}">
                    <button class="btn btn-primary" type="submit">新增数据</button>
                </a></td></tr>
    </table>
    @endsection