<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .total {
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <h2>Invoice Transaksi</h2>
        <!-- Display Nama Pasien -->
        <p><strong>Nama Pasien:</strong> {{ $transaksi->nama_pasien ?? 'Nama Pasien Tidak Ditemukan' }}</p>
        <!-- Display Nama Bidan -->
        <p><strong>Nama Bidan:</strong> {{ $transaksi->nama_bidan ?? 'Nama Bidan Tidak Ditemukan' }}</p>
        <p><strong>Waktu Transaksi:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y H:i') }}</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Layanan</th>
                    <th>Harga</th>
                    <th>Potongan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            @php
                $totalTransaksi = 0;
                $details = explode('; ', $transaksi->detail_layanan); // Pisahkan layanan berdasarkan ';'
            @endphp

            @foreach($details as $index => $detail)
                @php
                    // Ambil jenis layanan, harga, dan potongan dari detail
                    preg_match('/^(.*?) \(Harga: (.*?), Potongan: (.*?)\)$/', $detail, $matches);
                    $jenisLayanan = $matches[1] ?? '-';
                    $harga = (int) ($matches[2] ?? 0);
                    $potongan = (int) ($matches[3] ?? 0);
                    $total = $harga - $potongan;

                    $totalTransaksi += $total;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $jenisLayanan }}</td>
                    <td>Rp {{ number_format($harga) }}</td>
                    <td>Rp {{ number_format($potongan) }}</td>
                    <td>Rp {{ number_format($total) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-center">Total Transaksi</th>
                <th>Rp {{ number_format($totalTransaksi) }}</th>
            </tr>
        </tfoot>
        </table>

        <p><strong>Keterangan:</strong> {{ $transaksi->keterangan ?? '-' }}</p>


        <div class="text-right" style="margin-top: 20px;">
            <p><strong>Terima kasih atas kepercayaan Anda!</strong></p>
        </div>
    </div>
</body>
</html>
