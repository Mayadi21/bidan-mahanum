@extends('dashboard.layouts.main')

@section('content')

<div class="container">
@if($janjiTemu->isEmpty())
<div class="alert alert-info">
    Anda belum memiliki janji temu.
</div>
@else
<div class="container mt-4">
    <h2 class="mb-4">Daftar Janji Temu</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Keluhan</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($janjiTemu as $index => $janji)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($janji->waktu_janji)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($janji->waktu_janji)->format('H:i') }}</td>
                <td>{{ $janji->keluhan }}</td>
                <td>
                    @if($janji->status === 'disetujui')
                    <span class="badge bg-success">Disetujui</span>
                    @elseif($janji->status === 'ditolak')
                    <span class="badge bg-danger">Ditolak</span>
                    @elseif($janji->status === 'menunggu konfirmasi')
                    <span class="badge bg-warning">Menunggu</span>
                    @elseif($janji->status === 'selesai')
                    <span class="badge bg-secondary">Selesai</span>
                    @else
                    <span class="badge bg-light">Status Tidak Dikenal</span>
                    @endif
                </td>
                <td>{{ $janji->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
<!-- Tombol untuk membuka modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#janjiTemuModal">
  Pendaftaran Janji Temu
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="janjiTemuModal" tabindex="-1" aria-labelledby="janjiTemuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="janjiTemuModalLabel">Pendaftaran Janji Temu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form Pendaftaran Janji Temu -->
        <form action="{{ route('janji.temu.store') }}" method="POST">
          @csrf
          
          <!-- Pilih Tanggal -->
          <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
          </div>
          
          <!-- Pilih Waktu -->
          <div class="mb-3">
            <label for="waktu" class="form-label">Waktu</label>
            <input type="time" class="form-control" id="waktu" name="waktu" required>
          </div>

          <!-- Keterangan -->
          <div class="mb-3">
            <label for="keluhan" class="form-label">keluhan</label>
            <textarea class="form-control" id="keluhan" name="keluhan" rows="3" placeholder="Isi keluhan"></textarea>
          </div>

          <button type="submit" class="btn btn-primary">Buat Janji Temu</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection