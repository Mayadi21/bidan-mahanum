@extends('blog.layouts.main')

@section('content')
    <div class="container">
        <div class="d-flex flex-column min-vh-100 text-center align-items-center justify-content-center">
            <div class="mb-4 ">
                <h1 class="text-danger">You are Banned!</h1>
                <h4>You are banned because your posts/comments contains the following violation:</h4>
            </div>
            <div class="mb-4">
                <h2 class="text-danger">{{ $report_name }}</h2>
                <h5>{{ $report_description }}</h5> 
            </div>
        </div>
    </div>
@endsection