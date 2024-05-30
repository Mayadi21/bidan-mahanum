@extends('blog.layouts.main')

@section('content')
    <div class="container mt-5 mb-8">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">W-Blog</h1>
                <p class="text-center">Learn more about our company and team</p>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-6">
                <h2>Our Mission</h2>
                <p>Our mission is to deliver the best products and services to our customers. We are dedicated to innovation and excellence.</p>
            </div>
            <div class="col-md-6">
                <h2>Our Values</h2>
                <p>We value integrity, customer satisfaction, and continuous improvement. We strive to exceed expectations in everything we do.</p>
            </div>
        </div>
        <div class="row my-5 justify-content-center">
            <div class="col-12">
                <h2 class="text-center mb-3">Meet the Team</h2>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/yuna.jpg') }}" class="card-img-top" style="height: 12em; object-fit: cover" alt="Team Member 1">
                    <div class="card-body">
                        <h5 class="card-title">Yuna Dhuha</h5>
                        <p class="card-text">231402007</p>
                        <p class="card-text">Kenapa pulaklah bisa aku masuk TI?</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/safna.jpg') }}" class="card-img-top" style="height: 12em; object-fit: cover" alt="Team Member 1">
                    <div class="card-body">
                        <h5 class="card-title">Safna Yuninda</h5>
                        <p class="card-text">231402025</p>
                        <p class="card-text">Anak baik, sholehah, rajin beribadah, taat agama.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/refael.jpg') }}" class="card-img-top" style="height: 12em; object-fit: cover" alt="Team Member 1">
                    <div class="card-body">
                        <h5 class="card-title">Refael Juari Siagian</h5>
                        <p class="card-text">231402055</p>
                        <p class="card-text">Manusia manusia kuat, itu siapa? Jiwa jiwa yang kuat, itu apa?</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/ferdy.jpg') }}" class="card-img-top" style="height: 12em; object-fit: cover" alt="Team Member 1">
                    <div class="card-body">
                        <h5 class="card-title">Ferdyan Darwis</h5>
                        <p class="card-text">231402092</p>
                        <p class="card-text">KYAAAAAA!!!! OPPA PERDIIIIIIII.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/jessi.jpg') }}" class="card-img-top" style="height: 12em; object-fit: cover" alt="Team Member 1">
                    <div class="card-body">
                        <h5 class="card-title">Jessica Eldamaris Maha</h5>
                        <p class="card-text">231402101</p>
                        <p class="card-text">Ampun, banh! Gak lagi lagi banh!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection