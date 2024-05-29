@extends('dashboard.layouts.main')

@section('content')

<div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 pb-5">
                <h2 class="my-3 pb-3 border-bottom">{{ $post->title }}</h2>
                @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="{{ $post->category->name }}">
                @else
                <img src="https://picsum.photos/seed/{{ $post->category }}/1200/400" class="img-fluid" alt="{{ $post->category->name }}">
                @endif
                <hr class="my-3">
                {!! $post->body !!}
            </div>
            <div class="col-md-8">
                <h3 class="my-3 pb-3 border-bottom">Comments</h3>

                <div id="commentList" class="mt-3">
                    @foreach ($comments as $comment)
                        <div class="comment">
                            <strong>{{ '@'.$comment->user->username }}</strong>
                            -
                            <small>{{ $comment->created_at->diffForHumans() }}</small>
                            <p>{{ $comment->body }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
