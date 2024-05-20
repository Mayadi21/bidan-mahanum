@extends('blog.layouts.main')

@section('content')
    <h1 class="text-center my-5">{{ $title }}</h1>

    @if(session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endsection