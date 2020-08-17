@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utility.css') }}" rel="stylesheet">
@endsection
@section('title', 'timeline')
@section('content')
    <div class="row justify-content-center container pt20" style="margin: auto;">
        @foreach($all_posts as $post)
            <div class="col-4 mb50">
                <div class="card">
                  　@if(isset($post->firstPhoto()->image))
                    　　<img class="card-img-top" src="{{ Storage::disk('s3')->url('public/images/' . $post->firstPhoto()->image) }}">
                  　@else
                    　　<img class="card-img-top" src="{{ asset('images/'.'noimageavailable.png') }}">
                  　@endif
                    <div class="card-body">
                        <h4 class="card-title">{{ $post->title }}</h4>
                        <p class="card-text">
                            <div>{{ $post->post }}</div>
                        </p>
                        <a href="{{ action('Guest\TimelineController@show',  $post->id )}}" class="btn btn-secondary">詳細</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt40">
        {{ $all_posts->links() }}
    </div>
@endsection