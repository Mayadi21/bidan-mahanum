<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tubes Blog | {{ $page }}</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="icon" type="image/jpeg" href="{{ asset('img/logo.jpeg') }}">
        <style>
            .comment {
                position: relative;
            }

            .delete-form {
                position: absolute;
                top: 5px;
                right: 10px;
            }

            .profile-pic {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                object-fit: cover;
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