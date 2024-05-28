@extends('dashboard.layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h2 class="my-3 pb-3 border-bottom">Comment</h2>

            <div id="commentList" class="mt-3">
                <div class="comment">
                    <a href="/user/{{$comment->user->username}}" class="text-decoration-none text-dark">
                        <strong>{{'@'.$comment->user->username}}</strong>
                    </a>
                    -
                    <small>{{$comment->created_at->diffForHumans()}}</small>
                    <p>{{$comment->body}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8 pb-5">
            <h3 class="my-3 pb-3 border-bottom">{{ $comment->post->title }}</h3>
            <img src="https://picsum.photos/seed/{{ $comment->post->category }}/1200/400" class="img-fluid" alt="category">
            <p class="text-secondary text-lg mt-3">
                By <a href="/user/{{$comment->post->user->username}}" class="text-decoration-none">{{$comment->post->user->name}}</a> 
            </p>
            {!! $comment->post->body !!}
        </div>
    </div>
</div>

@endsection