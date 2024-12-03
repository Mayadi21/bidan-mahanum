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
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Status</th>
                <th>Tanggal Gajian</th>

            </tr>
        </thead>
        <tbody>
            @forelse($penggajian as $item)
                <tr>
                    <td>{{ $item->nama_bidan }}</td>
                    <td>Rp{{ number_format($item->gaji_pokok, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($item->bonus, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($item->total_gaji, 0, ',', '.') }}</td>
                    <td>{{ $item->bulan_gaji }}</td>
                    <td>{{ $item->tahun_gaji }}</td>

                    <td>
                        @if($item->status === 'Belum Diserahkan')
                            <form action="{{ route('gaji-update-status', $item->id_penggajian) }}" method="POST" id="statusForm-{{ $item->id_penggajian }}">
                                @csrf
                                @method('PUT')
                                <button type="button" class="btn btn-warning" onclick="confirmUpdate({{ $item->id_penggajian }})">Tandai Sudah Diserahkan</button>
                            </form>
                        @else
                            <span class="badge bg-success">{{ $item->status }}</span>
                        @endif
                    </td>
                        
                    <td>{{ $item->tanggal_penggajian ? \Carbon\Carbon::parse($item->tanggal_penggajian)->format('d M Y') : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Data penggajian belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    function confirmUpdate(id) {
        const confirmation = confirm('Apakah Anda yakin ingin menyerahkan gaji ini?');
        if (confirmation) {
            // If the user confirms, submit the form
            document.getElementById('statusForm-' + id).submit();
        }
    }
</script>

@endsection
