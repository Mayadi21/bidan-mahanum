@extends('blog.layouts.main')

@section('content')
    <h1 class="text-center my-5">{{ $title }}</h1>

    @if(session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div id="carouselExampleInterval" class="carousel slide custom-caraousel" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($latest as $post)  
            <div class="carousel-item active" data-bs-interval="3000">
                @if($post->image)
                    <img src="{{ asset('storage/'. $post->image)}}" class="d-block w-100 img-fluid" style="height: 13em; width: 30em; overflow: hidden;" alt="...">
                @else
                    <img src="https://picsum.photos/seed/{{ $post->category }}/800/200" class="d-block w-100 img-fluid" style="height: 13em; width: 30em; overflow: hidden;" alt="...">
                @endif
                <div class="position-absolute px-3 py-2 text-white fs-8 rounded" style="background-color: rgba(0, 0, 0, 0.3); top: 0; left: 0;">
                    <a href="/categories/{{ $post->category->category_slug }}" class="text-white text-decoration-none">{{ $post->category->category_name }}</a>
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $post->title }}</h5>
                    <p>{{ $post->excerpt }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection