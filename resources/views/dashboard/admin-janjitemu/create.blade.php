@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftarkan Janji Temu</h1>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <form action="{{ route('janjitemu.store') }}" method="POST">
        @csrf

        <!-- Pilih Pasien Terdaftar -->
        <div class="mb-3">
            <label for="id_pasien" class="form-label">Pilih Pasien Terdaftar</label>
            <select class="form-select" id="id_pasien" name="id_pasien" required>
                <option value="" selected disabled>Pilih pasien...</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->nama }} ({{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d/m/Y') }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Isian Keluhan -->
        <div class="mb-3">
          <label for="keluhan" class="form-label">Keluhan (Opsional)</label>
          <input type="text" class="form-control" id="keluhan" name="keluhan" maxlength="255" placeholder="Masukkan keluhan pasien...">
        </div>

        <!-- Pilih Janji Temu -->
        <div class="mb-3">
            <label for="janji_temu" class="form-label">Pilih Waktu Janji Temu</label>
            <select class="form-select" id="janji_temu" name="janji_temu_id" required>
                <option value="" selected disabled>Pilih waktu janji temu...</option>
                @foreach($jadwalTersedia as $jadwal)
                    <option value="{{ $jadwal->id }}">
                        {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('d/m/Y H:i') }} - 
                        {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="btn btn-primary mt-3">Daftarkan Pasien</button>
        <a href="" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
