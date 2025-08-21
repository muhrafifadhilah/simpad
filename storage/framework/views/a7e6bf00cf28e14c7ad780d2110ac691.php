<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* CSS Variables */
    :root {
        --primary-green: #00712D;
        --primary-orange: #FF6600;
        --secondary-green: #D5ED9F;
        --accent-green: #4CAF50;
        --neutral-100: #FFFBE6;
        --neutral-200: #F8F9FA;
        --neutral-300: #E9ECEF;
        --neutral-400: #DEE2E6;
        --neutral-500: #ADB5BD;
        --neutral-600: #6C757D;
        --neutral-700: #495057;
        --neutral-800: #343A40;
        --neutral-900: #212529;
        --shadow-sm: 0 2px 4px rgba(0,0,0,0.06);
        --shadow-md: 0 4px 8px rgba(0,0,0,0.12);
        --shadow-lg: 0 8px 16px rgba(0,0,0,0.15);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Modern Page Styling */
    .main-content-wrapper {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        overflow-x: hidden;
        padding: 24px;
        min-height: 100vh;
        background-color: var(--neutral-200);
    }
    
    .container-fluid {
        padding: 0 24px;
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        box-sizing: border-box;
    }
    
    /* Search Container */
    .search-container {
        background: white;
        border-radius: var(--radius-lg);
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--neutral-300);
    }

    .search-form {
        display: flex;
        gap: 16px;
        align-items: end;
        flex-wrap: wrap;
    }

    .search-group {
        flex: 1;
        min-width: 200px;
    }

    .search-label {
        display: block;
        font-weight: 600;
        color: var(--neutral-700);
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .search-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--neutral-300);
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        transition: var(--transition);
        background-color: white;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(0, 113, 45, 0.1);
    }

    .btn-search {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: var(--radius-md);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 120px;
        justify-content: center;
    }

    .btn-search:hover {
        background: linear-gradient(135deg, var(--accent-green) 0%, var(--primary-green) 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-reset {
        background: linear-gradient(135deg, var(--neutral-500) 0%, var(--neutral-600) 100%);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: var(--radius-md);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 100px;
        justify-content: center;
    }

    .btn-reset:hover {
        background: linear-gradient(135deg, var(--neutral-600) 0%, var(--neutral-700) 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    .modern-header {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        background: linear-gradient(135deg, var(--secondary-green) 0%, #E8F5E8 100%);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        margin-bottom: 32px;
        padding: 32px;
        border: 1px solid rgba(0, 113, 45, 0.1);
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .header-left {
        display: flex;
        align-items: center;
    }
    
    .header-title {
        color: var(--primary-green);
        font-size: 2.25rem;
        font-weight: 800;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        letter-spacing: -0.025em;
    }
    
    .header-subtitle {
        color: var(--neutral-700);
        font-size: 1.1rem;
        margin: 8px 0 0 0;
        font-weight: 500;
        opacity: 0.9;
    }
    
    /* Sidebar toggle button */
    .sidebar-toggle-btn {
        display: none;
        background: var(--primary-green);
        border: none;
        color: white;
        padding: 12px 15px;
        border-radius: var(--radius-md);
        cursor: pointer;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
    }
    
    .sidebar-toggle-btn:hover {
        background: var(--accent-green);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    
    /* Modern Controls */
    .modern-controls-container {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--neutral-300);
        padding: 24px;
        margin-bottom: 28px;
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }
    
    .btn-modern {
        padding: 14px 24px;
        border: none;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 140px;
        justify-content: center;
        text-decoration: none;
        box-shadow: var(--shadow-sm);
        text-transform: none;
        letter-spacing: 0.025em;
    }
    
    .btn-add {
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        color: white;
        border: 1px solid transparent;
    }
    
    .btn-add:hover {
        background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: white;
        text-decoration: none;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, var(--primary-orange) 0%, #ea580c 100%);
        color: white;
        border: 1px solid transparent;
    }
    
    .btn-edit:hover {
        background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: white;
        text-decoration: none;
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: 1px solid transparent;
    }
    
    .btn-delete:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: white;
        text-decoration: none;
    }
    
    .btn-export {
        background: linear-gradient(135deg, var(--neutral-700) 0%, var(--neutral-800) 100%);
        color: white;
        border: 1px solid transparent;
    }
    
    .btn-export:hover {
        background: linear-gradient(135deg, var(--neutral-800) 0%, var(--neutral-900) 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: white;
        text-decoration: none;
    }
    
    /* Modern Table */
    .modern-table-container {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--neutral-300);
        overflow: hidden;
        margin-bottom: 32px;
    }
    
    .table-wrapper {
        overflow-x: auto;
        border-radius: var(--radius-lg);
    }
    
    .modern-table {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
        font-size: 0.9rem;
        min-width: 1200px;
        background: white;
    }
    
    .modern-table thead {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
        position: relative;
    }
    
    .modern-table thead::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.3) 50%, transparent 100%);
    }
    
    .modern-table thead th {
        color: white;
        font-weight: 700;
        padding: 20px 16px;
        text-align: left;
        border: none;
        font-size: 0.95rem;
        white-space: nowrap;
        text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        position: relative;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    }

    .modern-table thead th i {
        margin-right: 8px;
        opacity: 0.9;
        font-size: 0.9em;
    }
    
    .modern-table tbody tr {
        border-bottom: 1px solid var(--neutral-300);
        transition: var(--transition);
        cursor: pointer;
        background: white;
    }
    
    .modern-table tbody tr:hover {
        background: var(--neutral-100);
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    
    .modern-table tbody tr.selected {
        background: rgba(0, 113, 45, 0.08) !important;
        border-left: 4px solid var(--primary-green);
        box-shadow: inset 0 0 0 1px rgba(0, 113, 45, 0.2);
    }
    
    .modern-table tbody td {
        padding: 16px;
        border: none;
        color: var(--neutral-700);
        vertical-align: middle;
        border-bottom: 1px solid var(--neutral-300);
        font-weight: 500;
        line-height: 1.5;
    }
    
    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .sidebar-toggle-btn {
            display: block;
        }
        
        .main-content-wrapper {
            padding: 16px;
        }
        
        .container-fluid {
            padding: 0 16px;
        }
        
        .modern-header {
            padding: 24px;
            margin-bottom: 24px;
        }
        
        .header-title {
            font-size: 1.75rem;
        }
        
        .header-subtitle {
            font-size: 1rem;
        }
        
        .action-buttons {
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        
        .btn-modern {
            min-width: 120px;
            padding: 12px 20px;
            font-size: 0.9rem;
        }
        
        .modern-table {
            font-size: 0.85rem;
        }
        
        .modern-table thead th,
        .modern-table tbody td {
            padding: 12px 8px;
            font-size: 0.8rem;
        }
        
        .modern-table thead th {
            font-size: 0.75rem;
        }
    }
    
    @media (max-width: 480px) {
        .main-content-wrapper {
            padding: 12px;
        }
        
        .modern-header {
            padding: 20px;
        }
        
        .header-title {
            font-size: 1.5rem;
        }
        
        .btn-modern {
            min-width: 100px;
            padding: 10px 16px;
            font-size: 0.85rem;
        }
        
        .modern-table {
            font-size: 0.8rem;
        }
        
        .modern-table thead th,
        .modern-table tbody td {
            padding: 8px 6px;
            font-size: 0.75rem;
        }
    }
        }
    }
    
    /* Loading and Empty States */
    .loading-state {
        text-align: center;
        padding: 40px;
        color: var(--neutral-600);
    }
    
    .loading-state i {
        font-size: 2rem;
        margin-bottom: 16px;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--neutral-600);
    }
    
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 16px;
        opacity: 0.5;
    }
    
    /* DataTable Custom Styling */
    .dataTables_wrapper {
        padding: 20px;
    }
    
    .dataTables_filter input {
        border: 2px solid var(--neutral-300);
        border-radius: var(--radius-md);
        padding: 8px 12px;
        font-size: 0.9rem;
        transition: var(--transition);
    }
    
    .dataTables_filter input:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(0, 113, 45, 0.1);
    }
    
    .dataTables_length select {
        border: 2px solid var(--neutral-300);
        border-radius: var(--radius-md);
        padding: 8px 12px;
        font-size: 0.9rem;
    }
    
    .dataTables_info,
    .dataTables_paginate {
        margin-top: 16px;
        color: var(--neutral-600);
    }
    
    .page-link {
        border-radius: var(--radius-sm);
        border: 1px solid var(--neutral-300);
        color: var(--neutral-700);
        padding: 8px 12px;
        margin: 0 2px;
        transition: var(--transition);
    }
    
    .page-link:hover {
        background-color: var(--primary-green);
        border-color: var(--primary-green);
        color: white;
    }
    
    .page-item.active .page-link {
        background-color: var(--primary-green);
        border-color: var(--primary-green);
        color: white;
    }
