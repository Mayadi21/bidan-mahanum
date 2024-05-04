@extends('layouts.main')

@section('content')
<div class="container">

    <h2 class="text-center my-5">{{ $title }}</h2>

    <div class="row justify-content-center">
        @foreach ($posts as $post)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-absolute px-3 py-2 text-white fs-8 rounded" style="background-color: rgba(0, 0, 0, 0.3)">
                        <a href="/categories/{{ $post->category->category_slug }}" class="text-white text-decoration-none">{{ $post->category->category_name }}</a>
                    </div>
                    <img src="https://source.unsplash.com/500x300?{{ $post->category->category_slug }}" class="card-img-top" alt="{{ $post->category->category_name }}">
                    <div class="card-body">
                        <h5 class="card-title d-flex align-items-center" style="height: 3em; overflow: hidden;">{{ $post->title }}</h5>
                        <p>
                            <small>
                                By <a href="/user/{{ $post->user->username }}" class="text-decoration-none">{{ $post->user->name }}</a> 
                                {{ $post->created_at->diffForHumans() }}
                            </small>
                        </p>
                        <p class="card-text d-flex align-items-center" style="height: 8em; overflow: hidden;">{{ $post->excerpt }}</p>
                        <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read more..</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection