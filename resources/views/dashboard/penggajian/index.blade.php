@extends('dashboard.layouts.main')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Penggajian Pegawai</h1>
        <!-- Button untuk melihat gaji pokok -->
        <a href="{{ route('gaji-pokok.index') }}" class="btn btn-primary">Gaji Pokok</a>
    </div>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama Bidan</th>
                <th>Gaji Pokok</th>
                <th>Bonus</th>
                <th>Total Gaji</th>
                <th>Awal Periode</th>
                <th>Akhir Periode</th>
                <th>Status</th>
                <th>Tanggal Gajian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penggajian as $item)
                <tr>
                    <td>{{ $item->nama_bidan }}</td>
                    <td>Rp{{ number_format($item->gaji_pokok, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($item->bonus, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($item->total_gaji, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->awal_periode_gaji)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->akhir_periode_gaji)->format('d M Y') }}</td>
                    <td>
                        @if($item->status === 'Belum Dibayar')
                            <span class="badge bg-warning">{{ $item->status }}</span>
                        @else
                            <span class="badge bg-success">{{ $item->status }}</span>
                        @endif
                    </td>
                    <td>{{ $item->tanggal_penggajian ? \Carbon\Carbon::parse($item->tanggal_penggajian)->format('d M Y') : '-' }}</td>
                    <td>
                        <!-- Cek jika akhir periode gaji sudah lewat -->
                        @if(\Carbon\Carbon::parse($item->akhir_periode_gaji)->lessThan(\Carbon\Carbon::now()) && $item->status === 'Belum Dibayar')
                            <form action="{{ route('gaji-update-status', $item->id_penggajian) }}" method="POST" id="statusForm-{{ $item->id_penggajian }}">
                                @csrf
                                @method('PUT')
                                <button type="button" class="btn btn-warning" onclick="confirmUpdate({{ $item->id_penggajian }})">Serahkan Gaji</button>
                            </form>
                        @endif
                        <a href="{{ route('gaji-detail', $item->id_penggajian) }}" class="btn btn-info btn-sm">Lihat Detail</a>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Data penggajian belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    function confirmUpdate(id) {
        const confirmation = confirm('Apakah Anda yakin ingin menandai gaji ini sebagai sudah dibayar?');
        if (confirmation) {
            document.getElementById('statusForm-' + id).submit();
        }
    }
</script>

@endsection
