@extends("default")
@section("contents")
<table class="table">
    <tr>
        <td>id</td>
        <td>文章标题</td>
        <td>内容简介</td>
        <td>操作</td>
    </tr>
    @foreach($blogs as $blog)
    <tr>
        <td>{{$blog->id}}</td>
        <td>{{$blog->title}}</td>
        <td>{{$blog->content}}</td>
        <td><a href="{{route("editView")}}?id={{$blog->id}}">编辑</a> <a href="{{route("deleteBlog")}}?id={{$blog->id}}">删除</a></td>
    </tr>
    @endforeach
</table>
<a href="{{route("addBlog")}}">
    <button class="btn btn-primary" type="submit">新增数据</button>
    </a>
    @endsection