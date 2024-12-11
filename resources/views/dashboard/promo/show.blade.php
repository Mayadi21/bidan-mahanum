@extends('dashboard.layouts.main')

@section('content')
<div class="container">
    <h1>Detail Promo</h1>

    <div class="card mb-3">
        <div class="card-header">
            <h3>{{ $promo->judul_promo }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Deskripsi:</strong> {{ $promo->deskripsi }}</p>
            @canany(['admin', 'pegawai'])
            <p><strong>Layanan:</strong> {{ $promo->layanan->jenis_layanan ?? '-' }}</p>
            @endcanany
            <p><strong>Potongan Harga:</strong> {{ $promo->diskon }}</p>
            <p><strong>Kuota:</strong> {{ $promo->kuota }}</p>
            <p><strong>Tanggal Mulai:</strong> {{ $promo->tanggal_mulai }}</p>
            <p><strong>Tanggal Selesai:</strong> {{ $promo->tanggal_selesai }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('promo.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('promo.registerPatientForm', $promo->id) }}" class="btn btn-success">Daftarkan Pasien</a> <!-- Tombol Daftarkan Pasien -->
        </div>
    </div>
</div>
@endsection
