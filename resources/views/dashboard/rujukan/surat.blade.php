<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Rujukan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin: 0 30px;
        }

        .signature {
            text-align: right;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Surat Rujukan</h2>
        <p>Bidan Mahanum</p>
    </div>
    <div class="content">
        <p><strong>Kepada Yth.</strong></p>
        <p>{{ $rujukan->tujuan_rujukan }}</p>
        <br>
        <p>Dengan hormat,</p>
        <p>Bersama ini kami merujuk pasien dengan data sebagai berikut:</p>
        <table>
            <tr>
                <td>Nama</td>
                <td>: {{ $rujukan->user->nama }}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>: {{ $rujukan->user->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $rujukan->user->alamat }}</td>
            </tr>
            <tr>
                <td>Keterangan </td>
                <td>: {{ $rujukan->keterangan ?? '-' }}</td>
            </tr>
        </table>
        <p>Mohon bantuan tindak lanjutnya. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>
        <div class="signature">
            <p>Hormat kami,</p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p>Bidan Mahanum</p>
        </div>
    </div>
</body>

</html>