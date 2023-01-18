@extends('frontend.layouts.master')
@section('title',$category->name.' Kategorisi için | '.count($articles).' Adet Yazı')
@section('bg','https://zerdasoftware.com/wp-content/uploads/2023/01/android_f.jpg')
@section('content')
    <div class="col-md-9 col-lg-9 col-xl-7">
        @if(count($articles)>0)
            @include('frontend.widgets.articleWidget')
        @else
            <div class="alert alert-danger"><h4 class="text-center">{{$category->name}} Kategorisine ait yazı bulunamadı</h4></div>
        @endif
    </div>
    @include('frontend.widgets.categoryWidget')
@endsection
