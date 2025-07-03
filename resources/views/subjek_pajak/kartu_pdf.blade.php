<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu NPWPD</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .kartu {
            width: 85.6mm;
            height: 53.98mm;
            border: 1px solid #333;
            border-radius: 3mm;
            padding: 5mm 7mm;
            margin: 0 auto 0 auto;
            background: #f8f9fa;
            page-break-after: always;
            box-sizing: border-box;
        }
        .kartu h3 { margin: 0 0 4mm 0; font-size: 5mm; }
        .kartu table { width: 100%; font-size: 3.2mm; }
        .kartu td { padding: 0.5mm 0; }
        .npwpd { font-size: 4mm; font-weight: bold; letter-spacing: 1mm; margin-bottom: 2mm; }
        .back-title { font-size: 4mm; font-weight: bold; margin-bottom: 2mm; }
        .back-content { font-size: 2.7mm; }
    </style>
</head>
<body>
    {{-- Halaman Depan --}}
    <div class="kartu">
        <h3>KARTU NPWPD</h3>
        <div class="npwpd">{{ $subjek->npwpd }}</div>
        <table>
            <tr>
                <td>Nama</td>
                <td>: {{ $subjek->subjek_pajak }}</td>
            </tr>
            <tr>
                <td>Pemilik</td>
                <td>: {{ $subjek->pemilik }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $subjek->alamat }}</td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>: {{ $subjek->kecamatan }}</td>
            </tr>
            <tr>
                <td>Kelurahan</td>
                <td>: {{ $subjek->kelurahan }}</td>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td>: {{ $subjek->kabupaten }}</td>
            </tr>
            <tr>
                <td>No. Pengukuhan</td>
                <td>: {{ $subjek->noPengukuhan }}</td>
            </tr>
            <tr>
                <td>Tgl. Pengukuhan</td>
                <td>: {{ \Carbon\Carbon::parse($subjek->tanggalPengukuhan)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>Pejabat</td>
                <td>: {{ $subjek->pejabat }}</td>
            </tr>
        </table>
        <div style="margin-top:2mm; font-size:2.5mm; color:#888;">
            Dicetak pada: {{ now()->format('d-m-Y H:i') }}
        </div>
    </div>

    {{-- Halaman Belakang --}}
    <div class="kartu">
        <div class="back-title">KETENTUAN</div>
        <div class="back-content">
            <ol style="padding-left: 4mm; margin:0;">
                <li>Kartu ini adalah identitas Subjek Pajak Daerah.</li>
                <li>Wajib dibawa saat melakukan transaksi terkait pajak daerah.</li>
                <li>Jika kartu hilang/rusak, segera lapor ke kantor pajak daerah.</li>
                <li>Kartu ini tidak dapat dipindahtangankan.</li>
                <li>Setiap perubahan data wajib dilaporkan ke kantor pajak daerah.</li>
            </ol>
            <div style="margin-top:2mm;">
                <b>Kontak:</b><br>
                Telp: (021) 12345678<br>
                Email: pajakdaerah@contoh.go.id
            </div>
        </div>
    </div>
</body>
</html>
