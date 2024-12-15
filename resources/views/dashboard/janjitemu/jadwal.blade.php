@extends('dashboard.layouts.main')

@section('content')
<div class="container mt-4">
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
    <h2 class="mb-4">Daftar Jadwal Tersedia</h2>
    @if($jadwalTersedia->isEmpty())
        <div class="alert alert-info">Tidak ada jadwal tersedia.</div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($jadwalTersedia as $jadwal)
            <div class="col">
                <div class="card h-100 border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Jadwal Tersedia</h5>
                        <p class="card-text">
                            <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('d M Y') }}<br>
                            <strong>Waktu:</strong> {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}<br>
                            @if ( ($jadwal->kuota - $jadwal->total_terisi) == 1)
                            <strong class="text-warning mt-1">  Kuota hampir habis </strong>
                            @else
                            @endif
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#daftarJanjiTemuModal-{{ $jadwal->id }}">Daftar Janji Temu</button>
                    </div>
                </div>
            </div>

            <!-- Modal Daftar Janji Temu -->
            <div class="modal fade" id="daftarJanjiTemuModal-{{ $jadwal->id }}" tabindex="-1" aria-labelledby="daftarJanjiTemuModalLabel-{{ $jadwal->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="daftarJanjiTemuModalLabel-{{ $jadwal->id }}">Daftar Janji Temu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('janji.temu.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="keluhan-{{ $jadwal->id }}" class="form-label">Keluhan</label>
                                    <textarea class="form-control" id="keluhan-{{ $jadwal->id }}" name="keluhan" rows="3" placeholder="Isi keluhan Anda" required></textarea>
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
        </div>
    @endif
</div>
@endsection
