@extends('dashboard.layouts.main')

@section('content')


    @if($riwayatKunjungan->isEmpty())
        <div class="alert alert-info">
            Anda Belum ada riwayat kunjungan.
        </div>
    @else
    <div class="container mt-4">
      <h2 class="mb-4">Riwayat Kunjungan</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Layanan</th>
                    <th>Bidan</th>
                    <th>Keterangan</th>
                    <th>Biaya (Total Harga)</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayatKunjungan as $index => $kunjungan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kunjungan->layanan }}</td>
                    <td>{{ $kunjungan->nama_bidan }}</td>
                    <td>{{ $kunjungan->keterangan }}</td>
                    <td>Rp {{ number_format($kunjungan->total_harga, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($kunjungan->tanggal)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
