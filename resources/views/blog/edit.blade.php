@extends("default")
@section("contents")
<form action="{{route("editBlog")}}" method="post">
    <input type="hidden" name="id" value="{{$row->id}}">
    标题：<input type="text" name="title" value="{{$row->title}}"><br>
    内容：<textarea name="content" id="" cols="50" rows="20">{{$row->content}}</textarea><br>
    {{csrf_field()}}
    <input type="submit">
</form>
    @endsection