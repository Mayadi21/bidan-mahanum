@extends('dashboard.layouts.main')

@section('content')
    <h1>Tambah Layanan</h1>

    <!-- Form untuk menambah layanan -->
    <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="jenis_layanan">Jenis Layanan</label>
            <input type="text" name="jenis_layanan" class="form-control" required>
        </div>
    
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
    
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
    
        <div class="form-group">
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" class="form-control" required>
        </div>
    
        <button type="submit" class="btn btn-primary">Tambah Layanan</button>
    </form>
    
@endsection
