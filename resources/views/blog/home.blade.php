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
                <a href="/services" class="btn btn-light btn-lg text-primary fw-bold">Explore Our Services</a>
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
                        <p>{{ $layanan->deskripsi }}</p>
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
            <div class="row">
                MAY DISINI BUAT ULASAN YAA
                <div class="col-md-6 mb-3">
                    <div class="testimonial-card p-4">
                        <p>"BidanCare helped me throughout my pregnancy journey with professional care and compassion."</p>
                        <h6 class="text-primary fw-bold">- Sarah A.</h6>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="testimonial-card p-4">
                        <p>"I felt completely safe and supported during my delivery. Highly recommend!"</p>
                        <h6 class="text-primary fw-bold">- Emily R.</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection