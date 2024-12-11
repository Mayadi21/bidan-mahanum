@extends('dashboard.layouts.main')

@section('content')
<div class="container">
    <h1>Daftarkan Pasien ke Promo</h1>

    <div class="card mb-3">
        <div class="card-header">
            <h3>{{ $promo->judul_promo }}</h3>
        </div>
        <div class="card-body">
            <form action="#" method="POST">
                @csrf
                <!-- Input untuk menentukan apakah pasien memiliki akun -->
                <div class="form-group mb-3">
                    <label for="has_account">Apakah Pasien Memiliki Akun?</label>
                    <select name="has_account" id="has_account" class="form-control" required>
                        <option value="" disabled selected>Pilih</option>
                        <option value="yes">Ya</option>
                        <option value="no">Tidak</option>
                    </select>
                </div>

                <!-- Input untuk pasien yang memiliki akun -->
                <div class="form-group mb-3" id="registered-patient-section" style="display: none;">
                    <label for="id_pasien">Pilih Pasien</label>
                    <select name="id_pasien" id="id_pasien" class="form-control">
                        <option value="" disabled selected>Pilih Pasien</option>
                        <!-- Daftar pasien akan dimuat di sini (contoh statis, sebaiknya gunakan data dari database) -->
                        <option value="1">Pasien 1</option>
                        <option value="2">Pasien 2</option>
                    </select>
                </div>

                <!-- Input untuk pasien yang tidak memiliki akun -->
                <div class="form-group mb-3" id="unregistered-patient-section" style="display: none;">
                    <label for="nama_pasien_tidak_terdaftar">Nama Pasien</label>
                    <input type="text" name="nama_pasien_tidak_terdaftar" id="nama_pasien_tidak_terdaftar" class="form-control" placeholder="Nama Pasien">
                </div>

                <!-- Input waktu mulai dan selesai janji temu -->
                <div class="form-group mb-3">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="datetime-local" name="waktu_selesai" id="waktu_selesai" class="form-control">
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

<script>
    // Tampilkan dan sembunyikan input berdasarkan apakah pasien memiliki akun atau tidak
    document.getElementById('has_account').addEventListener('change', function() {
        const hasAccount = this.value;
        const registeredSection = document.getElementById('registered-patient-section');
        const unregisteredSection = document.getElementById('unregistered-patient-section');
        
        if (hasAccount === 'yes') {
            registeredSection.style.display = 'block';
            unregisteredSection.style.display = 'none';
        } else if (hasAccount === 'no') {
            registeredSection.style.display = 'none';
            unregisteredSection.style.display = 'block';
        } else {
            registeredSection.style.display = 'none';
            unregisteredSection.style.display = 'none';
        }
    });
</script>

@endsection
