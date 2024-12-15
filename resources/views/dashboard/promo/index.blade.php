@extends('dashboard.layouts.main')

@section('content')
<div class="container">
    <h1>Daftar Promo</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @canany(['admin', 'pegawai'])
    <a href="{{ route('promo.create') }}" class="btn btn-primary mb-3">Tambah Promo</a>
@endcanany
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Promo</th>
                <th>Deskripsi</th>
                <th>Layanan</th>
                <th>Diskon</th>
                <th>Total Kuota</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promo as $promo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $promo->judul_promo }}</td>
                    <td>{{ $promo->deskripsi }}</td>
                    <td>{{ $promo->jenis_layanan }}</td>
                    <td>Rp. {{ number_format($promo->diskon, 0, ',', '.') }}</td>
                    <td>{{ $promo->total_kuota }}</td>
                    <td>{{ $promo->tanggal_mulai }}</td>
                    <td>{{ $promo->tanggal_selesai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
