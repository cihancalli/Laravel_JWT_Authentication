@extends('frontend.layouts.master')
@section('title',$article->title)
@section('pageTitle',$article->getCategory->name)
@section('bg',$article->image)
@section('content')
    <!-- Post Content-->
    <div class="col-md-9 col-lg-9 col-xl-7">

        <!-- Post content-->
        <article>
            <!-- Post header-->
            <header class="mb-4">
                <!-- Post title-->
                <h1 class="fw-bolder mb-1">{{$article->title}}</h1>
                <!-- Post meta content-->
                <div class="text-muted fst-italic mb-2">{{$article->created_at->diffForHumans()}}</div>
                <!-- Post categories-->
                <a class="badge bg-secondary text-decoration-none link-light"
                   href="#!">{{$article->getCategory->name}} </a>
                <span class="badge bg-info text-white" style="float: right"><i class="fa-solid fa-eye"></i> {{$article->hit}}</span>
            </header>
            <!-- Preview image figure-->
            <figure class="mb-4"><img class="img-fluid rounded" src="{{$article->image}}" alt="..."/></figure>
            <!-- Post content-->
            <section class="mb-5">{{$article->content}}</section>
        </article>


    </div>
    @include('frontend.widgets.categoryWidget')
@endsection
