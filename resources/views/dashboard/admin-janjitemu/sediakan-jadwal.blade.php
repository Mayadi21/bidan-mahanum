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
    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
        </div>

        <div id="waktu-container">
            <div class="mb-3 waktu-group">
                <label for="waktu_mulai_1" class="form-label">Waktu Mulai</label>
                <input type="time" class="form-control" id="waktu_mulai_1" name="waktu_mulai[]" required>
                
                <label for="waktu_selesai_1" class="form-label mt-2">Waktu Selesai</label>
                <input type="time" class="form-control" id="waktu_selesai_1" name="waktu_selesai[]" required>
            </div>
        </div>

        <button type="button" id="add-time-slot" class="btn btn-outline-primary">Tambah Waktu</button>

        <button type="submit" class="btn btn-primary mt-3">Simpan Jadwal</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>

    <!-- Tabel daftar janji temu -->
    <div class="mt-5">
        <h3>Daftar Janji Temu</h3>
        <table class="table table-bordered table-striped" id="janji-temu-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" class="text-center">Pilih tanggal untuk melihat janji temu.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('tanggal').addEventListener('change', function() {
        const selectedDate = this.value;
        const janjiTemuTableBody = document.querySelector('#janji-temu-table tbody');

        if (!selectedDate) return;

        // Hapus isi tabel sebelum memuat data baru
        janjiTemuTableBody.innerHTML = `
            <tr>
                <td colspan="4" class="text-center">Memuat data...</td>
            </tr>
        `;

        fetch(`{{ route('jadwal.janjitemu') }}?tanggal=${selectedDate}`)
    .then(response => response.json())
    .then(data => {
        const janjiTemuTableBody = document.querySelector('#janji-temu-table tbody');
        janjiTemuTableBody.innerHTML = '';

        if (data.length === 0) {
            janjiTemuTableBody.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center">Tidak ada janji temu pada tanggal ini.</td>
                </tr>
            `;
        } else {
            data.forEach((item) => {
                const row = `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.waktu_mulai}</td>
                        <td>${item.waktu_selesai}</td>
                        <td>${item.status ? item.status : '-'}</td>
                    </tr>
                `;
                janjiTemuTableBody.innerHTML += row;
            });
        }
    })
    .catch(error => {
        const janjiTemuTableBody = document.querySelector('#janji-temu-table tbody');
        janjiTemuTableBody.innerHTML = `
            <tr>
                <td colspan="4" class="text-center text-danger">Gagal memuat data.</td>
            </tr>
        `;
        console.error('Error:', error);
    });

    });
</script>



<script>
    let waktuIndex = 1;

    document.getElementById('add-time-slot').addEventListener('click', function() {
        waktuIndex++;
        const waktuContainer = document.getElementById('waktu-container');
        const waktuGroup = document.createElement('div');
        waktuGroup.classList.add('mb-3', 'waktu-group');

        waktuGroup.innerHTML = `
            <label for="waktu_mulai_${waktuIndex}" class="form-label">Waktu Mulai</label>
            <input type="time" class="form-control" id="waktu_mulai_${waktuIndex}" name="waktu_mulai[]" required>

            <label for="waktu_selesai_${waktuIndex}" class="form-label mt-2">Waktu Selesai</label>
            <input type="time" class="form-control" id="waktu_selesai_${waktuIndex}" name="waktu_selesai[]" required>
        `;

        waktuContainer.appendChild(waktuGroup);
    });
</script>
@endsection
