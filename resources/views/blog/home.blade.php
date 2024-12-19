@extends('blog.layouts.main')

@section('content')
<!-- Hero Section -->
<!-- Hero Section -->
<section class="hero-section text-center text-primary" style=" padding: 100px 0; height: 100%;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-md-start">
                <h1 class="display-4 fw-bold">Welcome to Bidan Mahanum</h1>
                <p class="lead">Your Trusted Partner for Comprehensive Midwife Services</p>
                <a href="{{ route('layanan.index') }}" class="btn btn-light btn-lg text-primary fw-bold">Explore Our Services</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('img/logo.jpeg') }}"
                    alt="Midwife Service" class="img-fluid rounded"
                    style="width: 60%;">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center text-primary fw-bold mb-4">Our Services</h2>
        <div class="row text-center g-4"> <!-- Tambahkan g-4 -->
            @foreach($layanan as $index => $layanan)
            <div class="col-md-4">
                <div class="feature-card p-4 bg-light rounded">
                    <h5>{{ $layanan->jenis_layanan }}</h5>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center text-primary fw-bold mb-4">What Our Clients Say</h2>
        @if($ulasan->isNotEmpty())
    <div class="row">
        @foreach ($ulasan as $review)
            <div class="col-md-6 mb-3">
                <div class="testimonial-card p-4">
                    <p>"{{ $review->ulasan }}"</p>
                    <p><strong> {{ \Carbon\Carbon::parse($review->tanggal_ulasan)->format('d M Y') }}</strong></p>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-info">
        Belum ada ulasan.
    </div>
@endif
    </div>
</section>


@endsection