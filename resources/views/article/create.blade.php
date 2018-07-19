@extends('default')
@section("contents")
    <form action="{{route("articles.store")}}" method="post" enctype="multipart/form-data">
        <h1>添加文章</h1>
        @include("_errors")
        <label>标题</label>
        <div class="form-group">
            <input type="text" name="title" class="form-control" value="{{old("title")}}"/>
        </div>
        <label for="">分类</label>
        <div class="form-group" style="width: 500px">
            <select name="categories_id" id="" class="form-control">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>

        </div>
        {{--<label>文章作者</label>--}}
        {{--<div class="form-group" style="width: 500px">--}}
            {{--<select name="author_id" id="" class="form-control">--}}
                {{--@foreach($students as $student)--}}
                    {{--<option value="{{$student->id}}">{{$student->name}}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}
        <label>文章图片</label>
        <div class="form-group">
            <input type="file" name="logo"/>

        </div>
        <label>内容</label>
        <div class="form-group">
            <textarea name="content" class="form-control" rows="10">{{old("content")}}</textarea>
        </div>
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
@endsection