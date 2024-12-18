@extends('dashboard.layouts.main')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Transaksi Penggajian</h1>
    </div>

    <div class="mb-3">
        <h5>Periode Gaji: {{ \Carbon\Carbon::parse($penggajian->awal_periode_gaji)->format('d M Y') }} - {{ \Carbon\Carbon::parse($penggajian->akhir_periode_gaji)->format('d M Y') }}</h5>
    </div>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Layanan</th>
                <th>Bonus Pegawai</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $item)
                <tr>
                    <td>{{ $item->transaksi_id }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d M Y') }}</td>
                    <td>{{ $item->jenis_layanan }}</td>
                    <td>Rp {{ number_format($item->bonus_pegawai, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada transaksi pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
