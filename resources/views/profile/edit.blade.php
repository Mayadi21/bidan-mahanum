@extends('blog.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 mb-5">
                <h2 class="my-3 pb-3 border-bottom">Edit Profile</h2>

                <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mx-5">
                        <label for="image" class="form-label">Profile Image</label>
                        @if($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block rounded-circle" style="width: 100px; height: 100px">
                        @else
                        <img src="{{ asset('img/profile-pict.jpg')}}" class="img-preview img-fluid mb-3 col-sm-5 d-block rounded-circle" alt= "Profile Photo" style="width: 100px; height: 100px">
                        @endif
                        <input class="form-control" type="file" id="image" name="image" onchange="previewImage()">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 mx-5">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required autofocus value="{{ $user->name }}">
                    </div>
                    <div class="mb-3 mx-5">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required autofocus value="{{ $user->username }}">
                        @error('username')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 mx-5">
                        <label for="bio" class="form-label">Bio</label>
                        <input type="text" class="form-control" id="bio" name="bio" required autofocus value="{{ $user->bio }}">
                    </div>
                    <button type="submit" class="btn btn-primary mx-5">Edit</button>
                </form>  
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
