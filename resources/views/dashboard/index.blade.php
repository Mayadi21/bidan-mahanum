@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Hello, {{ auth()->user()->name }}
        </h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Posts</div>
                    <div class="card-body">
                        <h5 class="card-title" id="postCount">{{ $posts->count() }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Views Total</div>
                    <div class="card-body">
                        <h5 class="card-title" id="totalViews">{{ $posts->sum('view') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Banned Posts</div>
                    <div class="card-body">
                        <h5 class="card-title" id="totalViews">{{ $banned->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>
    
        <h3 class="my-4">Most Popular Post</h3>
        <div class="row" id="popularPosts">
            @foreach($posts->take(3) as $post)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if($post->image)
                    <img src=" {{ asset('storage/' . $post->image) }}" style="height: 11.6em; overflow: hidden;" class="card-img-top" alt="{{ $post->title }}" >
                    @else
                    <img src="https://picsum.photos/seed/{{ $post->category }}/500/300" class="card-img-top" alt="{{ $post->category->category_name }}">
                    @endif                    
                    <div class="card-body">
                        <h5 class="card-title" style="height: 3em; overflow: hidden;">{{ $post->title }}</h5>
                        <p class="card-text">
                            <small class="text-muted"><i class="bi bi-eye"></i>{{ $post->view }}</small>
                        </p>
                        <a href="{{ route('posts.show', $post->slug)}}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection