@extends('dashboard.layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $layanan->jenis_layanan }}</h5>
            <p class="card-text">
                <!-- Cek apakah gambar ada, jika tidak, gunakan gambar default -->
                <img src="{{ asset($layanan->gambar ? $layanan->gambar : 'images/layanan_default.jpeg') }}" 
                     alt="{{ $layanan->jenis_layanan }}" width="200" height="200">
            </p>
            <p class="card-text">{{ $layanan->deskripsi }}</p>
            <p class="card-text">Harga: {{ number_format($layanan->harga, 0, ',', '.') }}</p>
            <p class="card-text">Bonus Pegawai: {{ number_format($layanan->besar_bonus, 0, ',', '.') }}</p>

            <!-- Status hanya untuk admin -->
            @can('admin')
                <p class="card-text">Status: {{ $layanan->status }}</p>
                
                <!-- Tombol Edit hanya jika status layanan aktif -->
                @if ($layanan->status === 'aktif')
                    <!-- Tombol Edit -->
                    <a href="{{ route('layanan.edit', $layanan->id) }}" class="btn btn-warning">Edit</a>

                    <!-- Tombol Nonaktifkan -->
                    <form action="{{ route('layanan.nonaktifkan', $layanan->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Apakah Anda yakin ingin menonaktifkan layanan ini?')">Nonaktifkan Layanan</button>
                    </form>
                @else
                    <!-- Tombol Aktifkan -->
                    <form action="{{ route('layanan.aktifkan', $layanan->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success" 
                                onclick="return confirm('Apakah Anda yakin ingin mengaktifkan layanan ini?')">Aktifkan Layanan</button>
                    </form>
                @endif
            @endcan
        </div>
    </div>
@endsection
