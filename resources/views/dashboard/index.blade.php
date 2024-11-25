@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Hello, {{ auth()->user()->nama }}
        </h1>
    </div>
    <div class="container">
        <div class="card">
            @if($janjiTemu ->isNotEmpty())  <!-- Cek apakah $kunjungan tidak kosong -->
                <div class="card-header">
                    Janji Temu Anda Selanjutnya
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Keterangan</th>
                                <th>Jadwal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($janjiTemu as $item)
                                <tr>
                                    <td>{{ $item->keluhan }}</td>      <!-- Layanan -->
                                    <td>{{ $item->waktu_janji }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    Anda tidak memiliki jadwal janji temu
                </div>
            @endif
        </div>             
    </div>


    <div class="container">
        <div class="card">
            @if($kunjungan->isNotEmpty())  <!-- Cek apakah $kunjungan tidak kosong -->
                <div class="card-header">
                    Riwayat Kunjungan Anda
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Layanan</th>
                                <th>Keterangan</th>
                                <th>Biaya</th>
                                <th>Bidan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kunjungan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->layanan }}</td>      <!-- Layanan -->
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>  <!-- Total Harga -->
                                    <td>{{ $item->nama_bidan }}</td>    <!-- Nama Bidan -->
                                    <td>{{ $item->tanggal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    Anda belum memiliki riwayat kunjungan.
                </div>
            @endif
        </div>             
    </div>
@endsection