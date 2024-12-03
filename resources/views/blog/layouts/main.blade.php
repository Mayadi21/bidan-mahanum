<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bidan Mahanum | {{ $page }}</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="icon" type="image/jpeg" href="{{ asset('img/logo.jpeg') }}">
        <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
         .feature-card {
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: scale(1.05);
        }
        .testimonial-card {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
    </head>
    <body>

        @include('blog.layouts.nav')

        <div class="container">
            @yield('content')
        </div>
        
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>