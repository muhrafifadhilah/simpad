<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Bayar - <?php echo e($sptpd->nomor_sptpd); ?></title>
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
            font-size: 20px;
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
        
        .lunas-stamp {
            position: absolute;
            top: 150px;
            right: 50px;
            transform: rotate(-15deg);
            border: 3px solid #28a745;
            color: #28a745;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 10px;
            background: rgba(40, 167, 69, 0.1);
        }
        
        .bukti-info {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .bukti-info h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #155724;
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
        
        .payment-details {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            margin: 20px 0;
        }
        
        .payment-details h3 {
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
            background: #28a745;
            color: white;
            font-weight: bold;
        }
        
        .total-row td {
            border-bottom: none;
            font-size: 13px;
        }
        
        .payment-info {
            background: #e7f3ff;
            border: 1px solid #b8daff;
            padding: 15px;
            margin: 20px 0;
        }
        
        .payment-info h3 {
            margin: 0 0 15px 0;
            font-size: 14px;
            color: #004085;
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
        
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
    </style>
</head>
<body>
    <!-- Stamp LUNAS -->
    <div class="lunas-stamp">LUNAS</div>

    <!-- Header -->
    <div class="header">
        <h1>BUKTI PEMBAYARAN PAJAK DAERAH</h1>
        <h2>SURAT PEMBERITAHUAN PAJAK DAERAH (SPTPD)</h2>
        <p>BADAN PENDAPATAN DAERAH KOTA BOGOR</p>
        <p>Jl. Ir. H. Juanda No. 10, Bogor 16122 | Telp: (0251) 8321075</p>
    </div>

    <!-- Info Bukti Bayar -->
    <div class="bukti-info">
        <h3>INFORMASI PEMBAYARAN</h3>
        <div class="info-row">
            <div class="info-label">Nomor SPTPD</div>
            <div class="info-colon">:</div>
            <div class="info-value fw-bold"><?php echo e($sptpd->nomor_sptpd); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal Bayar</div>
            <div class="info-colon">:</div>
            <div class="info-value fw-bold"><?php echo e(\Carbon\Carbon::parse($sptpd->tanggal_bayar)->format('d F Y H:i')); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Metode Pembayaran</div>
            <div class="info-colon">:</div>
            <div class="info-value"><?php echo e(ucfirst($sptpd->metode_bayar)); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Status</div>
            <div class="info-colon">:</div>
            <div class="info-value fw-bold" style="color: #28a745;">LUNAS</div>
        </div>
    </div>

    <!-- Data Wajib Pajak -->
    <div class="wp-data">
        <h3>DATA WAJIB PAJAK</h3>
        <table class="wp-table">
            <tr>
                <td class="label">NPWPD</td>
                <td><?php echo e($sptpd->subjekPajak->npwpd); ?></td>
                <td class="label">Jenis Pajak</td>
                <td><?php echo e($sptpd->objekPajak->jenis_pajak ?? 'Pajak Umum'); ?></td>
            </tr>
            <tr>
                <td class="label">Nama</td>
                <td><?php echo e($sptpd->subjekPajak->subjek_pajak); ?></td>
                <td class="label">Masa Pajak</td>
                <td>
                    <?php echo e(\Carbon\Carbon::parse($sptpd->masa_pajak_awal)->format('F Y')); ?> - 
                    <?php echo e(\Carbon\Carbon::parse($sptpd->masa_pajak_akhir)->format('F Y')); ?>

                </td>
            </tr>
            <tr>
                <td class="label">Pemilik</td>
                <td><?php echo e($sptpd->subjekPajak->pemilik); ?></td>
                <td class="label">Tarif Pajak</td>
                <td><?php echo e($sptpd->tarif); ?>%</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td colspan="3">
                    <?php echo e($sptpd->subjekPajak->alamat); ?><br>
                    <?php echo e($sptpd->subjekPajak->kelurahan); ?>, <?php echo e($sptpd->subjekPajak->kecamatan); ?><br>
                    <?php echo e($sptpd->subjekPajak->kabupaten); ?> <?php echo e($sptpd->subjekPajak->kode_pos); ?>

                </td>
            </tr>
        </table>
    </div>

    <!-- Detail Pembayaran -->
    <div class="payment-details">
        <h3>RINCIAN PEMBAYARAN</h3>
        <table class="calc-table">
            <tr>
                <td class="calc-label">Dasar Pengenaan Pajak (Omzet)</td>
                <td class="calc-value">Rp <?php echo e(number_format($sptpd->dasar, 0, ',', '.')); ?></td>
            </tr>
            <tr>
                <td class="calc-label">Tarif Pajak</td>
                <td class="calc-value"><?php echo e($sptpd->tarif); ?>%</td>
            </tr>
            <tr>
                <td class="calc-label">Pajak Terutang</td>
                <td class="calc-value">Rp <?php echo e(number_format($sptpd->pajak_terutang, 0, ',', '.')); ?></td>
            </tr>
            <?php if($sptpd->denda > 0): ?>
            <tr>
                <td class="calc-label">Denda Keterlambatan</td>
                <td class="calc-value">Rp <?php echo e(number_format($sptpd->denda, 0, ',', '.')); ?></td>
            </tr>
            <?php endif; ?>
            <?php if($sptpd->bunga > 0): ?>
            <tr>
                <td class="calc-label">Bunga</td>
                <td class="calc-value">Rp <?php echo e(number_format($sptpd->bunga, 0, ',', '.')); ?></td>
            </tr>
            <?php endif; ?>
            <?php if($sptpd->kenaikan > 0): ?>
            <tr>
                <td class="calc-label">Kenaikan</td>
                <td class="calc-value">Rp <?php echo e(number_format($sptpd->kenaikan, 0, ',', '.')); ?></td>
            </tr>
            <?php endif; ?>
            <?php if($sptpd->kompensasi > 0): ?>
            <tr>
                <td class="calc-label">Kompensasi</td>
                <td class="calc-value">- Rp <?php echo e(number_format($sptpd->kompensasi, 0, ',', '.')); ?></td>
            </tr>
            <?php endif; ?>
            <tr class="total-row">
                <td class="calc-label">TOTAL YANG DIBAYAR</td>
                <td class="calc-value">
                    Rp <?php echo e(number_format($sptpd->setoran, 0, ',', '.')); ?>

                </td>
            </tr>
        </table>
    </div>

    <!-- Info Metode Pembayaran -->
    <?php if($sptpd->keterangan_bayar): ?>
    <div class="payment-info">
        <h3>KETERANGAN PEMBAYARAN</h3>
        <p><?php echo e($sptpd->keterangan_bayar); ?></p>
    </div>
    <?php endif; ?>

    <!-- Footer dengan TTD -->
    <div class="footer">
        <div class="signature-area">
            <div class="signature-left">
                <p><strong>Wajib Pajak</strong></p>
                <div class="signature-box">
                    <div class="signature-label"><?php echo e($sptpd->subjekPajak->pemilik); ?></div>
                </div>
                <p>Tanggal: <?php echo e(\Carbon\Carbon::parse($sptpd->tanggal_bayar)->format('d F Y')); ?></p>
            </div>
            <div class="signature-right">
                <p><strong>Petugas Bapenda</strong></p>
                <div class="signature-box">
                    <div class="signature-label">(_________________)</div>
                </div>
                <p>Tanggal: <?php echo e(\Carbon\Carbon::parse($sptpd->tanggal_bayar)->format('d F Y')); ?></p>
            </div>
        </div>
    </div>

    <!-- Catatan -->
    <div class="notes">
        <h4>CATATAN PENTING:</h4>
        <ul>
            <li>Bukti pembayaran ini merupakan dokumen resmi yang sah</li>
            <li>Simpan bukti pembayaran ini sebagai arsip</li>
            <li>Pembayaran telah diterima dan dicatat dalam sistem</li>
            <li>Untuk informasi lebih lanjut hubungi Badan Pendapatan Daerah Kota Bogor</li>
        </ul>
    </div>

    <div class="text-center" style="margin-top: 20px; font-size: 10px; color: #666;">
        Dicetak pada: <?php echo e(now()->format('d F Y H:i:s')); ?> | Sistem SIMPAD Kota Bogor
    </div>
</body>
</html>
<?php /**PATH D:\Project\simpad\resources\views/wp/bukti_bayar_pdf.blade.php ENDPATH**/ ?>