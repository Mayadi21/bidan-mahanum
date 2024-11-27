@extends('dashboard.layouts.main')


@section('content')

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Daftar Penggajian Pegawai</h1>
      <!-- Button untuk melihat gaji pokok -->
<a href="{{ route('gaji-pokok.index') }}" class="btn btn-primary">Gaji Pokok</a>
    </div>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama Bidan</th>
                <th>Gaji Pokok</th>
                <th>Bonus</th>
                <th>Total Gaji</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Status</th>
                <th>Tanggal Gajian</th>

            </tr>
        </thead>
        <tbody>
            @forelse($penggajian as $item)
                <tr>
                    <td>{{ $item->nama_bidan }}</td>
                    <td>Rp{{ number_format($item->gaji_pokok, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($item->bonus, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($item->total_gaji, 0, ',', '.') }}</td>
                    <td>{{ $item->bulan_gaji }}</td>
                    <td>{{ $item->tahun_gaji }}</td>

                    <td>
                        <span class="badge {{ $item->status === 'Belum Diserahkan' ? 'bg-warning' : 'bg-success' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_penggajian)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Data penggajian belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
