

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="modern-header d-flex justify-content-between p-4 align-items-center mb-5">
                    <div class="header-content">
                        <div class="header-left d-flex align-items-center">
                            <button class="sidebar-toggle-btn me-3" id="sidebarToggle">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div>
                                <h2 class="header-title">Executive Summary</h2>
                                <p class="header-subtitle">Data SPTPD Wajib Pajak - Tahun 2025</p>
                            </div>
                        </div>
                    </div>
                    <?php if(Auth::user()): ?>
                        <div class="user-profile-modern dropdown">
                            <div class="profile-container" data-bs-toggle="dropdown">
                                <div class="profile-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="profile-info">
                                    <span class="profile-name"><?php echo e(Auth::user()->userid); ?></span>
                                    <?php if(Auth::user()->role): ?>
                                        <small class="profile-role"><?php echo e(ucfirst(Auth::user()->role->name)); ?></small>
                                    <?php endif; ?>
                                </div>
                                <i class="fas fa-chevron-down profile-dropdown-icon"></i>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end modern-dropdown">
                                <li><a class="dropdown-item" href="<?php echo e(url('/profile')); ?>"><i class="fas fa-user-circle me-2"></i>Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="modern-controls-container mb-4">
                    <div class="controls-grid">
                        <div class="control-group">
                            <label for="searchSptpd" class="modern-label">
                                <i class="fas fa-search me-2"></i>Cari SPTPD
                            </label>
                            <div class="search-input-container">
                                <input type="text" id="searchSptpd" class="modern-search" placeholder="Ketik nomor SPTPD...">
                                <i class="fas fa-search search-icon"></i>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="filterStatus" class="modern-label">
                                <i class="fas fa-filter me-2"></i>Filter Status
                            </label>
                            <select id="filterStatus" class="modern-select">
                                <option value="">Semua Status</option>
                                <option value="Draft">Draft</option>
                                <option value="Terkirim">Terkirim</option>
                                <option value="Lunas">Lunas</option>
                                <option value="Terlambat">Terlambat</option>
                            </select>
                        </div>
                        <div class="control-group">
                            <label for="filterYear" class="modern-label">
                                <i class="fas fa-calendar me-2"></i>Filter Tahun
                            </label>
                            <select id="filterYear" class="modern-select">
                                <option value="">Semua Tahun</option>
                                <?php for($year = date('Y'); $year >= date('Y') - 5; $year--): ?>
                                    <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>
                

                
                <div class="modern-stats-grid mb-4">
                    <div class="stat-card-modern primary-gradient">
                        <div class="stat-icon-modern">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="stat-content-modern">
                            <h3 class="stat-number-modern"><?php echo e($sptpd->count()); ?></h3>
                            <p class="stat-label-modern">Total SPTPD</p>
                        </div>
                        <div class="stat-bg-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                    </div>
                    
                    <div class="stat-card-modern warning-gradient">
                        <div class="stat-icon-modern">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content-modern">
                            <h3 class="stat-number-modern"><?php echo e($sptpd->where('status', '!=', 'Lunas')->count()); ?></h3>
                            <p class="stat-label-modern">Belum Bayar</p>
                        </div>
                        <div class="stat-bg-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    
                    <div class="stat-card-modern success-gradient">
                        <div class="stat-icon-modern">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-content-modern">
                            <h3 class="stat-number-modern"><?php echo e($sptpd->where('status', 'Lunas')->count()); ?></h3>
                            <p class="stat-label-modern">Sudah Lunas</p>
                        </div>
                        <div class="stat-bg-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    
                    <div class="stat-card-modern info-gradient">
                        <div class="stat-icon-modern">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="stat-content-modern">
                            <h3 class="stat-number-modern"><?php echo e(number_format($sptpd->sum('pajak_terutang'), 0, ',', '.')); ?></h3>
                            <p class="stat-label-modern">Total Pajak (Rp)</p>
                        </div>
                        <div class="stat-bg-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>

                
                <div class="dashboard-grid mb-4">
                    <div class="main-card tax-summary-card">
                        <div class="card-header-modern">
                            <div class="card-title-section">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-bar me-2"></i>
                                    Tabulasi SPTPD Wajib Pajak
                                </h3>
                                <p class="card-subtitle">Tahun 2025</p>
                            </div>
                            <div class="view-toggle-modern">
                                <button id="showTableButton" class="toggle-btn active" data-tooltip="Tampilan Tabel">
                                    <i class="fas fa-table"></i>
                                </button>
                                <button id="showChartButton" class="toggle-btn" data-tooltip="Tampilan Grafik">
                                    <i class="fas fa-chart-bar"></i>
                                </button>
                            </div>
                        </div>

                        <div id="tableContainer" class="modern-table-container">
                            <?php if($sptpd->count() > 0): ?>
                                <div class="table-wrapper">
                                    <table class="modern-table" id="sptpdTable">
                                        <thead>
                                            <tr>
                                                <th class="text-start">
                                                    <div class="th-content">
                                                        <i class="fas fa-hashtag me-2"></i>No
                                                    </div>
                                                </th>
                                                <th class="text-start">
                                                    <div class="th-content">
                                                        <i class="fas fa-file-alt me-2"></i>Nomor SPTPD
                                                    </div>
                                                </th>
                                                <th class="text-center">
                                                    <div class="th-content">
                                                        <i class="fas fa-calendar me-2"></i>Periode
                                                    </div>
                                                </th>
                                                <th class="text-center">
                                                    <div class="th-content">
                                                        <i class="fas fa-clock me-2"></i>Jatuh Tempo
                                                    </div>
                                                </th>
                                                <th class="text-center">
                                                    <div class="th-content">
                                                        <i class="fas fa-building me-2"></i>Objek Pajak
                                                    </div>
                                                </th>
                                                <th class="text-end">
                                                    <div class="th-content">
                                                        <i class="fas fa-coins me-2"></i>Pajak Terutang
                                                    </div>
                                                </th>
                                                <th class="text-center">
                                                    <div class="th-content">
                                                        <i class="fas fa-info-circle me-2"></i>Status
                                                    </div>
                                                </th>
                                                <th class="text-center">
                                                    <div class="th-content">
                                                        <i class="fas fa-cogs me-2"></i>Aksi
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $sptpd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $status = $item->status ?? 'Draft';
                                                $badgeClass = match($status) {
                                                    'Lunas' => 'success',
                                                    'Terkirim' => 'info',
                                                    'Terlambat' => 'danger',
                                                    default => 'secondary'
                                                };
                                            ?>
                                            <tr class="table-row-modern">
                                                <td class="text-start">
                                                    <div class="cell-content"><?php echo e($index + 1); ?></div>
                                                </td>
                                                <td class="text-start">
                                                    <div class="cell-content">
                                                        <strong><?php echo e($item->nomor_sptpd ?? 'SPTPD-' . str_pad($item->id, 6, '0', STR_PAD_LEFT)); ?></strong>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="cell-content">
                                                        <?php if($item->masa_pajak_awal && $item->masa_pajak_akhir): ?>
                                                            <?php echo e(\Carbon\Carbon::parse($item->masa_pajak_awal)->format('M Y')); ?> -
                                                            <?php echo e(\Carbon\Carbon::parse($item->masa_pajak_akhir)->format('M Y')); ?>

                                                        <?php else: ?>
                                                            <span class="text-muted">-</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="cell-content">
                                                        <?php if($item->jatuh_tempo): ?>
                                                            <?php
                                                                $jatuhTempo = \Carbon\Carbon::parse($item->jatuh_tempo);
                                                                $isOverdue = $jatuhTempo->isPast() && ($item->status != 'Lunas');
                                                            ?>
                                                            <span class="<?php echo e($isOverdue ? 'text-danger fw-bold' : ''); ?>">
                                                                <?php echo e($jatuhTempo->format('d/m/Y')); ?>

                                                            </span>
                                                            <?php if($isOverdue): ?>
                                                                <br><small class="text-danger">Terlambat</small>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <span class="text-muted">-</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="cell-content">
                                                        <?php echo e($item->objekPajak->jenis_pajak ?? 'Objek Pajak Umum'); ?>

                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="cell-content amount">
                                                        <?php echo e(number_format($item->pajak_terutang ?? 0, 0, ',', '.')); ?>

                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="cell-content">
                                                        <span class="status-badge status-<?php echo e(strtolower($status)); ?>">
                                                            <i class="fas fa-<?php echo e($status == 'Lunas' ? 'check' : ($status == 'Terkirim' ? 'paper-plane' : 'clock')); ?> me-1"></i>
                                                            <?php echo e($status); ?>

                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="cell-content">
                                                        <div class="action-buttons">
                                                            <button class="action-btn primary" title="Lihat Detail" onclick="viewDetail(<?php echo e($item->id); ?>)">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <?php if($item->status != 'Lunas'): ?>
                                                                <button class="action-btn success" title="Bayar" onclick="bayarSptpd(<?php echo e($item->id); ?>)">
                                                                    <i class="fas fa-credit-card"></i>
                                                                </button>
                                                            <?php endif; ?>
                                                            <?php if($item->status == 'Lunas'): ?>
                                                                <button class="action-btn secondary" title="Bukti Bayar" onclick="buktiBayar(<?php echo e($item->id); ?>)">
                                                                    <i class="fas fa-receipt"></i>
                                                                </button>
                                                            <?php endif; ?>
                                                            <button class="action-btn info" title="Cetak PDF" onclick="printPdf(<?php echo e($item->id); ?>)">
                                                                <i class="fas fa-print"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="empty-state-modern">
                                    <div class="empty-icon">
                                        <i class="fas fa-file-invoice"></i>
                                    </div>
                                    <h3 class="empty-title">Belum Ada Data SPTPD</h3>
                                    <p class="empty-subtitle">Anda belum memiliki data SPTPD. Hubungi administrator untuk pembuatan SPTPD.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal View Detail SPTPD -->
