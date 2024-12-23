@extends('blog.layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h2 class="my-3 pb-3 border-bottom">Profile</h2>




            <!-- Alert Section -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info">
                        {{ session('info') }}
                    </div>
                @endif
            <!-- Alert Section End -->

            <input type="hidden" name="oldImage" value="{{ $user->image }}">
            @if($user->image)
                <img src="{{ asset('storage/' . $user->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block rounded-circle ms-3" style="width: 100px; height: 100px">
            @else
                <img src="{{ asset('img/profile-pict.jpg')}}" class="img-preview img-fluid mb-3 col-sm-5 d-block rounded-circle ms-3" alt= "Profile Photo" style="width: 100px; height: 100px">
            @endif
            
            <div class="mx-4">
                <h4>Name</h4>
                <p class="text-secondary"> {{ $user->name }} </p>
            </div>
            <div class="mx-4">
                <h4>Username</h4>
                <p class="text-secondary"> {{ $user->username }} </p>
            </div>
            <div class="mx-4">
                <h4>Bio</h4>
                <p class="text-secondary"> {{ $user->bio }} </p>
            </div>             

            <a href="{{ route('profile.edit')}}" class="btn btn-primary mx-4">Edit Profile</a>

            <hr class="my-3">

            <div class="mx-4">
                <h4>Email</h4>
                <p class="text-secondary">{{ auth()->user()->maskedEmail() }}</p>
            </div>
            <!-- <a href="{{ route('email.change')}}" class="btn btn-primary mx-4">Change Email</a> -->

            <hr class="my-3">

            <div class="mx-4 mb-3">
                <h4>Password</h4>
            </div>

            <a href="{{ route('password.change')}}" class="btn btn-primary mx-4">Change Password</a>

        </div>
    </div>
</div>

@endsection