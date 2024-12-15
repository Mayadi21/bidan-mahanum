@extends('dashboard.layouts.main')

@section('content')
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
    
    <h2>Daftar Jadwal Janji Temu</h2>
    <div class="row">
        @foreach($jadwalJanjiTemu as $jadwal)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jadwal: {{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</h5>
                    <p class="card-text">Kuota: {{ $jadwal->kuota }}</p>
                    <p class="card-text">
                        @if($jadwal->jumlah_janji_temu >= $jadwal->kuota)
                            <span class="text-danger">Kuota Penuh</span>
                        @else
                            <span class="text-success">Tersedia {{ $jadwal->kuota - $jadwal->jumlah_janji_temu }} tempat</span>
                        
                    </p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDaftarPasien{{ $jadwal->id }}">
                        Daftarkan Pasien
                    </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalDaftarPasien{{ $jadwal->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $jadwal->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('janjitemu.simpan') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel{{ $jadwal->id }}">Daftarkan Pasien</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                            <div class="mb-3">
                                <label for="id_pasien" class="form-label">Pilih Pasien</label>
                                <select name="id_pasien" id="id_pasien" class="form-select" required>
                                    <option value="" disabled selected>Pilih Pasien</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keluhan" class="form-label">Keluhan</label>
                                <textarea name="keluhan" id="keluhan" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
