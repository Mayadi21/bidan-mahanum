@extends('blog.layouts.main')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4 text-center" style="color: #ff6f91;">Profil Saya</h2>

    <!-- Pesan Notifikasi -->
    @if(session('success'))
    <div class="alert alert-success col-lg-12">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger col-lg-12">
        {{ session('error') }}
    </div>
    @endif

    <div class="card shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-body" style="background-color: #fff8f2;">
            <div class="row mb-3 align-items-center">
                <div class="col-md-4 font-weight-bold">
                    <i class="bi bi-person-circle" style="color: #ff6f91;"></i> Nama
                </div>
                <div class="col-md-8">{{ $user->nama }}</div>
            </div>
            <div class="row mb-3 align-items-center">
                <div class="col-md-4 font-weight-bold">
                    <i class="bi bi-envelope" style="color: #6fb1ff;"></i> Email
                </div>
                <div class="col-md-8">{{ $user->email }}</div>
            </div>
            <div class="row mb-3 align-items-center">
                <div class="col-md-4 font-weight-bold">
                    <i class="bi bi-calendar" style="color: #ffa07a;"></i> Tanggal Lahir
                </div>
                <div class="col-md-8">{{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d/m/Y') }}</div>
            </div>
            <div class="row mb-3 align-items-center">
                <div class="col-md-4 font-weight-bold">
                    <i class="bi bi-house-door" style="color: #ffbc85;"></i> Alamat
                </div>
                <div class="col-md-8">{{ $user->alamat ?? '-' }}</div>
            </div>
            <div class="row mb-3 align-items-center">
                <div class="col-md-4 font-weight-bold">
                    <i class="bi bi-briefcase" style="color: #98d8aa;"></i> Pekerjaan
                </div>
                <div class="col-md-8">{{ $user->pekerjaan ?? '-' }}</div>
            </div>
            <div class="row mb-3 align-items-center">
                <div class="col-md-4 font-weight-bold">
                    <i class="bi bi-phone" style="color: #ff6f91;"></i> Nomor HP
                </div>
                <div class="col-md-8">{{ $user->no_hp }}</div>
            </div>
            <div class="row mb-3 align-items-center">
                <div class="col-md-4 font-weight-bold">
                    <i class="bi bi-person-check" style="color: #ff6f91;"></i> Status
                </div>
                <div class="col-md-8">{{ ucfirst($user->status) }}</div>
            </div>
            <!-- <div class="row mb-3 align-items-center">
                <div class="col-md-4 font-weight-bold">
                    <i class="bi bi-award" style="color: #6fb1ff;"></i> Role
                </div>
                <div class="col-md-8">{{ ucfirst($user->role) }}</div>
            </div> -->

            <!-- Tombol Edit -->
            <div class="text-center mt-4">
                <button class="btn btn-primary px-5" style="background-color: #ff6f91; border: none;" data-bs-toggle="modal" data-bs-target="#editModal">Edit Profil</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px;">
            <form action="{{ route('profile.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header" style="background-color: #ff6f91; color: white; border-radius: 15px 15px 0 0;">
                    <h5 class="modal-title" id="editModalLabel">Edit Profil</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #fff8f2;">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $user->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ $user->tanggal_lahir }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control">{{ $user->alamat }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="{{ $user->pekerjaan }}">
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $user->no_hp }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #ff6f91; border: none;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