<div class="modal fade" id="viewSptpdModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-eye me-2"></i>Detail SPTPD
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewSptpdContent">
                <div class="text-center">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                    <p class="mt-2">Memuat data...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-info" id="printDetailBtn" onclick="printDetailPdf()">
                    <i class="fas fa-print me-2"></i>Cetak PDF
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bayar SPTPD -->
<div class="modal fade" id="bayarSptpdModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-credit-card me-2"></i>Pembayaran SPTPD
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Setelah pembayaran, SPTPD akan berstatus "Lunas" dan tidak dapat diubah lagi.
                </div>
                
                <!-- Info SPTPD -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Detail SPTPD</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nomor SPTPD:</strong> <span id="bayarNomorSptpd">-</span></p>
                                <p><strong>Periode:</strong> <span id="bayarPeriode">-</span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Pajak Terutang:</strong> <span id="bayarPajakTerutang">-</span></p>
                                <p><strong>Total Bayar:</strong> <span id="bayarTotalBayar" class="text-success fw-bold">-</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="bayarSptpdForm" enctype="multipart/form-data">
                    <input type="hidden" id="bayarSptpdId" name="sptpd_id">
                    
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                        <select class="form-select" name="metode_bayar" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="tunai">Tunai (di Kantor Bapenda)</option>
                            <option value="va">Virtual Account</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Bukti Bayar (Opsional)</label>
                        <input type="file" class="form-control" name="bukti_bayar" accept=".pdf,.jpg,.jpeg,.png">
                        <div class="form-text">Format: PDF, JPG, JPEG, PNG. Maksimal 2MB</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan (Opsional)</label>
                        <textarea class="form-control" name="keterangan" rows="3" placeholder="Catatan tambahan tentang pembayaran..."></textarea>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Penting:</strong> Pastikan pembayaran sudah benar-benar dilakukan sebelum mengklik tombol "Konfirmasi Pembayaran".
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" onclick="konfirmasiBayar()">
                    <i class="fas fa-check me-2"></i>Konfirmasi Pembayaran
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Filter dan Search functionality
document.getElementById('searchSptpd').addEventListener('keyup', filterTable);
document.getElementById('filterStatus').addEventListener('change', filterTable);
document.getElementById('filterYear').addEventListener('change', filterTable);

