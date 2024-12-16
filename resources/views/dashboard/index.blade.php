@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        Hello, {{ auth()->user()->nama }}
    </h1>
</div>
<!-- Ringkasan Akun Section -->
<div class="account-summary d-flex justify-content-between">
    <!-- Jumlah Kunjungan Card -->
    <div class="card card-summary">
        <div class="card-header">Jumlah Kunjungan</div>
        <div class="card-body">
            <p class="text-center-large"> {{ $totalKunjungan }} </p>
        </div>
    </div>

    <!-- Status Janji Temu Card -->
    <div class="card card-summary">
        <div class="card-header">Janji temu berikutnya</div>
        <div class="card-body">
            @if ($janjiTemu)
            <p class="text-center-large">
                <strong>
                    {{ 
                        \Carbon\Carbon::parse($janjiTemu->waktu_mulai)->format('H:i') === '00:00' 
                        ? \Carbon\Carbon::parse($janjiTemu->waktu_mulai)->translatedFormat('l, d M Y') 
                        : \Carbon\Carbon::parse($janjiTemu->waktu_mulai)->translatedFormat('l, d M Y H:i') 
                    }}
                </strong>
            </p>
                        @else
            <p class="text-center-large text-muted">Anda belum memiliki janji temu yang disetujui.</p>
            @endif
        </div>
    </div>
</div>

<!-- Notifikasi -->
<div class="card mt-3">
    <div class="card-body">
        <div class="alert alert-info">
            @if($janjiTemu)
            {{ $sisaWaktu }}
            @else
            Anda belum memiliki janji temu yang disetujui.
            @endif
        </div>
    </div>
</div>
</div>




@endsection