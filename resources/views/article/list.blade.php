@extends('default')
@section("contents")
    @foreach($articles as $article)
        <h2>{{$article->title}}</h2><br>
        <p>作者：<a href="{{route("blog.list",["author_id"=>$article->author_id])}}">{{$article->student->name}}</a>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;时间：{{$article->created_at}} &emsp; &emsp; &emsp; &emsp;分类：
            <a href="{{route("blog.list",["categories_id"=>$article->categories_id])}}">{{$article->category->name}}</a></p>
        <div>
            <p>{{mb_substr($article->content,1,100)}} <a href="{{route("articles.show",$article)}}">更多.....</a></p>
        </div><br>
    @endforeach
    @if(empty($title))
        {{$articles->links()}}
    @else
        {{$articles->appends(['title'=>$title])->links()}}
    @endif
    {{--@if(empty($categories_id))--}}
        {{--{{$articles->links()}}--}}
    {{--@else--}}
        {{--{{$articles->appends(['categories_id'=>$categories_id])->links()}}--}}
    {{--@endif--}}
@endsection