@php
    $layout = Auth::check() ? 'dashboard.layouts.main' : 'blog.layouts.main';
@endphp
@extends($layout)



@section('content')
    <h1>Daftar Layanan</h1>
    @if(session('success'))
    <div class="alert alert-success col-lg-8">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger col-lg-8">
        {{ session('error') }}
    </div>
@endif
    <!-- Tombol Tambahkan Layanan -->
    @can('admin')
    <a href="{{ route('layanan.create') }}" class="btn btn-success mb-3">Tambahkan Layanan</a>
    @endcan

    <div class="row">
        @foreach ($layanan as $item)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->jenis_layanan }}</h5>
                        <p class="card-text">Harga: {{ number_format($item->harga, 0, ',', '.') }}</p>

                        <!-- Tampilkan teks 'Tidak Aktif' jika layanan tidak aktif -->
                        @if ($item->status === 'tidak aktif')
                            <p class="card-text text-danger">Tidak Aktif</p>
                        @endif

                        <!-- Tombol 'Lihat' dengan kondisi warna berdasarkan status -->
                        <a href="{{ route('layanan.show', $item->id) }}" 
                           class="btn {{ $item->status === 'tidak aktif' ? 'btn-danger' : 'btn-primary' }}">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
