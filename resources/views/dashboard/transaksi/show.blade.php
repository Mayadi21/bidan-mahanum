@extends('dashboard.layouts.main')

@section('content')
<div class="container mt-4">
    <h2>Detail Transaksi</h2>
    <hr>
    <!-- Informasi Umum -->
    <div class="mb-3">
        <p><strong>Nama Pasien:</strong> {{ $transaksi->nama_pasien }}</p>
        <p><strong>Nama Bidan:</strong> {{ $transaksi->nama_bidan }}</p>
        <p><strong>Tanggal Transaksi:</strong> {{ $transaksi->tanggal }}</p>
        <p><strong>Keterangan:</strong> {{ $transaksi->keterangan ?? '-' }}</p>
    </div>

    <!-- Tabel Detail Layanan -->
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Jenis Layanan</th>
                <th>Harga</th>
                <th>Potongan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalTransaksi = 0;
                $details = explode('; ', $transaksi->detail_layanan); // Pisahkan layanan berdasarkan ';'
            @endphp

            @foreach($details as $index => $detail)
                @php
                    // Ambil jenis layanan, harga, dan potongan dari detail
                    preg_match('/^(.*?) \(Harga: (.*?), Potongan: (.*?)\)$/', $detail, $matches);
                    $jenisLayanan = $matches[1] ?? '-';
                    $harga = (int) ($matches[2] ?? 0);
                    $potongan = (int) ($matches[3] ?? 0);
                    $total = $harga - $potongan;

                    $totalTransaksi += $total;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $jenisLayanan }}</td>
                    <td>Rp {{ number_format($harga) }}</td>
                    <td>Rp {{ number_format($potongan) }}</td>
                    <td>Rp {{ number_format($total) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-center">Total Transaksi</th>
                <th>Rp {{ number_format($totalTransaksi) }}</th>
            </tr>
        </tfoot>
    </table>
    <div class="text-end mt-4">
        <a href="{{ route('transaksi.surat', $transaksi->transaksi_id) }}" target="_blank" class="btn btn-primary">
            <i class="bi bi-printer"></i> Cetak Surat Transaksi
        </a>
    </div>
</div>
@endsection
