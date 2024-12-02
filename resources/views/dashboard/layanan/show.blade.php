@extends('dashboard.layouts.main')

@section('content')
    <div class="container">
        <!-- Pesan Notifikasi -->
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

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $layanan->jenis_layanan }}</h5>
                <p class="card-text">
                    <img src="{{ asset($layanan->gambar ? $layanan->gambar : 'images/layanan_default.jpeg') }}" 
                         alt="{{ $layanan->jenis_layanan }}" width="200" height="200">
                </p>
                <p class="card-text">{{ $layanan->deskripsi }}</p>
                <p class="card-text">Harga: {{ number_format($layanan->harga, 0, ',', '.') }}</p>
                <p class="card-text">Bonus Pegawai: {{ number_format($layanan->besar_bonus, 0, ',', '.') }}</p>

                @can('admin')
                    <p class="card-text">Status: {{ $layanan->status }}</p>
                    @if ($layanan->status === 'aktif')
                        <a href="{{ route('layanan.edit', $layanan->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('layanan.nonaktifkan', $layanan->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Apakah Anda yakin ingin menonaktifkan layanan ini?')">Nonaktifkan Layanan</button>
                        </form>
                    @else
                        <form action="{{ route('layanan.aktifkan', $layanan->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success" 
                                    onclick="return confirm('Apakah Anda yakin ingin mengaktifkan layanan ini?')">Aktifkan Layanan</button>
                        </form>
                    @endif
                @endcan

                <!-- Form Tambah Ulasan -->
                @auth
                    <h6>Berikan Ulasan:</h6>
                    <form action="{{ route('ulasan.store', $layanan->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea name="ulasan" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                    </form>
                @endauth

                <!-- Menampilkan Semua Ulasan -->
                <h6 class="mt-4">Ulasan Pengguna:</h6>
                @foreach ($layanan->ulasan as $ulasan)
                    <div class="mb-3 border p-3">
                        <p><strong>{{ $ulasan->user->nama ?? 'Pengguna tidak ditemukan' }}</strong> ({{ $ulasan->tanggal_ulasan }})</p>
                        <p>{{ $ulasan->ulasan }}</p>

                        <!-- Tombol Edit hanya untuk pengguna yang memiliki ulasan -->
                        @if (Auth::id() === $ulasan->id_pengguna)
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#editModal{{ $ulasan->id }}">Edit</button>
                        @endif
                    </div>

                    <!-- Modal Edit Ulasan -->
                    <div class="modal fade" id="editModal{{ $ulasan->id }}" tabindex="-1" 
                         aria-labelledby="editModalLabel{{ $ulasan->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $ulasan->id }}">Edit Ulasan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('ulasan.update', $ulasan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <textarea name="ulasan" class="form-control" rows="3" required>{{ $ulasan->ulasan }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
