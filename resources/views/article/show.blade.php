@extends("default")
@section("contents")
    <h2>{{$article->title}}</h2><br>
    <p>作者：{{$article->author_id}}&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;时间：{{$article->created_at}} &emsp; &emsp; &emsp; &emsp;分类：新闻</p>
    <div>
        <p><img width="500" height="500" src="{{\Illuminate\Support\Facades\Storage::url($article->logo)}}"
                alt=""></p>
        <p>{{$article->content}}</p>

    </div>
@stop