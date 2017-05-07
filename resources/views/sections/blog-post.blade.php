@extends('layouts.blog')

@section('title', $post->title)
@section('content')
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('{{ getPostImage($post) }}'); padding-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading" style="color: white">
                        <h1>{{ $post->title }}</h1>
                        <span class="meta">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        Publicado el
                            {{ $date->day }} de
                            {{ $months[$date->month] }} a las
                            {{ $date->toTimeString() }}
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <br>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    {!! Parsedown::instance()->text($post->content) !!}
                </div>
            </div>
        </div>
    </article>
@endsection

@push('scripts')
    <script>
        window.onload = function() {
            $('img').addClass('img img-responsive img-rounded');
        };
    </script>
@endpush