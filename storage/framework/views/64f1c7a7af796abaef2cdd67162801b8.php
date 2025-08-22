<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data SPTPD - <?php echo e(date('d-m-Y')); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 15px;
            font-size: 10px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #00712D;
            padding-bottom: 15px;
        }
        
        .header h1 {
            color: #00712D;
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        
        .header h2 {
            color: #666;
            margin: 5px 0 0 0;
            font-size: 12px;
            font-weight: normal;
        }
        
        .export-info {
            text-align: right;
            margin-bottom: 15px;
            font-size: 9px;
            color: #666;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: left;
            font-size: 9px;
        }
        
        th {
            background-color: #00712D;
            color: white;
            font-weight: bold;
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 8px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        
        .no-data {
            text-align: center;
            padding: 30px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SISTEM INFORMASI MANAJEMEN PAJAK DAERAH</h1>
        <h2>Data Surat Pemberitahuan Pajak Daerah (SPTPD)</h2>
    </div>
    
    <div class="export-info">
        <strong>Tanggal Export:</strong> <?php echo e(date('d F Y, H:i')); ?> WIB<br>
        <strong>Total Data:</strong> <?php echo e($sptpds->count()); ?> record(s)
        <?php if($sptpds->count() >= 1000): ?>
            <br><strong>Catatan:</strong> Menampilkan maksimal 1000 data terbaru
        <?php endif; ?>
    </div>
    
    <?php if($sptpds->count() > 0): ?>
    <table>
        <thead>
            <tr>
                <th style="width: 12%">No. SPTPD</th>
                <th style="width: 8%">Tanggal</th>
                <th style="width: 12%">NOPD</th>
                <th style="width: 20%">Subjek Pajak</th>
                <th style="width: 15%">Jenis Pajak</th>
                <th style="width: 8%">Masa</th>
                <th style="width: 15%">Total Pajak Terutang</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $sptpds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sptpd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-center">
                    <?php echo e($sptpd->created_at ? $sptpd->created_at->format('Y.m.d') : now()->format('Y.m.d')); ?>.<?php echo e(str_pad($sptpd->id, 5, '0', STR_PAD_LEFT)); ?>

                </td>
                <td class="text-center">
                    <?php echo e($sptpd->created_at ? $sptpd->created_at->format('d-m-Y') : '-'); ?>

                </td>
                <td><?php echo e($sptpd->objekPajak->nopd ?? '-'); ?></td>
                <td><?php echo e($sptpd->objekPajak->subjekPajak->subjek_pajak ?? '-'); ?></td>
                <td><?php echo e($sptpd->objekPajak->jenis_pajak ?? '-'); ?></td>
                <td class="text-center">
                    <?php echo e($sptpd->masa_pajak_awal ? \Carbon\Carbon::parse($sptpd->masa_pajak_awal)->format('M Y') : '-'); ?>

                </td>
                <td class="text-right">
                    Rp <?php echo e(number_format($sptpd->total_pajak_terutang ?? 0, 0, ',', '.')); ?>

                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot>
            <tr style="background-color: #f0f8ff; font-weight: bold;">
                <td colspan="6" class="text-center"><strong>TOTAL PAJAK TERUTANG</strong></td>
                <td class="text-right">
                    <strong>Rp <?php echo e(number_format($sptpds->sum('total_pajak_terutang'), 0, ',', '.')); ?></strong>
                </td>
            </tr>
        </tfoot>
    </table>
    <?php else: ?>
    <div class="no-data">
        <h3>Tidak ada data SPTPD untuk diekspor</h3>
        <p>Silakan tambah data SPTPD terlebih dahulu</p>
    </div>
    <?php endif; ?>
    
    <div class="footer">
        <p><strong>SIMPAD - Sistem Informasi Manajemen Pajak Daerah</strong></p>
        <p>Dokumen ini digenerate secara otomatis pada <?php echo e(date('d F Y, H:i:s')); ?> WIB</p>
    </div>
</body>
</html>
<?php /**PATH E:\Project\simpad\resources\views/sptpd/pdf.blade.php ENDPATH**/ ?>