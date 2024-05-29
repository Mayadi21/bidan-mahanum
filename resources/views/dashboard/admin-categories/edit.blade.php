@extends('dashboard.layouts.main')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Category</h1>
</div>
  
<div class="col-lg-8">
    <form action="{{ route('categories.update', $category->category_slug) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" value="{{$category->category_name}}" required autofocus>
        </div>
        @error('title')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="category_description" class="form-label">Description</label>
            <input type="text" class="form-control" id="category_description" name="category_description" value="{{$category->category_description}}" required autofocus>
        </div>
    <div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <input type="hidden" name="oldImage" value="{{ $category->image }}"> {{-- menambahkan nama gambar lama tetapi disembunyikan/hidden --}}
            @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
                <img class="img-preview img-fluid mb-3 col-sm-5" style="width: 100px;">
            @endif
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
</div>

<button type="submit" class="btn btn-primary">Edit</button>
</form>  
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