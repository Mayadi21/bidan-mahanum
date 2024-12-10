@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
        
        <div class="btn-group btn-group-sm me-2" role="group" aria-label="Basic outlined example">
            <form action="{{ route('admin.users.index') }}" method="get">
                <button type="submit" name="status" value="aktif" class="btn btn-outline-primary">Pengguna Aktif</button>
                <button type="submit" name="status" value="admin" class="btn btn-outline-success">Admin</button>
                <button type="submit" name="status" value="pegawai" class="btn btn-outline-success">Pegawai</button>
                <button type="submit" name="status" value="tidak aktif" class="btn btn-outline-danger">Pengguna Tidak Aktif</button>
            </form>
        </div>

        <form action="{{ route('admin.users.index') }}" class="d-flex mt-3 mt-lg-0" role="search">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <!-- Tombol Tambah Pengguna -->
        <button type="button" class="btn btn-outline-primary mt-3 mt-lg-0" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Tambah Pengguna
        </button>
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
    
    <div class="table-responsive small col-lg-12">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Tangal Lahir</th>
                    <th scope="col">Pekerjaan</th>
                    <th scope="col">Nomor HP</th>
                    <th scope="col">Role</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->alamat }}</td>
                        <td>{{ $user->tanggal_lahir }}</td>
                        <td>{{ $user->pekerjaan }}</td>
                        <td>{{ $user->no_hp }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if($user->status === 'aktif')
                                <!-- Tombol Edit -->
                                <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="collapse" data-bs-target="#editForm{{ $user->id }}" aria-expanded="false" aria-controls="editForm{{ $user->id }}">
                                    Edit
                                </button>
                                <!-- Tombol Nonaktifkan -->
                                <form action="{{ route('users.update.status', $user->id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="tidak aktif">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menonaktifkan pengguna ini?')">
                                        Nonaktifkan
                                    </button>
                                </form>
                            @elseif($user->status === 'tidak aktif')
                                <!-- Tombol Aktifkan -->
                                <form action="{{ route('users.update.status', $user->id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="aktif">
                                    <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('Apakah Anda yakin ingin mengaktifkan pengguna ini?')">
                                        Aktifkan
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    <!-- Form Edit Data (Collapse) -->
                    @if($user->status === 'aktif')
                    <tr class="collapse" id="editForm{{ $user->id }}">
                        <td colspan="10">
                            <div class="card card-body">
                                <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $user->alamat }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $user->tanggal_lahir }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ $user->pekerjaan }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">Nomor HP</label>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $user->no_hp }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-select" id="role" name="role">
                                            <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                            @can('admin')
                                            <option value="pegawai" @if($user->role == 'pegawai') selected @endif>Pegawai</option>
                                            @endcan
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
                
                
        </table>
    </div>

<!-- Modal Tambah Pengguna -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="addUserModalLabel">Tambah Pengguna Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk Tambah Pengguna -->
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                    </div>
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" id="status" name="status" value="aktif">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role">
                            <option value="user">User</option>
                            @can('admin')<option value="pegawai">Pegawai</option>@endcan
                        </select>
                    </div>

                    <!-- Kolom Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <!-- Kolom Konfirmasi Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
