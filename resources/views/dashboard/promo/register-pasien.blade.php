@extends('dashboard.layouts.main')

@section('content')
<div class="container">
    <h1>Daftarkan Pasien ke Promo</h1>

    <div class="card mb-3">
        <div class="card-header">
            <h3>{{ $promo->judul_promo }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('promo.registerPatient', $promo->id) }}" method="POST">
                @csrf
                <!-- Input untuk memilih pasien -->
                <div class="form-group mb-3">
                    <label for="id_pasien">Pilih Pasien</label>
                    <select name="id_pasien" id="id_pasien" class="form-control" required>
                        <option value="" disabled selected>Pilih Pasien</option>
                        @foreach($patients as $patient) <!-- Daftar pasien dari database -->
                            <option value="{{ $patient->id }}">{{ $patient->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Kolom keterangan -->
                <div class="form-group mb-3">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Masukkan keterangan tambahan"></textarea>
                </div>

                <!-- Tombol submit -->
                <button type="submit" class="btn btn-success">Daftarkan Pasien</button>
                <a href="{{ route('promo.show', $promo->id) }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
