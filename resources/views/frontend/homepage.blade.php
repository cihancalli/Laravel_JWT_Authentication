@extends('frontend.layouts.master')
@section('title','Anasayfa')
@section('bg','https://zerdasoftware.com/wp-content/uploads/2023/01/android_e.jpg')
@section('content')
    <div class="col-md-9 col-lg-9 col-xl-7">
        @include('frontend.widgets.articleWidget')
    </div>
    @include('frontend.widgets.categoryWidget')
@endsection
