@extends('dashboard.layouts.main')

@section('content')
    <div class="container">
        <h1>Daftar Promo</h1>

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

        @canany(['admin', 'pegawai'])
            <a href="{{ route('promo.create') }}" class="btn btn-primary mb-3">Tambah Promo</a>
        @endcanany

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul Promo</th>
                    <th>Deskripsi</th>
                    <th>Jenis Layanan</th>
                    <th>Diskon</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Total Kuota</th>
                    <th>Aksi</th> <!-- Tambahkan kolom untuk aksi -->
                </tr>
            </thead>
            <tbody>
                @foreach ($promos as $promo)
                    <tr>
                        <td>{{ $promo->judul_promo }}</td>
                        <td>{{ $promo->deskripsi }}</td>
                        <td>{{ $promo->jenis_layanan }}</td>
                        <td>{{ $promo->diskon }}</td>
                        <td>{{ $promo->tanggal_mulai }}</td>
                        <td>{{ $promo->tanggal_selesai }}</td>
                        <td>{{ $promo->total_kuota }}</td>
                        <td>
                            <button 
                                type="button" 
                                class="btn btn-primary btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#registerModal" 
                                data-promo-id="{{ $promo->promo_id }}"> 
                                Daftarkan Pasien
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Form Pendaftaran Pasien -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Daftarkan Pasien ke Promo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('promo.register') }}" method="POST">
                    @csrf
                    <!-- Hidden input untuk ID Promo -->
                    <input name="promo_id" id="promo_id" value="{{ $promo->promo_id }}">
                    
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="id_pasien" class="form-label">Pilih Pasien</label>
                            <select name="id_pasien" id="id_pasien" class="form-select" required>
                                <option value="" selected disabled>Pilih Pasien</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Daftarkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    const registerModal = document.getElementById('registerModal');
    registerModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Tombol yang diklik
        const promoId = button.getAttribute('data-promo-id'); // Ambil nilai ID promo dari atribut data-promo-id

        // Isi nilai input hidden pada modal
        const promoIdInput = registerModal.querySelector('#promo_id');
        promoIdInput.value = promoId;
    });
</script>
@endsection
