@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Ulasan Layanan</h1>
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
                <th scope="col">Pasien</th>
                <th scope="col">Layanan</th>
                <th scope="col">Ulasan</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ulasan as $u)
                <tr>
                    <td>{{ $u->user->nama }}</td> <!-- Menampilkan nama pasien -->
                    <td>{{ $u->layanan->jenis_layanan }}</td> <!-- Menampilkan jenis layanan -->
                    <td>{{ $u->ulasan }}</td> <!-- Menampilkan teks ulasan -->
                    <td>{{ $u->tanggal_ulasan }}</td> <!-- Menampilkan tanggal ulasan -->
                    <td>
                        @if($u->status == 'aktif')
                            <form action="{{ route('ulasan.blok', $u->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-danger">Blokir</button>
                            </form>
                        @else
                            <form action="{{ route('ulasan.aktifkan', $u->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-success">Aktifkan</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
