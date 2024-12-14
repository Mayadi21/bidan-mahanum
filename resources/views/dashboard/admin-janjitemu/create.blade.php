@extends('dashboard.layouts.main')

@section('content')
    <h1 class="mb-4">Daftar Jadwal Janji Temu</h1>

    <a href="{{ route('janjitemu.create') }}" class="btn btn-primary mb-3">Tambah Janji Temu</a>

    <div class="row">
        @foreach ($jadwal as $jadwalItem)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Jadwal: {{ $jadwalItem->waktu_mulai }} - {{ $jadwalItem->waktu_selesai }}
                        </h5>
                                                <p class="card-text">Kuota: {{ $jadwalItem->kuota }}</p>
                        <p class="card-text">Jumlah Janji Temu: {{ $jadwalItem->janjiTemus_count }}</p>

                        @if ($jadwalItem->janjiTemus_count >= $jadwalItem->kuota)
                            <p class="text-danger">Jadwal ini sudah penuh</p>
                        @else
                            <a href="" class="btn btn-success">Daftar</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
