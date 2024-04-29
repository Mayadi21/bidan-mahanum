@extends('layouts.main')

@section('content')

    <h2 class="text-center my-5">{{ $title }}</h2>

    <div class="row">
        {{-- Loop here --}}
        <div class="col-md-4">
            <div class="card text-bg-dark mb-3">
                <img src="https://source.unsplash.com/500x250?category_slug" class="card-img" alt="category">
                <div class="card-img-overlay d-flex align-items-center p-0">
                <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.5)">
                    <a href="/categories/category_slug" class="text-decoration-none text-white">Category</a>
                </h5>
                </div>
            </div>
        </div>
        {{-- Loop here --}}
        <div class="col-md-4">
            <div class="card text-bg-dark mb-3">
                <img src="https://source.unsplash.com/500x250?category_slug" class="card-img" alt="category">
                <div class="card-img-overlay d-flex align-items-center p-0">
                <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.5)">
                    <a href="/categories/category_slug" class="text-decoration-none text-white">Category</a>
                </h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-dark mb-3">
                <img src="https://source.unsplash.com/500x250?category_slug" class="card-img" alt="category">
                <div class="card-img-overlay d-flex align-items-center p-0">
                <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.5)">
                    <a href="/categories/category_slug" class="text-decoration-none text-white">Category</a>
                </h5>
                </div>
            </div>
        </div>
    </div>
@endsection