@extends('layouts.main')

@section('content')

{{--  --}}

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="my-3 p-3 border-bottom">
                <h3 class="pb-0 mb-0">{{ $title }}</h3>
                <p><a href="/user/username" class="text-decoration-none text-dark">@username</a></p>
                <p>Ini gak tau mau diisi apa. Nanti ajalah</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        {{-- Loop here --}}
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="position-absolute px-3 py-2 text-white fs-8 rounded" style="background-color: rgba(0, 0, 0, 0.3)">
                    <a href="/categories/category_slug" class="text-white text-decoration-none">Category</a>
                </div>
                <img src="https://source.unsplash.com/500x300?category_slug" class="card-img-top" alt="Category">
                <div class="card-body">
                    <h5 class="card-title d-flex align-items-center" style="height: 3em; overflow: hidden;">Judul post dari database</h5>
                    <p>
                        <small>
                            By <a href="/user/username" class="text-decoration-none">Name</a> 
                            Rentang Waktu
                        </small>
                    </p>
                    <p class="card-text d-flex align-items-center" style="height: 8em; overflow: hidden;">
                        Excerpt yang ada di database.
                        Harus ditampilkan di bagian sini.
                    </p>
                    <a href="/posts/slug" class="btn btn-primary">Read more..</a>
                </div>
            </div>
        </div>
        {{-- Loop here --}}
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="position-absolute px-3 py-2 text-white fs-8 rounded" style="background-color: rgba(0, 0, 0, 0.3)">
                    <a href="/categories/category_slug" class="text-white text-decoration-none">Category</a>
                </div>
                <img src="https://source.unsplash.com/500x300?category_slug" class="card-img-top" alt="Category">
                <div class="card-body">
                    <h5 class="card-title d-flex align-items-center" style="height: 3em; overflow: hidden;">Judul post dari database</h5>
                    <p>
                        <small>
                            By <a href="/user/username" class="text-decoration-none">Name</a> 
                            Rentang Waktu
                        </small>
                    </p>
                    <p class="card-text d-flex align-items-center" style="height: 8em; overflow: hidden;">
                        Excerpt yang ada di database.
                        Harus ditampilkan di bagian sini.
                    </p>
                    <a href="/posts/slug" class="btn btn-primary">Read more..</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="position-absolute px-3 py-2 text-white fs-8 rounded" style="background-color: rgba(0, 0, 0, 0.3)">
                    <a href="/categories/category_slug" class="text-white text-decoration-none">Category</a>
                </div>
                <img src="https://source.unsplash.com/500x300?category_slug" class="card-img-top" alt="Category">
                <div class="card-body">
                    <h5 class="card-title d-flex align-items-center" style="height: 3em; overflow: hidden;">Judul post dari database</h5>
                    <p>
                        <small>
                            By <a href="/user/username" class="text-decoration-none">Name</a> 
                            Rentang Waktu
                        </small>
                    </p>
                    <p class="card-text d-flex align-items-center" style="height: 8em; overflow: hidden;">
                        Excerpt yang ada di database.
                        Harus ditampilkan di bagian sini.
                    </p>
                    <a href="/posts/slug" class="btn btn-primary">Read more..</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection