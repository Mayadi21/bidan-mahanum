@extends('blog.layouts.main')

@section('content')

    <h2 class="text-center my-5">{{ $title }}</h2>

    <div class="row">
        {{-- Loop here --}}
        @foreach($categories as $category)
        <div class="col-md-4">
            <div class="card text-bg-dark mb-3">
                @if($category->image)
                <img src=" {{ asset('storage/' . $category->image) }}" style="height: 11.1em; overflow: hidden;" class="card-img" alt="{{ $category->category_name }}">
                @else
                <img src="https://picsum.photos/seed/{{ $category->category_name }}/500/250" class="card-img" alt="{{ $category->category_name }}">
                @endif
                <div class="card-img-overlay d-flex align-items-center p-0">
                    <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.5)">
                        <a href="{{ route('category.show', $category->category_slug) }}" class="text-decoration-none text-white">{{ $category->category_name }}</a>
                    </h5>
                </div>
            </div>
        </div>
        @endforeach
        {{-- Loop end --}}
    </div>
@endsection