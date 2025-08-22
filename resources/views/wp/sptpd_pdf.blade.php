<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SPTPD - {{ $sptpd->nomor_sptpd }}</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0;
            padding: 20px;
            font-size: 12px;
            line-height: 1.4;
        }
        
        .header {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            color: #000;
        }
        
        .header h2 {
            margin: 5px 0;
            font-size: 16px;
            color: #333;
        }
        
        .header p {
            margin: 2px 0;
            font-size: 11px;
            color: #666;
        }
        
        .sptpd-info {
            background: #f8f9fa;
            padding: 15px;
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
        }
        
        .sptpd-info h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #333;
        }
        
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 5px;
        }
        
        .info-label {
            display: table-cell;
            width: 30%;
            font-weight: bold;
        }
        
        .info-colon {
            display: table-cell;
            width: 3%;
        }
        
        .info-value {
            display: table-cell;
            width: 67%;
        }
        
        .wp-data {
            margin-bottom: 25px;
        }
        
        .wp-data h3 {
            background: #007bff;
            color: white;
            padding: 10px;
            margin: 0 0 15px 0;
            font-size: 14px;
        }
        
        .wp-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .wp-table td {
            border: 1px solid #ddd;
            padding: 8px;
            vertical-align: top;
        }
        
        .wp-table .label {
            background: #f8f9fa;
            font-weight: bold;
            width: 25%;
        }
        
        .calculation {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            margin: 20px 0;
        }
        
        .calculation h3 {
            margin: 0 0 15px 0;
            font-size: 14px;
            color: #856404;
        }
        
        .calc-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .calc-table td {
            padding: 5px 8px;
            border-bottom: 1px solid #f1c40f;
        }
        
        .calc-table .calc-label {
            width: 70%;
        }
        
        .calc-table .calc-value {
            width: 30%;
            text-align: right;
            font-weight: bold;
        }
        
        .total-row {
            background: #f39c12;
            color: white;
            font-weight: bold;
        }
        
        .total-row td {
            border-bottom: none;
            font-size: 13px;
        }
        
        .footer {
            margin-top: 30px;
            border-top: 2px solid #000;
            padding-top: 15px;
        }
        
        .signature-area {
            display: table;
            width: 100%;
            margin-top: 30px;
        }
        
        .signature-left, .signature-right {
            display: table-cell;
            width: 50%;
            text-align: center;
            vertical-align: top;
        }
        
        .signature-box {
            border: 1px solid #000;
            height: 80px;
            margin: 10px 20px;
            position: relative;
        }
        
        .signature-label {
            position: absolute;
            bottom: 5px;
            left: 0;
            right: 0;
            font-size: 10px;
            font-weight: bold;
        }
        
        .notes {
            background: #e9ecef;
            padding: 15px;
            margin-top: 20px;
            font-size: 10px;
        }
        
        .notes h4 {
            margin: 0 0 10px 0;
            font-size: 11px;
            color: #495057;
        }
        
        .notes ol {
            margin: 0;
            padding-left: 15px;
        }
        
        .notes li {
            margin-bottom: 3px;
        }
        
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>SURAT PEMBERITAHUAN PAJAK DAERAH</h1>
        <h2>(SPTPD)</h2>
        <p>BADAN PENDAPATAN DAERAH KOTA BOGOR</p>
        <p>Jl. Ir. H. Juanda No. 10, Bogor 16122 | Telp: (0251) 8321075</p>
    </div>

    <!-- Info SPTPD -->
    <div class="sptpd-info">
        <h3>INFORMASI SPTPD</h3>
        <div class="info-row">
            <div class="info-label">Nomor SPTPD</div>
            <div class="info-colon">:</div>
            <div class="info-value fw-bold">{{ $sptpd->nomor_sptpd }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal Dibuat</div>
            <div class="info-colon">:</div>
            <div class="info-value">{{ $sptpd->created_at->format('d F Y') }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Jatuh Tempo</div>
            <div class="info-colon">:</div>
            <div class="info-value fw-bold">{{ \Carbon\Carbon::parse($sptpd->jatuh_tempo)->format('d F Y') }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Status</div>
            <div class="info-colon">:</div>
            <div class="info-value">{{ $sptpd->status }}</div>
        </div>
    </div>

    <!-- Data Wajib Pajak -->
    <div class="wp-data">
        <h3>DATA WAJIB PAJAK</h3>
        <table class="wp-table">
            <tr>
                <td class="label">NPWPD</td>
                <td>{{ $sptpd->subjekPajak->npwpd }}</td>
                <td class="label">Jenis Pajak</td>
                <td>{{ $sptpd->objekPajak->objek_pajak ?? 'Pajak Umum' }}</td>
            </tr>
            <tr>
                <td class="label">Nama</td>
                <td>{{ $sptpd->subjekPajak->subjek_pajak }}</td>
                <td class="label">Masa Pajak</td>
                <td>
                    {{ \Carbon\Carbon::parse($sptpd->masa_pajak_awal)->format('F Y') }} - 
                    {{ \Carbon\Carbon::parse($sptpd->masa_pajak_akhir)->format('F Y') }}
                </td>
            </tr>
            <tr>
                <td class="label">Pemilik</td>
                <td>{{ $sptpd->subjekPajak->pemilik }}</td>
                <td class="label">Total Pajak</td>
                <td>Rp {{ number_format($sptpd->total_pajak_terutang ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td colspan="3">
                    {{ $sptpd->subjekPajak->alamat }}<br>
                    {{ $sptpd->subjekPajak->kelurahan }}, {{ $sptpd->subjekPajak->kecamatan }}<br>
                    {{ $sptpd->subjekPajak->kabupaten }} {{ $sptpd->subjekPajak->kode_pos }}
                </td>
            </tr>
        </table>
    </div>

    <!-- Perhitungan Pajak -->
    <div class="calculation">
        <h3>INFORMASI PAJAK</h3>
        <table class="calc-table">
            <tr class="total-row">
                <td class="calc-label">TOTAL PAJAK YANG HARUS DIBAYARKAN</td>
                <td class="calc-value">
                    Rp {{ number_format($sptpd->total_pajak_terutang ?? 0, 0, ',', '.') }}
                </td>
            </tr>
            @if($sptpd->keterangan)
            <tr>
                <td class="calc-label">Keterangan</td>
                <td class="calc-value">{{ $sptpd->keterangan }}</td>
            </tr>
            @endif
        </table>
    </div>

    <!-- Footer dengan TTD -->
    <div class="footer">
        <div class="signature-area">
            <div class="signature-left">
                <p><strong>Wajib Pajak</strong></p>
                <div class="signature-box">
                    <div class="signature-label">{{ $sptpd->subjekPajak->pemilik }}</div>
                </div>
                <p>Tanggal: ________________</p>
            </div>
            <div class="signature-right">
                <p><strong>Petugas Verifikasi</strong></p>
                <div class="signature-box">
                    <div class="signature-label">(_________________)</div>
                </div>
                <p>Tanggal: ________________</p>
            </div>
        </div>
    </div>

    <!-- Catatan -->
    <div class="notes">
        <h4>CATATAN PENTING:</h4>
        <ol>
            <li>SPTPD ini harus diisi dengan lengkap dan benar</li>
            <li>Pembayaran dilakukan paling lambat tanggal {{ \Carbon\Carbon::parse($sptpd->jatuh_tempo)->format('d F Y') }}</li>
            <li>Keterlambatan pembayaran dikenakan denda 2% per bulan</li>
            <li>Pembayaran dapat dilakukan di Bank yang ditunjuk atau melalui transfer</li>
            <li>Bukti pembayaran wajib disimpan sebagai arsip</li>
            <li>Untuk informasi lebih lanjut hubungi Badan Pendapatan Daerah Kota Bogor</li>
        </ol>
    </div>

    <div class="text-center" style="margin-top: 20px; font-size: 10px; color: #666;">
        Dicetak pada: {{ now()->format('d F Y H:i:s') }} | Sistem SIMPAD Kota Bogor
    </div>
</body>
</html>
