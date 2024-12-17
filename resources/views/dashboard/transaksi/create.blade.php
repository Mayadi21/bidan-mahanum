@extends('dashboard.layouts.main')

@section('content')
<div class="container mt-4">
    <h1>Tambah Transaksi</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <!-- Apakah transaksi dari janji temu? -->
        <div class="mb-3">
            <label>Apakah transaksi berasal dari janji temu?</label><br>
            <input type="radio" name="janji_temu" value="ya" id="janji_ya" onchange="toggleJanjiTemu(true)" required> 
            <label for="janji_ya">Ya</label>
            <input type="radio" name="janji_temu" value="tidak" id="janji_tidak" onchange="toggleJanjiTemu(false)"> 
            <label for="janji_tidak">Tidak</label>
        </div>

        <!-- Pilih Janji Temu -->
        <div id="janji_temu_section" style="display: none;">
            <label for="janji_id">Pilih Janji Temu</label>
            <select class="form-select" name="janji_id">
                <option value="" selected>-- Pilih Janji Temu --</option>
                @foreach($janji_temu as $janji)
                    <option value="{{ $janji->id }}">{{ $janji->pasien_nama }} - {{ $janji->waktu_mulai }}</option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Pasien -->
        <div id="pasien_section" style="display: none;">
            <label for="pasien_id">Pilih Pasien</label>
            <select class="form-select" name="pasien_id">
                <option value="" selected>-- Pilih Pasien --</option>
                @foreach($pasien as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Layanan -->
        <div class="mb-3">
            <label for="layanan" class="form-label">Pilih Layanan</label>

            <!-- Kontainer Layanan -->
            <div id="layanan-container">
                <div class="input-group mb-2">
                    <select class="form-select" name="layanan[]" required>
                        <option value="" selected>-- Pilih Layanan --</option>
                        @foreach($layanan as $l)
                            <option value="{{ $l->id }}">{{ $l->jenis_layanan }} (Rp {{ number_format($l->harga) }})</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-danger remove-layanan" disabled>Hapus</button>
                </div>
            </div>

            <!-- Tombol Tambah Layanan -->
            <button type="button" id="add-layanan" class="btn btn-success">Tambah Layanan</button>
        </div>

        <!-- Keterangan -->
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const layananContainer = document.getElementById('layanan-container');
        const addLayananButton = document.getElementById('add-layanan');
        let layananCount = 1; // Mulai dari 1 karena 1 layanan sudah ditampilkan secara default

        addLayananButton.addEventListener('click', function () {
            if (layananCount < 5) { // Batas maksimal 5 layanan
                layananCount++;

                // Buat elemen input layanan baru
                const layananInputGroup = document.createElement('div');
                layananInputGroup.classList.add('input-group', 'mb-2');
                layananInputGroup.innerHTML = `
                    <select class="form-select" name="layanan[]" required>
                        <option value="" selected>-- Pilih Layanan --</option>
                        @foreach($layanan as $l)
                            <option value="{{ $l->id }}">{{ $l->jenis_layanan }} (Rp {{ number_format($l->harga) }})</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-danger remove-layanan">Hapus</button>
                `;

                // Tambahkan elemen layanan baru ke kontainer
                layananContainer.appendChild(layananInputGroup);

                // Tambahkan event listener untuk tombol hapus
                layananInputGroup.querySelector('.remove-layanan').addEventListener('click', function () {
                    layananInputGroup.remove();
                    layananCount--;
                });
            } else {
                alert('Maksimal 5 layanan yang dapat ditambahkan.');
            }
        });
    });

    function toggleJanjiTemu(isJanjiTemu) {
        document.getElementById('janji_temu_section').style.display = isJanjiTemu ? 'block' : 'none';
        document.getElementById('pasien_section').style.display = isJanjiTemu ? 'none' : 'block';
    }
</script>

@endsection
