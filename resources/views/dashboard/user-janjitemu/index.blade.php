@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Janji Temu Saya</h1>
    


    <div class="btn-group btn-group-sm me-2" role="group" aria-label="Filter Status">
        <button type="button" class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#buatJanjiTemuModal">
            Buat Janji Temu
        </button>
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

<!-- Modal Buat Janji Temu -->
<div class="modal fade" id="buatJanjiTemuModal" tabindex="-1" aria-labelledby="buatJanjiTemuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buatJanjiTemuModalLabel">Buat Janji Temu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
             <form action="{{ route('user.janjitemu.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <textarea class="form-control" id="keluhan" name="keluhan" rows="3" placeholder="Masukkan keluhan Anda..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="waktu_janji" class="form-label">Waktu Janji</label>
                        <input type="datetime-local" class="form-control" id="waktu_janji" name="waktu_janji" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="table-responsive small col-lg-12">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Keluhan</th>
                <th scope="col">Waktu Janji</th>
                <th scope="col">Status</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($janjiTemu as $appointment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $appointment->keluhan }}</td>
                    <td>{{ $appointment->waktu_janji }}</td>
                    <td>{{ ucfirst($appointment->status) }}</td>
                    <td>{{ $appointment->keterangan ?? '-' }}</td>
                    <td>
                        @if($appointment->status === 'menunggu konfirmasi')
                            <!-- Tombol Edit -->
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editJanjiTemuModal-{{ $appointment->id }}">
                                Edit
                            </button>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editJanjiTemuModal-{{ $appointment->id }}" tabindex="-1" aria-labelledby="editJanjiTemuModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editJanjiTemuModalLabel">Edit Janji Temu</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('user.janjitemu.update', $appointment->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="keluhan-{{ $appointment->id }}" class="form-label">Keluhan</label>
                                                    <textarea class="form-control" id="keluhan-{{ $appointment->id }}" name="keluhan" rows="3" required>{{ $appointment->keluhan }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="waktu_janji-{{ $appointment->id }}" class="form-label">Waktu Janji</label>
                                                    <input type="datetime-local" class="form-control" id="waktu_janji-{{ $appointment->id }}" name="waktu_janji" value="{{ \Carbon\Carbon::parse($appointment->waktu_janji)->format('Y-m-d\TH:i') }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada janji temu ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
