<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu NPWPD</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0;
            padding: 15px;
            font-size: 12px;
        }
        
        .container {
            width: 100%;
            display: table;
            table-layout: fixed;
        }
        
        .kartu-wrapper {
            display: table-cell;
            vertical-align: top;
            width: 50%;
            padding: 0 10px;
        }
        
        .kartu {
            width: 100%;
            max-width: 300px;
            height: 180px;
            border: 2px solid #000;
            border-radius: 6px;
            padding: 12px;
            background: white;
            box-sizing: border-box;
            position: relative;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 6px;
            margin-bottom: 8px;
        }
        
        .header h3 { 
            margin: 0; 
            font-size: 14px; 
            font-weight: bold;
            color: #000;
        }
        
        .npwpd { 
            font-size: 12px; 
            font-weight: bold; 
            letter-spacing: 0.5px; 
            margin: 4px 0;
            color: #000;
        }
        
        .content {
            font-size: 9px;
            line-height: 1.3;
        }
        
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .content td {
            padding: 1px 0;
            vertical-align: top;
        }
        
        .content .label {
            width: 70px;
            font-weight: normal;
        }
        
        .content .colon {
            width: 8px;
        }
        
        .content .value {
            font-weight: normal;
        }
        
        .footer {
            position: absolute;
            bottom: 8px;
            left: 12px;
            right: 12px;
            font-size: 7px;
            color: #666;
            text-align: center;
        }
        
        /* Halaman Belakang */
        .back-title { 
            font-size: 12px; 
            font-weight: bold; 
            margin-bottom: 8px;
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 4px;
        }
        
        .back-content { 
            font-size: 8px; 
            line-height: 1.3;
        }
        
        .back-content ol {
            padding-left: 12px;
            margin: 0;
        }
        
        .back-content li {
            margin-bottom: 2px;
        }
        
        .contact {
            margin-top: 8px;
            padding-top: 6px;
            border-top: 1px solid #ccc;
            font-size: 7px;
            text-align: center;
            line-height: 1.2;
        }
        
        .separator {
            text-align: center;
            margin: 15px 0 10px 0;
            font-size: 8px;
            color: #666;
            clear: both;
        }
        
        .instructions {
            text-align: center; 
            font-size: 8px; 
            color: #666; 
            margin-top: 5px;
            line-height: 1.3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="kartu-wrapper">
            
            <div class="kartu">
                <div class="header">
                    <h3>KARTU NPWPD</h3>
                    <div class="npwpd"><?php echo e($subjek->npwpd); ?></div>
                </div>
                
                <div class="content">
                    <table>
                        <tr>
                            <td class="label">Nama</td>
                            <td class="colon">:</td>
                            <td class="value"><?php echo e($subjek->subjek_pajak); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Pemilik</td>
                            <td class="colon">:</td>
                            <td class="value"><?php echo e($subjek->pemilik); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Alamat</td>
                            <td class="colon">:</td>
                            <td class="value"><?php echo e($subjek->alamat); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Kecamatan</td>
                            <td class="colon">:</td>
                            <td class="value"><?php echo e($subjek->kecamatan); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Kelurahan</td>
                            <td class="colon">:</td>
                            <td class="value"><?php echo e($subjek->kelurahan); ?></td>
                        </tr>
                        <tr>
                            <td class="label">No. Pengukuhan</td>
                            <td class="colon">:</td>
                            <td class="value"><?php echo e($subjek->noPengukuhan); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Tgl. Pengukuhan</td>
                            <td class="colon">:</td>
                            <td class="value"><?php echo e(\Carbon\Carbon::parse($subjek->tanggalPengukuhan)->format('d-m-Y')); ?></td>
                        </tr>
                    </table>
                </div>
                
                <div class="footer">
                    Dicetak: <?php echo e(now()->format('d-m-Y H:i')); ?>

                </div>
            </div>
        </div>

        <div class="kartu-wrapper">
            
            <div class="kartu">
                <div class="back-title">KETENTUAN PENGGUNAAN</div>
                <div class="back-content">
                    <ol>
                        <li>Kartu ini adalah identitas resmi Wajib Pajak Daerah</li>
                        <li>Wajib dibawa saat melakukan transaksi pajak daerah</li>
                        <li>Jika hilang/rusak, segera lapor ke Badan Pendapatan Daerah</li>
                        <li>Kartu tidak dapat dipindahtangankan</li>
                        <li>Perubahan data wajib dilaporkan maksimal 30 hari</li>
                    </ol>
                    
                    <div class="contact">
                        <strong>BADAN PENDAPATAN DAERAH KOTA BOGOR</strong><br>
                        Jl. Ir. H. Juanda No. 10, Bogor<br>
                        Telp: (0251) 8321075<br>
                        Email: bapenda@kotabogor.go.id
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="separator">
        ✂️ ───────────────────────────────────────────────────────────────────────────────────────────────────────────────────── ✂️
    </div>
    
    <div class="instructions">
        <strong>Petunjuk:</strong> Cetak dokumen ini, lalu potong kedua kartu sesuai garis border.<br>
        Lipat di tengah atau gunakan sebagai kartu terpisah depan-belakang.
    </div>
</body>
</html>
<?php /**PATH D:\Project\simpad\resources\views/subjek_pajak/kartu_pdf.blade.php ENDPATH**/ ?>