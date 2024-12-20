@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Kunjungan</h1>
    <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-transaction-modal">Tambah Transaksi</button> -->
</div>

<!-- Bagian untuk menampilkan pesan -->
@if(session('success'))
    <div class="alert alert-success col-lg-8">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger col-lg-8">
        {{ session('error') }}
    </div>
@endif

<!-- Form pencarian global -->
<div class="mb-4">
    <form action="{{ route('kunjungan.index') }}" method="GET" class="row g-3">
        <div class="col-md-10">
            <input type="text" name="search" class="form-control" placeholder="Cari pasien, tanggal, atau bidan" value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>
</div>

<div class="table-responsive small col-lg-12">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pasien</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Bidan</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->nama_pasien }}</td>
                    <td>{{ $t->tanggal }}</td>
                    <td>{{ $t->nama_bidan }}</td>
                    <td>{{ $t->keterangan }}</td>
                </tr> 
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data ditemukan.</td>
                </tr>
            @endforelse             
        </tbody>
    </table>
</div>

@endsection
