@extends('blog.layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-8 d-flex flex-column">
                    <div class="my-3 p-3 border-bottom flex-grow-1">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('img/profile-pict.jpg') }}" class="profile-pic pb-2">
                            <div class="ms-2">
                                <h3 class="pb-0 mb-0">{{ $title }}</h3>
                                <p class="pb-0 mb-0"><a href="/user/{{ $user->username }}" class="text-decoration-none text-dark">{{ '@' . $user->username }}</a></p>
                                @if($user->role == 'admin') <span class="badge text-bg-success">Admin</span> @endif
                            </div>
                        </div>
                        <p class="mt-3">{{ $user->bio }}</p>
                    </div>
                </div>
                <div class="col-md-4 d-flex flex-column">
                    <div class="my-3 p-3 border-bottom flex-grow-1">
                        <h5>Posts</h5>
                        <p>{{ $posts->count() }} posts</p>
                        <h5>Views</h5>
                        <p>{{ $posts->sum('view') }} views</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if($posts->count() > 9)
        <div class="btn-group mb-3" role="group" aria-label="Basic outlined example">
            <button type="button" class="btn btn-outline-secondary">Latest</button>
            <button type="button" class="btn btn-outline-secondary">Popular</button>
        </div>
    @endif

    <div class="row justify-content-center mt-3">
        @foreach ($posts as $post)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-absolute px-3 py-2 text-white fs-8 rounded" style="background-color: rgba(0, 0, 0, 0.3)">
                        <a href="/categories/{{ $post->category->category_slug }}" class="text-white text-decoration-none">{{ $post->category->category_name }}</a>
                    </div>
                    <img src="https://picsum.photos/seed/{{ $post->category }}/500/300" class="card-img-top" alt="{{ $post->category->category_name }}">
                    <div class="card-body">
                        <h5 class="card-title d-flex align-items-center" style="height: 3em; overflow: hidden;">{{ $post->title }}</h5>
                        <p>
                            <small>
                                By <a href="/user/{{ $post->user->username }}" class="text-decoration-none">{{ $post->user->name }}</a> 
                                {{ $post->created_at->diffForHumans() }} | 
                                <i class="bi bi-eye"></i> {{ $post->view }}
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