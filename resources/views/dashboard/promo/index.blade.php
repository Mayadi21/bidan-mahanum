@extends('dashboard.layouts.main')

@section('content')
<div class="container">
    <h1>Daftar Promo</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('promo.create') }}" class="btn btn-primary mb-3">Tambah Promo</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Promo</th>
                <th>Deskripsi</th>
                @canany(['admin', 'pegawai'])
                <th>Layanan</th>
                @endcanany
                <th>Potongan Harga</th>
                <th>Kuota</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promo as $key => $promo)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $promo->judul_promo }}</td>
                <td>{{ $promo->deskripsi }}</td>
                @canany(['admin', 'pegawai'])
                <td>{{ $promo->layanan->jenis_layanan ?? '-' }}</td>
                @endcanany
                <td>{{ $promo->diskon }}</td>
                <td>{{ $promo->kuota }}</td>
                <td>{{ $promo->tanggal_mulai }}</td>
                <td>{{ $promo->tanggal_selesai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
