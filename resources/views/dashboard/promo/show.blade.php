@extends('dashboard.layouts.main')

@section('content')
    <div class="container">
        <h1 class="my-4">Detail Promo</h1>

        <div class="card">
            <div class="card-header">
                <h3>{{ $promo->judul_promo }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Deskripsi:</strong> {{ $promo->deskripsi }}</p>
                <p><strong>Jenis Layanan:</strong> {{ $promo->jenis_layanan }}</p>
                <p><strong>Diskon:</strong> {{ $promo->diskon }}</p>
                <p><strong>Tanggal Mulai:</strong> {{ $promo->tanggal_mulai }}</p>
                <p><strong>Tanggal Selesai:</strong> {{ $promo->tanggal_selesai }}</p>
                <p><strong>Total Kuota:</strong> {{ $promo->total_kuota }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('promo.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
