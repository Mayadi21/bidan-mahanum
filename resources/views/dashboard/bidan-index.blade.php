@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Halo, {{ auth()->user()->nama }}.
        </h1>
    </div>

    <div class="container">
        <h1>{{ $page }}</h1>

        <!-- Menampilkan jumlah transaksi hari ini -->
        <div class="alert alert-info">
            <strong>Kunjungan Hari Ini:</strong> {{ $transaksiHariIni }}
        </div>

        
       
        <div class="card">
            <div class="card-header">
                Daftar Transaksi
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pasien</th>
                            <th>Bidan</th>
                            <th>Layanan</th>
                            <th>Keterangan</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item)
                            <tr>
                                <td>{{ $item->transaksi_id }}</td>
                                <td>{{ $item->nama_pasien }}</td>  <!-- Nama Pasien -->
                                <td>{{ $item->nama_bidan }}</td>    <!-- Nama Bidan -->
                                <td>{{ $item->layanan }}</td>      <!-- Layanan -->
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>  <!-- Total Harga -->
                                <td>{{ $item->tanggal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Janji Temu Hari Ini
            </div>
            <div class="card-body">
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
                                <td>{{ $item->pasien_nama }}</td>  <!-- Nama Pasien -->
                                <td>{{ $item->keluhan }}</td>  <!-- Keluhan -->
                                <td>{{ \Carbon\Carbon::parse($item->waktu_janji)->format('d-m-Y H:i') }}</td>  <!-- Waktu Janji (Format: dd-mm-yyyy HH:MM) -->
                                <td>{{ $item->status }}</td>  <!-- Status Janji Temu -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection