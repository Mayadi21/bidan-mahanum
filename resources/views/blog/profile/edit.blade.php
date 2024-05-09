@extends('blog.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="my-3 pb-3 border-bottom">Edit Profile</h2>

                <form action="/dashboard/posts" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mx-5">
                        <label for="formFile" class="form-label">Profile Image</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5 d-block rounded-circle" style="width: 100px; height: 100px">
                        <input class="form-control" type="file" id="image" name="image" onchange="previewImage()">
                    </div>
                    <div class="mb-3 mx-5">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required autofocus value="">
                    </div>
                    <div class="mb-3 mx-5">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required autofocus value="">
                    </div>
                    <div class="mb-3 mx-5">
                        <label for="bio" class="form-label">Bio</label>
                        <input type="text" class="form-control" id="bio" name="bio" required autofocus value="">
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