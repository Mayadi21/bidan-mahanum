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

        <!-- Pilih apakah pasien memiliki akun -->
        <div class="mb-3">
            <label class="form-label">Apakah pasien memiliki akun?</label>
            <div>
                <input type="radio" id="punya_akun" name="punya_akun" value="ya" checked>
                <label for="punya_akun">Ya</label>
            </div>
            <div>
                <input type="radio" id="tidak_punya_akun" name="punya_akun" value="tidak">
                <label for="tidak_punya_akun">Tidak</label>
            </div>
        </div>

        <!-- Jika Pasien Memiliki Akun -->
        <div class="mb-3" id="pilih-pasien">
            <label for="id_pasien" class="form-label">Pilih Pasien Terdaftar</label>
            <select class="form-select" id="id_pasien" name="id_pasien">
                <option value="" selected disabled>Pilih pasien...</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->nama }} ({{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d/m/Y') }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Jika Pasien Tidak Memiliki Akun -->
        <div class="mb-3 d-none" id="pasien-tidak-terdaftar">
            <label for="id_pasien_tidak_terdaftar" class="form-label">Pilih Pasien Tidak Terdaftar</label>
            <select class="form-select" id="id_pasien_tidak_terdaftar" name="pasien_tidak_terdaftar_id">
                <option value="" selected disabled>Pilih pasien...</option>
                @foreach($pasienTidakTerdaftar as $pasien)
                    <option value="{{ $pasien->id }}">
                        {{ $pasien->nama_pasien }} - ({{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d/m/Y') }}) - {{ $pasien->no_hp }}
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

<script>
    // Tampilkan form pasien terdaftar atau pasien tidak terdaftar
    const radioYa = document.getElementById('punya_akun');
    const radioTidak = document.getElementById('tidak_punya_akun');
    const pilihPasien = document.getElementById('pilih-pasien');
    const pasienTidakTerdaftar = document.getElementById('pasien-tidak-terdaftar');

    radioYa.addEventListener('change', function() {
        if (radioYa.checked) {
            pilihPasien.classList.remove('d-none');
            pasienTidakTerdaftar.classList.add('d-none');
        }
    });

    radioTidak.addEventListener('change', function() {
        if (radioTidak.checked) {
            pasienTidakTerdaftar.classList.remove('d-none');
            pilihPasien.classList.add('d-none');
        }
    });
</script>
@endsection
