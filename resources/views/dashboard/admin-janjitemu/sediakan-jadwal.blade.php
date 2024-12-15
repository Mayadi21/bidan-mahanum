@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Sediakan Jadwal Janji Temu</h1>
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
    <!-- Form untuk menyediakan jadwal -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Sediakan Jadwal</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control form-control-lg" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                    </div>
                </div>

                <div id="waktu-container">
                    <div class="waktu-group row g-3 align-items-center mb-4">
                        <div class="col-md-4">
                            <label for="waktu_mulai_1" class="form-label">Waktu Mulai</label>
                            <input type="time" class="form-control form-control-lg" id="waktu_mulai_1" name="waktu_mulai[]" required>
                        </div>
                        <div class="col-md-4">
                            <label for="waktu_selesai_1" class="form-label">Waktu Selesai</label>
                            <input type="time" class="form-control form-control-lg" id="waktu_selesai_1" name="waktu_selesai[]" required>
                        </div>
                        <div class="col-md-4">
                            <label for="kuota_1" class="form-label">Kuota</label>
                            <input type="number" class="form-control form-control-lg" id="kuota_1" name="kuota[]" min="1" required>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-time-slot" class="btn btn-outline-primary mb-3">
                    Tambah Waktu
                </button>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">Simpan Jadwal</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel daftar jadwal janji temu -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Daftar Jadwal Janji Temu</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="janji-temu-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Kuota</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center">Pilih tanggal untuk melihat jadwal janji temu.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.getElementById('tanggal').addEventListener('input', function () {
    const selectedDate = this.value;
    const janjiTemuTableBody = document.querySelector('#janji-temu-table tbody');

    if (!selectedDate) {
        janjiTemuTableBody.innerHTML = ` 
            <tr>
                <td colspan="4" class="text-center">Pilih tanggal untuk melihat jadwal janji temu.</td>
            </tr>`;
        return;
    }

    janjiTemuTableBody.innerHTML = ` 
        <tr>
            <td colspan="4" class="text-center">Memuat data...</td>
        </tr>`;

    // Update URL sesuai dengan route yang telah didefinisikan
    fetch(`/janjitemu/sediakan-jadwal?tanggal=${selectedDate}`)
        .then(response => response.json())
        .then(data => {
            janjiTemuTableBody.innerHTML = '';

            if (data.length === 0) {
                janjiTemuTableBody.innerHTML = ` 
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada jadwal janji temu pada tanggal ini.</td>
                    </tr>`;
            } else {
                data.forEach(item => {
                    janjiTemuTableBody.innerHTML += ` 
                        <tr>
                            <td>${item.id}</td>
                            <td>${item.waktu_mulai}</td>
                            <td>${item.waktu_selesai}</td>
                            <td>${item.kuota}</td>
                        </tr>`;
                });
            }
        })
        .catch(error => {
            janjiTemuTableBody.innerHTML = ` 
                <tr>
                    <td colspan="4" class="text-center text-danger">Gagal memuat data.</td>
                </tr>`;
            console.error('Error:', error);
        });
});


    let waktuIndex = 1;

    document.getElementById('add-time-slot').addEventListener('click', function () {
        waktuIndex++;
        const waktuContainer = document.getElementById('waktu-container');

        const waktuGroup = document.createElement('div');
        waktuGroup.classList.add('row', 'g-3', 'align-items-center', 'mb-4', 'waktu-group');

        waktuGroup.innerHTML = `
            <div class="col-md-4">
                <label for="waktu_mulai_${waktuIndex}" class="form-label">Waktu Mulai</label>
                <input type="time" class="form-control form-control-lg" id="waktu_mulai_${waktuIndex}" name="waktu_mulai[]" required>
            </div>
            <div class="col-md-4">
                <label for="waktu_selesai_${waktuIndex}" class="form-label">Waktu Selesai</label>
                <input type="time" class="form-control form-control-lg" id="waktu_selesai_${waktuIndex}" name="waktu_selesai[]" required>
            </div>
            <div class="col-md-4">
                <label for="kuota_${waktuIndex}" class="form-label">Kuota</label>
                <input type="number" class="form-control form-control-lg" id="kuota_${waktuIndex}" name="kuota[]" min="1" required>
            </div>`;

        waktuContainer.appendChild(waktuGroup);
    });
</script>
@endsection
