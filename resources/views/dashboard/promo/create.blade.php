@extends('dashboard.layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Promo</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('promo.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="judul_promo" class="form-label">Judul Promo</label>
            <input type="text" class="form-control" id="judul_promo" name="judul_promo" value="{{ old('judul_promo') }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="layanan_id" class="form-label">Layanan</label>
            <select class="form-control" id="layanan_id" name="layanan_id" required>
                <option value="">Pilih Layanan</option>
                @foreach ($layanan as $layananItem)
                    <option value="{{ $layananItem->id }}" {{ old('layanan_id') == $layananItem->id ? 'selected' : '' }}>
                        {{ $layananItem->jenis_layanan }}  (Rp.{{ $layananItem->harga }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="diskon" class="form-label">Pemotongan Harga</label>
            <input type="number" class="form-control" id="diskon" name="diskon" value="{{ old('diskon') }}" min="0" required>
        </div>

        <div class="mb-3">
            <label for="kuota" class="form-label">Kuota</label>
            <input type="number" class="form-control" id="kuota" name="kuota" value="{{ old('kuota') }}" min="1" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Promo</button>
    </form>
</div>
@endsection
