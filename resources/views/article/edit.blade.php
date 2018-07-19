@extends('default')
@section("contents")
    <form action="{{route("articles.update",[$article])}}" method="post" enctype="multipart/form-data">
        <h1>修改文章</h1>
        @include("_errors")
        <label>标题</label>
        <div class="form-group">
            <input type="text" name="title" class="form-control" value="@if(old("title")){{old("title")}}@else{{$article->title}}@endif"/>
        </div>
        <label>类别</label>
        <div class="form-group">
            <select name="categories_id" id="" class="form-control">
                @foreach($categories as $category)
                    <option value="{{$category->id}}"  {{$article->categories_id==$category->id?"selected":""}}>{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        {{--<label>作者</label>--}}
        {{--<div class="form-group">--}}
            {{--<select name="author_id" id="" class="form-control">--}}
                {{--@foreach($students as $student)--}}
                    {{--<option value="{{$student->id}}">{{$student->name}}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}
        <label>图片</label>
        <div class="form-group">
            <input type="file" name="logo"/>
            <img width="100" height="100" src="{{\Illuminate\Support\Facades\Storage::url($article->logo)}}" alt="">
            </div>
        <label>内容</label>
        <div class="form-group">
            <textarea name="content" class="form-control" rows="5" >@if(old("content")){{old("content")}}@else{{$article->content}}@endif</textarea>
        </div>

        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <button class="btn btn-primary">提交</button>
    </form>
    @endsection