</style>

<div class="main-content-wrapper">
    <div class="container-fluid">
        <!-- Modern Header -->
        <div class="modern-header">
            <div class="header-content">
                <div class="header-left d-flex align-items-center">
                    <button class="sidebar-toggle-btn me-4" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h2 class="header-title">Pendataan - SPTPD</h2>
                        <p class="header-subtitle">Surat Pemberitahuan Pajak Daerah</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Search Container -->
        <div class="search-container">
            <form class="search-form" id="searchForm">
                <div class="search-group">
                    <label class="search-label">Cari NOPD</label>
                    <input type="text" class="search-input" id="searchNopd" placeholder="Masukkan NOPD...">
                </div>
                <div class="search-group">
                    <label class="search-label">Subjek Pajak</label>
                    <input type="text" class="search-input" id="searchNama" placeholder="Masukkan subjek pajak...">
                </div>
                <div class="search-group">
                    <label class="search-label">Jenis Pajak</label>
                    <select class="search-input" id="searchJenis">
                        <option value="">Semua Jenis</option>
                        <option value="PBJT atas Makanan dan / atau Minuman">PBJT atas Makanan dan / atau Minuman</option>
                        <option value="PBJT Air Tanah">PBJT Air Tanah</option>
                        <option value="PBJT atas Jasa Perhotelan">PBJT atas Jasa Perhotelan</option>
                        <option value="BPHTB">BPHTB</option>
                        <option value="PBJT atas Jasa Parkir">PBJT atas Jasa Parkir</option>
                        <option value="PBJT Mineral Bukan Logam Dan Batuan">PBJT Mineral Bukan Logam Dan Batuan</option>
                        <option value="Pajak Reklame">Pajak Reklame</option>
                        <option value="PBJT atas Tenaga Listrik">PBJT atas Tenaga Listrik</option>
                        <option value="PBB">PBB</option>
                        <option value="PBJT atas Jasa Kesenian dan Hiburan">PBJT atas Jasa Kesenian dan Hiburan</option>
                    </select>
                </div>
                <div class="search-group">
                    <label class="search-label">Periode</label>
                    <input type="month" class="search-input" id="searchPeriode">
                </div>
                <div class="search-group">
                    <label class="search-label">&nbsp;</label>
                    <div style="display: flex; gap: 8px;">
                        <button type="button" class="btn-search" id="searchBtn">
                            <i class="fas fa-search"></i>Cari
                        </button>
                        <button type="button" class="btn-reset" id="resetBtn">
                            <i class="fas fa-refresh"></i>Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Modern Controls -->
        <div class="modern-controls-container">
            <div class="action-buttons">
                <a href="<?php echo e(route('sptpd.create')); ?>" class="btn-modern btn-add">
                    <i class="fas fa-plus"></i>Tambah
                </a>
                <button class="btn-modern btn-edit" id="editSptpdBtn">
                    <i class="fas fa-edit"></i>Edit
                </button>
                <button class="btn-modern btn-delete" id="deleteSptpdBtn">
                    <i class="fas fa-trash"></i>Hapus
                </button>
                <button class="btn-modern btn-export" id="exportPdfBtn">
                    <i class="fas fa-file-pdf"></i>Export PDF
                </button>
            </div>
        </div>
        
        <!-- Modern Table -->
        <div class="modern-table-container">
            <div class="table-wrapper">
                <table class="modern-table" id="sptpdTable">
                    <thead>
                        <tr>
                            <th><i class="fas fa-file-alt me-2"></i>SPTPD</th>
                            <th><i class="fas fa-calendar me-2"></i>Tanggal</th>
                            <th><i class="fas fa-file me-2"></i>Dok.</th>
                            <th><i class="fas fa-id-card me-2"></i>NOPD</th>
                            <th><i class="fas fa-user me-2"></i>Subjek Pajak</th>
                            <th><i class="fas fa-city me-2"></i>Kecamatan</th>
                            <th><i class="fas fa-building me-2"></i>Kelurahan</th>
                            <th><i class="fas fa-tags me-2"></i>Jenis Pajak</th>
                            <th><i class="fas fa-clock me-2"></i>Masa</th>
                            <th><i class="fas fa-calculator me-2"></i>Dasar</th>
                            <th><i class="fas fa-chart-line me-2"></i>Omset</th>
                            <th><i class="fas fa-money-bill me-2"></i>Pajak</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');
        });
    }
    
    let selectedRowId = null;
    let table = $('#sptpdTable').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        lengthChange: true,
        pageLength: 25,
        language: {
            emptyTable: "Data tidak ada",
            zeroRecords: "Data tidak ada",
            processing: "Memuat...",
            lengthMenu: "Tampilkan _MENU_ data",
            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "Lanjut",
                previous: "Balik"
            }
        },
        ajax: {
            url: '<?php echo e(route('sptpd.index')); ?>',
            type: 'GET',
            data: function(d) {
                d.search_nopd = $('#searchNopd').val();
                d.search_nama = $('#searchNama').val();
                d.search_jenis = $('#searchJenis').val();
                d.search_periode = $('#searchPeriode').val();
            }
        },
        columns: [
            { data: 'no_sptpd', name: 'no_sptpd' },
            { data: 'tanggal', name: 'tanggal' },
            { data: 'dok', name: 'dok' },
            { data: 'nopd', name: 'nopd' },
            { data: 'subjek_pajak', name: 'subjek_pajak' },
            { data: 'kecamatan', name: 'kecamatan' },
            { data: 'kelurahan', name: 'kelurahan' },
            { data: 'jenis_pajak', name: 'jenis_pajak' },
            { data: 'masa', name: 'masa' },
            { data: 'dasar', name: 'dasar', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ') },
            { data: 'omset_tapping_box', name: 'omset_tapping_box', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ') },
            { data: 'pajak', name: 'pajak', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ') }
        ],
        order: [[1, 'desc']]
    });

    // Row selection
    $('#sptpdTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedRowId = null;
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedRowId = table.row(this).data().id;
        }
    });

    // Search functionality
    $('#searchBtn').click(function() {
        table.ajax.reload();
    });

    $('#resetBtn').click(function() {
        $('#searchNopd').val('');
        $('#searchNama').val('');
        $('#searchJenis').val('');
        $('#searchPeriode').val('');
        table.ajax.reload();
    });

    // Enter key search
    $('.search-input').keypress(function(e) {
        if (e.which == 13) {
            table.ajax.reload();
        }
    });

    $('#editSptpdBtn').click(function() {
        if (!selectedRowId) {
            Swal.fire({
                title: 'Perhatian!',
                text: 'Silakan pilih data SPTPD yang akan diedit terlebih dahulu',
                icon: 'warning',
                confirmButtonText: 'OK',
                confirmButtonColor: '#00712D'
            });
            return;
        }
        
        // Show loading
        Swal.fire({
            title: 'Memuat...',
            text: 'Sedang membuka halaman edit',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Redirect to edit page
        setTimeout(() => {
            window.location.href = "<?php echo e(url('sptpd')); ?>/" + selectedRowId + "/edit";
        }, 500);
    });

    $('#deleteSptpdBtn').click(function() {
        if (!selectedRowId) {
            Swal.fire({
                title: 'Perhatian!',
                text: 'Silakan pilih data SPTPD yang akan dihapus terlebih dahulu',
                icon: 'warning',
                confirmButtonText: 'OK',
                confirmButtonColor: '#00712D'
            });
            return;
        }
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus data SPTPD ini? Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6c757d',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Menghapus...',
                    text: 'Sedang menghapus data SPTPD',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                $.ajax({
                    url: "<?php echo e(url('sptpd')); ?>/" + selectedRowId,
                    type: 'DELETE',
                    data: { _token: '<?php echo e(csrf_token()); ?>' },
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data SPTPD berhasil dihapus',
                            icon: 'success',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#00712D',
                            timer: 2000,
                            timerProgressBar: true
                        });
                        table.ajax.reload();
                        selectedRowId = null;
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menghapus data',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#dc2626'
                        });
                    }
                });
            }
        });
    });

    $('#exportPdfBtn').click(function() {
        Swal.fire({
            title: 'Export Data SPTPD',
            text: 'Apakah Anda yakin ingin mengekspor data SPTPD ke PDF?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Export!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#00712D',
            cancelButtonColor: '#6c757d',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Mengekspor...',
                    text: 'Sedang memproses file PDF',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Get current search parameters
                const searchParams = new URLSearchParams();
                const searchNopd = $('#searchNopd').val();
                const searchNama = $('#searchNama').val();
                const searchJenis = $('#searchJenis').val();
                const searchPeriode = $('#searchPeriode').val();
                
                if (searchNopd) searchParams.append('search_nopd', searchNopd);
                if (searchNama) searchParams.append('search_nama', searchNama);
                if (searchJenis) searchParams.append('search_jenis', searchJenis);
                if (searchPeriode) searchParams.append('search_periode', searchPeriode);
                
                // Build export URL with search parameters
                const exportUrl = "<?php echo e(route('sptpd.export-pdf')); ?>" + (searchParams.toString() ? '?' + searchParams.toString() : '');
                
                // Export process
                setTimeout(() => {
                    window.open(exportUrl, '_blank');
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'File PDF berhasil dibuat dan akan diunduh',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#00712D',
                        timer: 2000,
                        timerProgressBar: true
                    });
                }, 1000);
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\simpad\resources\views/sptpd/index.blade.php ENDPATH**/ ?>