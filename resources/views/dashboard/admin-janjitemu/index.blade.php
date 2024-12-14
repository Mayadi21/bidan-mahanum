@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Janji Temu</h1>
    
    <a href="{{ route('janjitemu.create') }}" class="btn btn-primary mb-3">
        Tambah Janji Temu
    </a>
    
    <div class="btn-group btn-group-sm me-2" role="group" aria-label="Filter Status">
        <form action="" method="get">
            <button type="submit" name="status" value="menunggu konfirmasi" class="btn btn-outline-primary">Menunggu Konfirmasi</button>
            <button type="submit" name="status" value="disetujui" class="btn btn-outline-success">Disetujui</button>
            <button type="submit" name="status" value="selesai" class="btn btn-outline-secondary">Selesai</button>
            <button type="submit" name="status" value="ditolak" class="btn btn-outline-danger">Ditolak</button>
        </form>
    </div>

    <form action="" class="d-flex mt-3 mt-lg-0" role="search">
        <input type="hidden" name="status" value="{{ request('status') }}">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari Janji Temu" aria-label="Search" value="{{ request('search') }}">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</div>

<!-- Pesan Notifikasi -->
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

<div class="table-responsive small col-lg-12">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Pasien</th>
                <th scope="col">Keluhan</th>
                <th scope="col">Jadwal</th>
                <th scope="col">Waktu Janji</th>
                <th scope="col">Status</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($janjiTemu as $appointment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $appointment->pasien_nama }}</td>
                    <td>{{ $appointment->keluhan }}</td>
                    <td>{{ $appointment->waktu_mulai }} s/d {{ $appointment->waktu_selesai }}</td>
                    <td>
                        @if($appointment->status === 'menunggu konfirmasi')
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton-{{ $appointment->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    Menunggu Konfirmasi
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $appointment->id }}">
                                    <li>
                                        <form action="{{ route('janjitemu.update', $appointment->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="dropdown-item">Setujui</button>
                                        </form>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#tolakModal-{{ $appointment->id }}">Tolak</button>
                                    </li>
                                </ul>
                            </div>

                            <div class="modal fade" id="tolakModal-{{ $appointment->id }}" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tolakModalLabel">Tolak Janji Temu</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('janjitemu.update', $appointment->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <input type="hidden" name="status" value="ditolak">
                                                <div class="mb-3">
                                                    <label for="keterangan" class="form-label">Keterangan</label>
                                                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Tolak</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{ ucfirst($appointment->status) }}
                        @endif
                    </td>
                    <td>{{ $appointment->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Tombol Sediakan Jadwal Janji Temu -->
<div class="container">
    <a href="{{ route('jadwal.sediakan') }}" class="btn btn-success btn-lg d-block position-fixed bottom-0 start-0 end-0" style="border-radius: 0; margin-bottom: 0;">
        Sediakan Jadwal Janji Temu
    </a>
</div>

@endsection
