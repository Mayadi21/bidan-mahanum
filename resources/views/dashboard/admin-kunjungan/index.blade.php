@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Kunjungan</h1>
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
                <th scope="col">Pasien</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Bidan</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->nama_pasien }}</td>
                    <td>{{ $t->tanggal }}</td>
                    <td>{{ $t->nama_bidan }}</td>
                    <td>{{ $t->keterangan }}</td>
                </tr>               
            @endforeach
        </tbody>
    </table>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const layananContainer = document.getElementById('layanan-container');
        const addLayananButton = document.getElementById('add-layanan');
        let layananCount = 1;

        addLayananButton.addEventListener('click', function () {
            if (layananCount < 5) {
                layananCount++;

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

        // Interaksi dengan janji temu
        const janjiTemuSelect = document.getElementById('janji_temu');
        const daftarJanjiContainer = document.getElementById('daftar-janji');
        const pasienContainer = document.getElementById('pasien-container');

        janjiTemuSelect.addEventListener('change', function () {
            const isFromJanji = this.value === 'ya';
            daftarJanjiContainer.style.display = isFromJanji ? 'block' : 'none';
            pasienContainer.style.display = isFromJanji ? 'none' : 'block';
        });


    });
</script>



@endsection
