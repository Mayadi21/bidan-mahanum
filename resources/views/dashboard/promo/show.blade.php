@extends('dashboard.layouts.main')

@section('content')
    <div class="container">
@if(session('success'))
    <div class="alert alert-success col-lg-12">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger col-lg-12">
        {{ session('error') }}
    </div>
@endif
        
        <h1 class="my-4">Detail Promo</h1>

        <div class="card">
            <div class="card-header">
                <h3>{{ $promo->judul_promo }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Deskripsi:</strong> {{ $promo->deskripsi }}</p>
                <p><strong>Jenis Layanan:</strong> {{ $promo->jenis_layanan }}</p>
                <p><strong>Diskon:</strong> {{ $promo->diskon }}</p>
                <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($promo->tanggal_mulai)->format('d-m-Y') }}</p>
                <p><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($promo->tanggal_selesai)->format('d-m-Y') }}</p>
                <p><strong>Total Kuota:</strong> {{ $promo->total_kuota }}</p>
                <p><strong>Sisa Kuota:</strong> {{ $promo->total_kuota - $promo->kuota_terpakai }}</p>
                
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('promo.index') }}" class="btn btn-secondary">Kembali</a>
                @can('user')
                <!-- Form untuk mendaftarkan pengguna ke promo -->
                <form action="{{ route('promo.register') }}" method="POST" style="display: inline;">
                    @csrf
                    <!-- Kirimkan ID promo dan ID pengguna -->
                    <input type="hidden" name="promo_id" value="{{ $promo->promo_id }}">
                    <input type="hidden" name="id_pasien" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-primary">Daftar Promo</button>
                </form>
                @endcan 
            </div>
        </div>
    </div>
@endsection
