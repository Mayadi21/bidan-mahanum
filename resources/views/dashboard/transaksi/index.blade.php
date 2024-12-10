@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Transaksi</h1>
    <!-- Button untuk menambah transaksi -->
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Tambah Transaksi</a>
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
                <th scope="col">Total Harga</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->nama_pasien }}</td>
                    <td>{{ $t->tanggal }}</td>
                    <td>{{ $t->nama_bidan }}</td>
                    <td>{{ $t->total_harga }}</td>
                    <td>
                        <!-- Tombol untuk membuka modal -->
                        <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#transaksi-modal-{{ $t->transaksi_id }}">
                            Lihat
                        </button>
                    </td>
                </tr>
                <!-- Modal untuk detail transaksi -->
                <div class="modal fade" id="transaksi-modal-{{ $t->transaksi_id }}" tabindex="-1" aria-labelledby="transaksi-modal-label-{{ $t->transaksi_id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="transaksi-modal-label-{{ $t->transaksi_id }}">Detail Transaksi ID {{ $t->transaksi_id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <strong>Nama Pasien:</strong> {{ $t->nama_pasien }}<br>
                                <strong>Nama Bidan:</strong> {{ $t->nama_bidan }}<br>
                                <strong>Layanan:</strong> 
                                {{ $t->layanan }}
                                <br>
                                <strong>Keterangan:</strong> {{ $t->keterangan ?? '-' }}<br>
                                <strong>Tanggal:</strong> {{ $t->tanggal }}<br>
                                <strong>Total Harga:</strong> {{ $t->total_harga }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="add-transaction-modal" tabindex="-1" aria-labelledby="add-transaction-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-transaction-modal-label">Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <!-- Pilihan tambahan -->
                    <div class="mb-3">
                        <label for="janji_temu" class="form-label">Transaksi dari Janji Temu?</label>
                        <select class="form-select" id="janji_temu" name="janji_temu">
                            <option value="tidak" selected>Tidak</option>
                            <option value="ya">Ya</option>
                        </select>
                    </div>

                    <div id="daftar-janji" class="mb-3" style="display: none;">
                        <label for="janji_id" class="form-label">Pilih Janji Temu</label>
                        <select class="form-select" id="janji_id" name="janji_id">
                            <option value="" selected>-- Pilih Janji Temu --</option>
                            @foreach($janji_temu as $janji)
                                <option value="{{ $janji->id }}">{{ $janji->pasien_nama }} ({{ $janji->waktu_mulai }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="pasien-container" class="mb-3">
                        <label for="pasien" class="form-label">Pasien</label>
                        <select class="form-select" id="pasien" name="pasien_id" >
                            <option value="" selected>-- Pilih Pasien --</option>
                            @foreach($pasien as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="bidan" class="form-label">Bidan</label>
                        <select class="form-select" id="bidan" name="bidan_id" required>
                            <option value="" selected>-- Pilih Bidan --</option>
                            @foreach($bidan as $b)
                                <option value="{{ $b->id }}">{{ $b->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="layanan" class="form-label">Layanan</label>
                        <div id="layanan-container">
                            <div class="input-group mb-2">
                                <select class="form-select" name="layanan[]" required>
                                    <option value="" selected>-- Pilih Layanan --</option>
                                    @foreach($layanan as $l)
                                        <option value="{{ $l->id }}">{{ $l->jenis_layanan }} (Rp {{ number_format($l->harga) }})</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-success" id="add-layanan">Tambah</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
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
