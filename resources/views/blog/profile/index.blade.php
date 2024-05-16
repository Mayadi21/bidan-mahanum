@extends('blog.layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h2 class="my-3 pb-3 border-bottom">Profile</h2>

            @if(session()->has('password-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('password-success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <img src="{{ asset('img/profile-pict.jpg')}}" class="rounded-circle img-fluid mb-3 d-block mx-3" alt="Profile Picture" width="100">

            <div class="mx-4">
                <h4>Name</h4>
                <p class="text-secondary">Nabila Syahmarani</p>
            </div>
            <div class="mx-4">
                <h4>Username</h4>
                <p class="text-secondary">@nabila</p>
            </div>
            <div class="mx-4">
                <h4>Bio</h4>
                <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>

            <a href="{{ route('profile.edit')}}" class="btn btn-primary mx-4">Edit Profile</a>

            <hr class="my-3">

            <div class="mx-4">
                <h4>Email</h4>
                <p class="text-secondary">{{ auth()->user()->maskedEmail() }}</p>
            </div>
            <a href="{{ route('email.change')}}" class="btn btn-primary mx-4">Change Email</a>

            <hr class="my-3">

            <div class="mx-4 mb-3">
                <h4>Password</h4>
            </div>
            <a href="{{ route('password.change')}}" class="btn btn-primary mx-4">Change Password</a>
        </div>
    </div>
</div>

@endsection