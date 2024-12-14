@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Rujukan</h1>
    <!-- Tombol Tambah Rujukan -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-rujukan-modal">Tambah Rujukan</button>
</div>

<!-- Notifikasi -->
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

<!-- Tabel Data Rujukan -->
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Pasien</th>
                <th>Tanggal Rujukan</th>
                <th>Tujuan Rujukan</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rujukans as $rujukan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $rujukan->user->nama }}</td>
                <td>{{ $rujukan->tanggal_rujukan }}</td>
                <td>{{ $rujukan->tujuan_rujukan }}</td>
                <td>{{ $rujukan->keterangan ?? '-' }}</td>
                <td>
                    <!-- Tombol lihat -->
                    <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#rujukan-modal-{{ $rujukan->id }}">lihat</button>

                    <!-- <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit-rujukan-modal-{{ $rujukan->id }}">Edit</button> -->
                    <!-- Tombol Hapus -->
                    <!-- <form action="{{ route('rujukan.cetak', $rujukan->id) }}" method="GET" class="d-inline" target="_blank">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-secondary" onclick="window.print()">Cetak</button>
                    </form> -->

                </td>
            </tr>
<!-- Modal Detail Rujukan -->
<div class="modal fade" id="rujukan-modal-{{ $rujukan->id }}" tabindex="-1" aria-labelledby="rujukanModalLabel-{{ $rujukan->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rujukanModalLabel-{{ $rujukan->id }}">Detail Rujukan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Detail Rujukan -->
                <p><strong>Nama Pasien:</strong> {{ $rujukan->nama_pasien }}</p>
                <p><strong>Tujuan Rujukan:</strong> {{ $rujukan->tujuan_rujukan }}</p>
                <p><strong>Tanggal Rujukan:</strong> {{ $rujukan->tanggal_rujukan }}</p>
                <p><strong>Keterangan:</strong> {{ $rujukan->keterangan }}</p>
            </div>
            <div class="modal-footer">
                <!-- Tombol Close -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <!-- Tombol Edit -->
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit-rujukan-modal-{{ $rujukan->id }}">Edit</button>
                <!-- Tombol Cetak -->
                <a href="{{ route('rujukan.cetak', $rujukan->id) }}" target="_blank" class="btn btn-primary">Cetak</a>
            </div>
        </div>
    </div>
</div>
            <!-- Modal Edit Rujukan -->
            <div class="modal fade" id="edit-rujukan-modal-{{ $rujukan->id }}" tabindex="-1" aria-labelledby="edit-rujukan-modal-label-{{ $rujukan->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit-rujukan-modal-label-{{ $rujukan->id }}">Edit Rujukan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('rujukan.update', $rujukan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="id_pasien" class="form-label">Pasien</label>
                                    <select class="form-select" name="id_pasien" required>
                                        <option value="" selected>-- Pilih Pasien --</option>
                                        @foreach($pasien as $p)
                                        <option value="{{ $p->id }}" {{ $p->id == $rujukan->id_pasien ? 'selected' : '' }}>{{ $p->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_rujukan" class="form-label">Tanggal Rujukan</label>
                                    <input type="date" class="form-control" name="tanggal_rujukan" value="{{ $rujukan->tanggal_rujukan }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tujuan_rujukan" class="form-label">Tujuan Rujukan</label>
                                    <input type="text" class="form-control" name="tujuan_rujukan" value="{{ $rujukan->tujuan_rujukan }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan">{{ $rujukan->keterangan }}</textarea>
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
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Rujukan -->
<div class="modal fade" id="add-rujukan-modal" tabindex="-1" aria-labelledby="add-rujukan-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-rujukan-modal-label">Tambah Rujukan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('rujukan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_pasien" class="form-label">Pasien</label>
                        <select class="form-select" name="id_pasien" required>
                            <option value="" selected>-- Pilih Pasien --</option>
                            @foreach($pasien as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_rujukan" class="form-label">Tanggal Rujukan</label>
                        <input type="date" class="form-control" name="tanggal_rujukan" required>
                    </div>
                    <div class="mb-3">
                        <label for="tujuan_rujukan" class="form-label">Tujuan Rujukan</label>
                        <input type="text" class="form-control" name="tujuan_rujukan" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan"></textarea>
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
@endsection