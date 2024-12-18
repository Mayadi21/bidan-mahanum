@extends('dashboard.layouts.main')

@section('content')
    <div class="container">
        <h1 class="my-4">Daftar Promo</h1>

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

        <div class="row">
            @foreach ($promos as $promo)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $promo->judul_promo }}</h5>
                            <p class="card-text">
                                <strong>Tanggal Mulai:</strong> {{ $promo->tanggal_mulai }}<br>
                                <strong>Tanggal Selesai:</strong> {{ $promo->tanggal_selesai }}
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('promo.show', $promo->promo_id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                            @canany(['admin', 'pegawai'])
                            <button 
                                type="button" 
                                class="btn btn-primary btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#registerModal" 
                                data-promo-id="{{ $promo->promo_id }}"> 
                                Daftarkan Pasien
                            </button>
                            @endcanany
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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
                    <!-- Input promo_id dibuat hidden dan dinamis -->
                    <input type="hidden" name="promo_id" id="promo_id" value="">
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

    <script>
        const registerModal = document.getElementById('registerModal');
        registerModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Tombol yang memicu modal
            const promoId = button.getAttribute('data-promo-id'); // Ambil promo_id dari tombol
            const promoIdInput = registerModal.querySelector('#promo_id'); // Cari input promo_id di dalam modal
    
            if (promoIdInput) {
                promoIdInput.value = promoId; // Isi input dengan nilai promo_id
                console.log('Promo ID set successfully:', promoIdInput.value); // Log setelah mengisi
            } else {
                console.error('Promo ID input field not found.');
            }
        });
    </script>
@endsection

