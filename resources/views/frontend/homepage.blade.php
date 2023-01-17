@extends('frontend.layouts.master')
@section('title','Anasayfa')
@section('bg','https://zerdasoftware.com/wp-content/uploads/2023/01/android_e.jpg')
@section('content')
        <div class="col-md-9 col-lg-9 col-xl-7">
            @foreach($articles as $article)

                <!-- Featured blog post-->
                <div class="card mb-4">
                    <a href="#!"><img class="card-img-top" src="{{$article->image}}" alt="..." /></a>
                    <div class="card-body">
                        <div class="small text-muted">{{$article->created_at->diffForHumans()}}
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{$article->getCategory->name}} </a>
                            <span class="badge bg-info text-white"><i class="fa-solid fa-eye"></i>  {{$article->hit}}</span>
                        </div>
                        <h2 class="card-title">{{$article->title}}</h2>
                        <p class="card-text">{{\Illuminate\Support\Str::limit($article->content,150)}}</p>
                        <a class="btn btn-primary" href="{{route('single',[$article->getCategory->slug,$article->slug])}}">Devamını Oku →</a>
                    </div>
                </div>
            <!-- Divider-->
            @if(!$loop->last)
            <hr class="my-4" />
                @endif
            @endforeach
        </div>
    @include('frontend.widgets.category')
@endsection
