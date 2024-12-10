@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        Halo, {{ auth()->user()->nama }}.
    </h1>
</div>

<div class="container">
    <!-- Menampilkan jumlah transaksi hari ini -->
    <div class="alert alert-info">
        <strong>Kunjungan Hari Ini:</strong> {{ $transaksiHariIni }}
    </div>
    <!-- Cards Section -->
    <div class="row">
        <!-- Card: Janji Temu Menunggu Konfirmasi -->
        <div class="col-md-6 mb-4">
            <div class="card text-center">
                <div class="card-header bg-primary text-white">
                    Janji Temu Menunggu Konfirmasi
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $janjiTemuPending }}</h5>
                    <p class="card-text">Janji temu yang masih menunggu konfirmasi.</p>
                    <a href="{{ route('janjitemu.index') }}" class="btn btn-primary">Lihat Janji Temu</a>
                </div>
            </div>
        </div>

        <!-- Card: Jumlah Ulasan -->
        <div class="col-md-6 mb-4">
            <div class="card text-center">
                <div class="card-header bg-success text-white">
                    Total Ulasan
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalUlasan }}</h5>
                    <p class="card-text">Jumlah ulasan dari para pasien.</p>
                    <a href="{{ route('admin.ulasan.index') }}" class="btn btn-success">Lihat Ulasan</a>
                </div>
            </div>
        </div>
        <div class="card">
    <div class="card-header">
        Janji Temu Hari Ini
    </div>
    <div class="card-body">
        @if ($janjiTemuHariIni->isNotEmpty())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                        <th>Waktu Janji</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($janjiTemuHariIni as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pasien_nama }}</td> <!-- Nama Pasien -->
                            <td>{{ $item->keluhan }}</td> <!-- Keluhan -->
                            <td>{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('d-m-Y H:i') }}</td> <!-- Waktu Janji -->
                            <td>{{ $item->status }}</td> <!-- Status -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">
                Tidak ada janji temu hari ini.
            </div>
        @endif
    </div>
</div>

    </div>
</div>
@endsection