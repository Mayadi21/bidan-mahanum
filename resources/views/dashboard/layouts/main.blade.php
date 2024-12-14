<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page }}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/trix.css') }}" rel="stylesheet">
    <link rel="icon" type="image/jpeg" href="{{ asset('img/logo.jpeg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none; 
        }

        input[readonly] {
            background-color: #e9ecef; /* Warna latar belakang yang sama dengan disabled */
            cursor: not-allowed; /* Ganti kursor untuk menunjukkan tidak dapat diedit */
        }

        blockquote {
            margin: 20px 40px;
            padding: 10px 20px;
            background-color: #f9f9f9;
            border-left: 5px solid #ccc;
            font-style: italic;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>    
    
    @include('dashboard.layouts.header')
    
    <div class="container-fluid">
        <div class="row">
            
            @include('dashboard.layouts.sidebar')
            
            <main id="main" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                
                @yield('content')
                
            </main>
        </div>
    </div>
    
    
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/trix.umd.min.js') }}"></script>
    
    <script>
    function confirmDelete(slug) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form
                var form = document.querySelector('form[action*="' + slug + '"]');
                form.submit();
            }
        });
    }

    
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
</script>

</body>
</html>
