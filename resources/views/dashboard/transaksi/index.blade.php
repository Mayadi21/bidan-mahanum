@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Transaksi</h1>
</div>

<!-- Bagian untuk menampilkan pesan -->
@if(session('success'))
    <div class="alert alert-success col-lg-8">
        {{ session('success') }}
    </div>
@endif

<div class="table-responsive small col-lg-12">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pasien</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Bidan</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->nama_pasien }}</td>
                    <td>{{ $t->tanggal }}</td>
                    <td>{{ $t->nama_bidan }}</td>
                    <td>{{ $t->total_harga }}</td>
                    <td>
                        <!-- Tombol untuk membuka modal -->
                        <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#transaksi-modal-{{ $t->transaksi_id }}">
                            Lihat
                        </button>
                    </td>
                </tr>
                <!-- Modal untuk detail transaksi -->
                <div class="modal fade" id="transaksi-modal-{{ $t->transaksi_id }}" tabindex="-1" aria-labelledby="transaksi-modal-label-{{ $t->transaksi_id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="transaksi-modal-label-{{ $t->transaksi_id }}">Detail Transaksi ID {{ $t->transaksi_id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <strong>Nama Pasien:</strong> {{ $t->nama_pasien }}<br>
                                <strong>Nama Bidan:</strong> {{ $t->nama_bidan }}<br>
                                <strong>Layanan:</strong> 
                                @php
                                    $detail = DB::table('transaksi')
                                        ->join('detail_transaksi', 'transaksi.id', '=', 'detail_transaksi.transaksi_id')
                                        ->join('layanan', 'detail_transaksi.layanan_id', '=', 'layanan.id')
                                        ->where('transaksi.id', $t->transaksi_id)
                                        ->select('layanan.jenis_layanan')
                                        ->get();
                                    echo implode(', ', $detail->pluck('jenis_layanan')->toArray());
                                @endphp
                                <br>
                                <strong>Keterangan:</strong> {{ $t->keterangan ?? '-' }}<br>
                                <strong>Tanggal:</strong> {{ $t->tanggal }}<br>
                                <strong>Total Harga:</strong> {{ $t->total_harga }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
