<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | {{ $page }}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/trix.css') }}" rel="stylesheet">
    <link rel="icon" type="image/jpeg" href="{{ asset('img/logo.jpeg') }}">

    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none; 
        }

        blockquote {
            margin: 20px 40px;
            padding: 10px 20px;
            background-color: #f9f9f9;
            border-left: 5px solid #ccc;
            font-style: italic;
        }
    </style>

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
    
</body>
</html>
