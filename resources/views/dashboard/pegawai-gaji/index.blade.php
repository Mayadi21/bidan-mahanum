@extends('dashboard.layouts.main')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Gaji Saya</h1>
    </div>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Gaji Pokok</th>
                <th>Bonus</th>
                <th>Total Gaji</th>
                <th>Tanggal Penggajian</th>
            </tr>
        </thead>
        <tbody>
            @forelse($gaji as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::createFromFormat('m', $item->bulan_gaji)->format('F') }}</td>
                    <td>{{ $item->tahun_gaji }}</td>
                    <td>Rp {{ number_format($item->gaji_pokok, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->bonus, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->gaji_pokok + $item->bonus, 0, ',', '.') }}</td>

                    <td>{{ $item->tanggal_penggajian ? \Carbon\Carbon::parse($item->tanggal_penggajian)->format('d M Y') : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Anda belum menerima gaji.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