function filterTable() {
    const search = document.getElementById('searchSptpd').value.toLowerCase();
    const status = document.getElementById('filterStatus').value;
    const year = document.getElementById('filterYear').value;
    const rows = document.querySelectorAll('#sptpdTable tbody tr');

    rows.forEach(row => {
        const nomor = row.cells[1].textContent.toLowerCase();
        const statusCell = row.cells[6].textContent;
        const periode = row.cells[2].textContent;
        
        let showRow = true;
        
        if (search && !nomor.includes(search)) showRow = false;
        if (status && !statusCell.includes(status)) showRow = false;
        if (year && !periode.includes(year)) showRow = false;
        
        row.style.display = showRow ? '' : 'none';
    });
}

function viewDetail(id) {
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('viewSptpdModal'));
    modal.show();
    
    // Reset content
    document.getElementById('viewSptpdContent').innerHTML = `
        <div class="text-center">
            <i class="fas fa-spinner fa-spin fa-2x"></i>
            <p class="mt-2">Memuat data...</p>
        </div>
    `;
    
    // Store ID for print function
    window.currentSptpdId = id;
    
    fetch(`/wp/sptpd/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const sptpd = data.data;
                document.getElementById('viewSptpdContent').innerHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">Informasi SPTPD</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Nomor SPTPD:</strong></td>
                                            <td>${sptpd.nomor_sptpd || 'SPTPD-' + String(sptpd.id).padStart(6, '0')}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td><span class="badge bg-${getStatusColor(sptpd.status)}">${sptpd.status}</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal Dibuat:</strong></td>
                                            <td>${formatDate(sptpd.created_at)}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jatuh Tempo:</strong></td>
                                            <td>${formatDate(sptpd.jatuh_tempo)}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0">Data Wajib Pajak</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Nama:</strong></td>
                                            <td>${sptpd.subjek_pajak ? sptpd.subjek_pajak.subjek_pajak : '-'}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>NPWPD:</strong></td>
                                            <td>${sptpd.subjek_pajak ? sptpd.subjek_pajak.npwpd : '-'}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Alamat:</strong></td>
                                            <td>${sptpd.subjek_pajak ? sptpd.subjek_pajak.alamat : '-'}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Pajak:</strong></td>
                                            <td>${sptpd.objek_pajak ? sptpd.objek_pajak.jenis_pajak : 'Pajak Umum'}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0">Perhitungan Pajak</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Masa Pajak:</strong></td>
                                                    <td>${formatMonth(sptpd.masa_pajak_awal)} - ${formatMonth(sptpd.masa_pajak_akhir)}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Dasar Pengenaan:</strong></td>
                                                    <td>Rp ${formatNumber(sptpd.dasar || 0)}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tarif Pajak:</strong></td>
                                                    <td>${sptpd.tarif || 0}%</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Pajak Terutang:</strong></td>
                                                    <td class="text-success"><strong>Rp ${formatNumber(sptpd.pajak_terutang || 0)}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Denda:</strong></td>
                                                    <td>Rp ${formatNumber(sptpd.denda || 0)}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Total Bayar:</strong></td>
                                                    <td class="text-danger"><strong>Rp ${formatNumber((sptpd.pajak_terutang || 0) + (sptpd.denda || 0))}</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                document.getElementById('viewSptpdContent').innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Error: ${data.message || 'Gagal memuat data SPTPD'}
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('viewSptpdContent').innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Terjadi kesalahan saat mengambil detail SPTPD
                </div>
            `;
        });
}

