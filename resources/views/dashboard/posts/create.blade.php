@extends('dashboard.layouts.main')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Post</h1>
</div>

{{-- <div class="col-lg-8">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div> --}}
  
<div class="col-lg-8">
    <form id="createPostForm" action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required autofocus value="{{ old('title') }}">
        </div>
        @error('title')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" aria-label="Default select example" name="category_id" id="category">
                @foreach ($categories as $category)
                    @if(old('category_id') == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endif
                @endforeach
            </select>        
        </div>
        @error('category_id')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <img class="img-preview img-fluid mb-3 col-sm-5" style="width: 100px;">
            <input class="form-control" type="file" id="image" name="image" onchange="previewImage()">
        </div>
        @error('image')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
            <trix-editor input="body"></trix-editor>
        </div>
        @error('body')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <button type="button" class="btn btn-primary" onclick="confirmSubmit('published')">Publish</button>
        <button type="button" class="btn btn-secondary" onclick="confirmSubmit('draft')">Draft</button>
    </form>  
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
        fetch('/dashboard/posts/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    })

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })

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

    function confirmSubmit(status) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to submit this post as ${status}.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('createPostForm');
                const statusInput = document.createElement('input');
                statusInput.setAttribute('type', 'hidden');
                statusInput.setAttribute('name', 'status');
                statusInput.setAttribute('value', status);
                form.appendChild(statusInput);
                form.submit();
            }
        });
    }
</script>

@endsection
