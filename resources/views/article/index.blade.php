@extends('default')
@section("contents")
    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th>图片</th>
            <th>操作</th>
        </tr>
        @foreach($articles as $article)
            <tr>
                <td>{{$article->id}}</td>
                <td>{{$article->title}}</td>
                <td>{{$article->student->name}}</td>
                <td>{{$article->category->name}}</td>
                <td><img width="100" height="100" src="{{\Illuminate\Support\Facades\Storage::url($article->logo)}}"
                         alt=""></td>
                <td>
{{--                    <a href="{{route("articles.show",["article"=>$article])}}">查看</a>--}}
                    <a href="{{route("articles.show",["article"=>$article])}}"><button class="btn btn-success btn-xs"><span>查看</span></button></a>
                    {{--编辑--}}
                    @if($article->author_id==auth()->user()->id)
                    <a href="{{route("articles.edit",["article"=>$article])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                    <form  style="margin:0px;display:inline;" action="{{route("articles.destroy",["article"=>$article])}}"  method="post">
                        {{ method_field('DELETE') }}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>
@endif
                    </form>

                </td>
            </tr>
            @endforeach
        <tr><td colspan="6"><a href="{{route("articles.create")}}">
                    <button class="btn btn-primary" type="submit">新增数据</button>
                </a></td></tr>
    </table>

    {{$articles->links()}}
    @endsection