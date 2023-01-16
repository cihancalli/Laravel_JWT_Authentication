@extends('frontend.layouts.master')
@section('title','Anasayfa')
@section('content')
        <div class="col-md-9 col-lg-9 col-xl-7">
            @foreach($articles as $article)
            <!-- Post preview-->
            <div class="post-preview">
                <a href="post.html">
                    <h2 class="post-title">{{$article->title}}</h2>
                    <h3 class="post-subtitle">{{\Illuminate\Support\Str::limit($article->content,150)}}</h3>
                </a>
                <p class="post-meta">Kategori: <a href="#!">{{$article->getCategory->name}}</a>
                    <span style="float: right">{{$article->created_at->diffForHumans()}}</span>
                </p>

            </div>
            <!-- Divider-->
            @if(!$loop->last)
            <hr class="my-4" />
                @endif
            @endforeach
        </div>
    @include('frontend.widgets.category')
@endsection
