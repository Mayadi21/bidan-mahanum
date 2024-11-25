@extends('blog.layouts.main')

@section('content')
<h1>TOLONG BUATIN TAMPILANNYA NAUUUU</h1>
<h1>BUAT AJA SEADANYA</h1>
<h1>NAH... NANTI DI HALAMAN KAMI KAU BIKIN LAYANAN KAMI YANG TERSEDIA</h1>
<h1>DAN KALAU BISA TAMPILAN NAVBAR NYA DIUBAH YA GES, KARENA INI PUNYA REFAEL</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Jenis Layanan</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Harga</th>
            <th scope="col">Gambar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($layanan  as $index => $layanan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $layanan->jenis_layanan }}</td>
                <td>{{ $layanan->deskripsi }}</td>
                <td>{{ number_format($layanan->harga, 0, ',', '.') }}</td>
                <td>{{ $layanan->gambar}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection