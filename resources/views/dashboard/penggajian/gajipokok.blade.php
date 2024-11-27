@extends('dashboard.layouts.main')


@section('content')

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Daftar Gaji Pokok</h1>
      <!-- Button untuk melihat gaji pokok -->
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
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Bidan</th>
                <th>Gaji Pokok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($gajiPokok as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_bidan }}</td>
                    <td>Rp{{ number_format($item->gaji_pokok, 0, ',', '.') }}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                            Edit
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Data penggajian belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
        
    </table>
</div>


<!-- Modal -->
@foreach($gajiPokok as $item)
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('gaji-pokok.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Gaji Pokok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaBidan" class="form-label">Nama Bidan</label>
                        <input type="text" class="form-control" id="namaBidan" value="{{ $item->nama_bidan }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="gajiPokok" class="form-label">Gaji Pokok</label>
                        <input type="number" class="form-control" id="gajiPokok" name="gaji_pokok" value="{{ $item->gaji_pokok }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