function printDetailPdf() {
    if (window.currentSptpdId) {
        window.open(`/wp/sptpd/${window.currentSptpdId}/pdf`, '_blank');
    }
}

// Helper functions
function getStatusColor(status) {
    switch(status) {
        case 'Lunas': return 'success';
        case 'Terkirim': return 'info';
        case 'Terlambat': return 'danger';
        default: return 'secondary';
    }
}

function formatDate(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'long',
        year: 'numeric'
    });
}

function formatMonth(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        month: 'long',
        year: 'numeric'
    });
}

function formatDateForInput(dateString) {
    if (!dateString) return '';
    const date = new Date(dateString);
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    return `${year}-${month}`;
}

function formatNumber(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}

function printPdf(id) {
    window.open(`/wp/sptpd/${id}/pdf`, '_blank');
}

function bayarSptpd(id) {
    fetch(`/wp/sptpd/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const sptpd = data.data;
                
                // Check if can pay
                if (sptpd.status === 'Lunas') {
                    alert('SPTPD sudah lunas!');
                    return;
                }
                
                // Fill payment modal
                document.getElementById('bayarSptpdId').value = sptpd.id;
                document.getElementById('bayarNomorSptpd').textContent = sptpd.nomor_sptpd || 'SPTPD-' + String(sptpd.id).padStart(6, '0');
                document.getElementById('bayarPeriode').textContent = formatMonth(sptpd.masa_pajak_awal) + ' - ' + formatMonth(sptpd.masa_pajak_akhir);
                document.getElementById('bayarPajakTerutang').textContent = 'Rp ' + formatNumber(sptpd.pajak_terutang || 0);
                
                // Calculate total
                const total = (sptpd.pajak_terutang || 0) + (sptpd.denda || 0) + (sptpd.bunga || 0) + (sptpd.kenaikan || 0) - (sptpd.kompensasi || 0) - (sptpd.setoran || 0);
                document.getElementById('bayarTotalBayar').textContent = 'Rp ' + formatNumber(total);
                
                // Show modal
                const modal = new bootstrap.Modal(document.getElementById('bayarSptpdModal'));
                modal.show();
            } else {
                alert('Error: ' + (data.message || 'Gagal memuat data SPTPD'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengambil data SPTPD');
        });
}

function konfirmasiBayar() {
    const form = document.getElementById('bayarSptpdForm');
    const formData = new FormData(form);
    const id = document.getElementById('bayarSptpdId').value;
    
    // Show loading
    const submitBtn = event.target;
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
    submitBtn.disabled = true;
    
    fetch(`/wp/sptpd/${id}/bayar`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Pembayaran berhasil dikonfirmasi! Status SPTPD diubah menjadi Lunas.');
            bootstrap.Modal.getInstance(document.getElementById('bayarSptpdModal')).hide();
            location.reload(); // Refresh halaman
        } else {
            alert('Error: ' + (data.message || 'Terjadi kesalahan'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses pembayaran');
    })
    .finally(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
}

function buktiBayar(id) {
    window.open(`/wp/sptpd/${id}/bukti-bayar`, '_blank');
}
</script>

<style>
/* Import Admin Dashboard Styles */
:root {
    --primary-color: #4f46e5;
    --primary-dark: #4338ca;
    --success-color: #059669;
    --warning-color: #d97706;
    --danger-color: #dc2626;
    --info-color: #0ea5e9;
    --dark-color: #1f2937;
    --light-color: #f9fafb;
    --border-color: #e5e7eb;
    --text-muted: #6b7280;
    --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

/* Modern Header */
.modern-header {
    background: linear-gradient(135deg, #00712D 0%, #4CAF50 100%);
    border-radius: 15px;
    margin-top: 2em;
    color: white;
    box-shadow: var(--shadow-lg);
    margin-bottom: 2rem;
}

.header-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
    color: white;
}

.header-subtitle {
    font-size: 0.9rem;
    opacity: 0.9;
    margin: 0;
    color: white;
}

.sidebar-toggle-btn {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    padding: 10px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.sidebar-toggle-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    color: white;
}

.user-profile-modern .profile-container {
    display: flex;
    align-items: center;
    padding: 8px 16px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.user-profile-modern .profile-container:hover {
    background: rgba(255, 255, 255, 0.2);
}

.profile-avatar {
    width: 35px;
    height: 35px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
}

.profile-name {
    font-weight: 600;
    color: white;
}

.profile-role {
    color: rgba(255, 255, 255, 0.8);
}

.modern-dropdown {
    border: none;
    box-shadow: var(--shadow-lg);
    border-radius: 10px;
}

/* Modern Controls */
.modern-controls-container {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: var(--shadow);
    border: 1px solid var(--border-color);
}

.controls-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    align-items: end;
}

.control-group {
    display: flex;
    flex-direction: column;
}

.modern-label {
    font-weight: 600;
    color: var(--dark-color);
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.search-input-container {
    position: relative;
}

.modern-search {
    width: 100%;
    padding: 12px 40px 12px 16px;
    border: 2px solid var(--border-color);
    border-radius: 10px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background: white;
}

.modern-search:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.search-icon {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
}

.modern-select {
    padding: 12px 16px;
    border: 2px solid var(--border-color);
    border-radius: 10px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background: white;
}

.modern-select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.modern-action-btn {
    padding: 12px 24px;
    border-radius: 10px;
    font-weight: 600;
    border: none;
    transition: all 0.3s ease;
    box-shadow: var(--shadow);
}

.modern-action-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

/* Modern Statistics */
.modern-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.stat-card-modern {
    background: white;
    padding: 30px;
    border-radius: 15px;
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
    border: 1px solid var(--border-color);
}

.stat-card-modern:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.stat-card-modern.primary-gradient {
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    color: white;
}

.stat-card-modern.warning-gradient {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
}

.stat-card-modern.success-gradient {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.stat-card-modern.info-gradient {
    background: linear-gradient(135deg, #06b6d4 0%, #0ea5e9 100%);
    color: white;
}

.stat-icon-modern {
    font-size: 2.5rem;
    margin-bottom: 15px;
    opacity: 0.9;
}

.stat-number-modern {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    line-height: 1;
}

.stat-label-modern {
    font-size: 0.9rem;
    margin: 5px 0 0 0;
    opacity: 0.9;
    font-weight: 500;
}

.stat-bg-icon {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 4rem;
    opacity: 0.1;
}

/* Modern Dashboard Card */
.dashboard-grid {
    display: grid;
    gap: 25px;
}

.main-card {
    background: white;
    border-radius: 15px;
    box-shadow: var(--shadow);
    border: 1px solid var(--border-color);
    overflow: hidden;
}

.card-header-modern {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 25px 30px;
    background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
    border-bottom: 1px solid var(--border-color);
}

.card-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0;
    color: var(--dark-color);
}

.card-subtitle {
    font-size: 0.9rem;
    color: var(--text-muted);
    margin: 5px 0 0 0;
}

.view-toggle-modern {
    display: flex;
    gap: 5px;
}

.toggle-btn {
    width: 40px;
    height: 40px;
    border: 2px solid var(--border-color);
    background: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: var(--text-muted);
}

.toggle-btn:hover {
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.toggle-btn.active {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

/* Modern Table */
.modern-table-container {
    background: white;
}

.table-wrapper {
    overflow-x: auto;
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.modern-table thead th {
    background: #f9fafb;
    border-bottom: 1px solid var(--border-color);
    padding: 20px 15px;
    font-weight: 600;
    color: var(--dark-color);
    font-size: 0.9rem;
    white-space: nowrap;
}

.th-content {
    display: flex;
    align-items: center;
    gap: 8px;
}

.table-row-modern {
    transition: all 0.3s ease;
    border-bottom: 1px solid var(--border-color);
}

.table-row-modern:hover {
    background: #f9fafb;
}

.modern-table td {
    padding: 20px 15px;
    vertical-align: middle;
    border-bottom: 1px solid var(--border-color);
}

.cell-content {
    font-size: 0.9rem;
    color: var(--dark-color);
}

.amount {
    font-weight: 600;
    color: var(--success-color);
}

/* Status Badges */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-lunas {
    background: #d1fae5;
    color: #065f46;
}

.status-terkirim {
    background: #dbeafe;
    color: #1e40af;
}

.status-draft {
    background: #fef3c7;
    color: #92400e;
}

.status-terlambat {
    background: #fee2e2;
    color: #991b1b;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
}

.action-btn {
    width: 35px;
    height: 35px;
    border: none;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    color: white;
}

.action-btn.primary {
    background: var(--primary-color);
}

.action-btn.success {
    background: var(--success-color);
}

.action-btn.secondary {
    background: #6c757d;
}

.action-btn.info {
    background: var(--info-color);
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Empty State */
.empty-state-modern {
    text-align: center;
    padding: 60px 40px;
    color: var(--text-muted);
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.5;
}

.empty-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: var(--dark-color);
}

.empty-subtitle {
    font-size: 1rem;
    margin-bottom: 30px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-header {
        flex-direction: column;
        text-align: center;
        gap: 20px;
    }
    
    .controls-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .modern-stats-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .card-header-modern {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .view-toggle-modern {
        align-self: flex-end;
    }
}

@media (max-width: 576px) {
    .modern-header {
        padding: 20px;
        margin-bottom: 1rem;
    }
    
    .modern-controls-container {
        padding: 20px;
    }
    
    .stat-card-modern {
        padding: 20px;
    }
    
    .card-header-modern {
        padding: 20px;
    }
    
    .modern-table td,
    .modern-table th {
        padding: 15px 10px;
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project\simpad\resources\views/wp/sptpd.blade.php ENDPATH**/ ?>