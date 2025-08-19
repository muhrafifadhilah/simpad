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

    .btn-detail {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border: 1px solid transparent;
        padding: 8px 16px;
        font-size: 0.85rem;
        min-width: auto;
    }
    
    .btn-detail:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
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
        min-width: 1000px;
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
    
    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }
    
    .status-active {
        background: rgba(34, 197, 94, 0.15);
        color: #16a34a;
    }
    
    .status-inactive {
        background: rgba(239, 68, 68, 0.15);
        color: #dc2626;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: var(--radius-lg);
        border: none;
        box-shadow: var(--shadow-lg);
    }
    
    .modal-header {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
        color: white;
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        border-bottom: none;
        padding: 20px 24px;
    }
    
    .modal-title {
        font-weight: 700;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .modal-body {
        padding: 24px;
    }
    
    .modal-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--neutral-300);
        background: var(--neutral-100);
        border-radius: 0 0 var(--radius-lg) var(--radius-lg);
    }
    
    .form-label {
        font-weight: 600;
        color: var(--neutral-700);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }
    
    .form-control, .form-select {
        border: 2px solid var(--neutral-300);
        border-radius: var(--radius-md);
        padding: 12px 16px;
        transition: var(--transition);
        font-size: 0.95rem;
        background: white;
    }
    
    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(0, 113, 45, 0.1);
        background: white;
    }

    /* List Styling for Modal */
    .list-group-item {
        border: 1px solid var(--neutral-300);
        padding: 12px 16px;
        background: white;
        color: var(--neutral-700);
    }

    .list-group-item:first-child {
        border-top-left-radius: var(--radius-md);
        border-top-right-radius: var(--radius-md);
    }

    .list-group-item:last-child {
        border-bottom-left-radius: var(--radius-md);
        border-bottom-right-radius: var(--radius-md);
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
                        <h2 class="header-title">Unit Pelayanan Teknis</h2>
                        <p class="header-subtitle">Manajemen Data UPT dan Kecamatan</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modern Controls -->
        <div class="modern-controls-container">
            <div class="action-buttons">
                <button class="btn-modern btn-add" id="addUptBtn">
                    <i class="fas fa-plus"></i>Tambah UPT
                </button>
                <button class="btn-modern btn-edit" id="editUptBtn">
                    <i class="fas fa-edit"></i>Edit UPT
                </button>
                <button class="btn-modern btn-delete" id="deleteUptBtn">
                    <i class="fas fa-trash"></i>Hapus UPT
                </button>
            </div>
        </div>
        
        <!-- Modern Table -->
        <div class="modern-table-container">
            <div class="table-wrapper">
                <table class="modern-table" id="uptTable">
                    <thead>
                        <tr>
                            <th><i class="fas fa-list-ol me-2"></i>No</th>
                            <th><i class="fas fa-building me-2"></i>Nama UPT</th>
                            <th><i class="fas fa-user-tie me-2"></i>Kepala UPT</th>
                            <th><i class="fas fa-map-marker-alt me-2"></i>Alamat</th>
                            <th><i class="fas fa-check-circle me-2"></i>Status</th>
                            <th><i class="fas fa-cogs me-2"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modern Modal untuk UPT -->
<div class="modal fade" id="uptModal" tabindex="-1" aria-labelledby="uptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="uptForm">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" id="upt_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uptModalLabel">
                        <i class="fas fa-building"></i>Tambah/Edit UPT
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-building"></i>Nama UPT
                                </label>
                                <input type="text" name="nama_upt" id="nama_upt" class="form-control" required placeholder="Masukkan nama UPT">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-user-tie"></i>Kepala UPT
                                </label>
                                <input type="text" name="kepala_upt" id="kepala_upt" class="form-control" required placeholder="Masukkan nama kepala UPT">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-map-marker-alt"></i>Alamat
                                </label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="4" required placeholder="Masukkan alamat UPT"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">
                                <i class="fas fa-map-signs"></i>Kecamatan yang Dikelola
                            </label>
                            <div class="row" id="kecamatanCheckboxes">
                                <div class="col-12">
                                    <p class="text-muted">Memuat data kecamatan...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail Kecamatan -->
<div class="modal fade" id="modalDetailKecamatan" tabindex="-1" aria-labelledby="modalDetailKecamatanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailKecamatanLabel">
                    <i class="fas fa-map me-2"></i>Daftar Kecamatan UPT
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul id="listKecamatanUPT" class="list-group list-group-flush">
                    <li class="list-group-item">Memuat data...</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    let selectedRowId = null;
    let table = $('#uptTable').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        info: true,
        lengthChange: true,
        pageLength: 25,
        ajax: '<?php echo e(route('upt.index')); ?>',
        columns: [
            { 
                data: null, 
                name: 'no',
                orderable: false,
                searchable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'nama', name: 'nama' },
            { data: 'kepala_upt', name: 'kepala_upt' },
            { data: 'alamat', name: 'alamat' },
            { 
                data: 'status', 
                name: 'status',
                render: function(data) {
                    if (data == 1) {
                        return '<span class="status-badge status-active"><i class="fas fa-check me-1"></i>Aktif</span>';
                    } else {
                        return '<span class="status-badge status-inactive"><i class="fas fa-times me-1"></i>Non-Aktif</span>';
                    }
                }
            },
            { 
                data: 'id',
                name: 'actions',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <button class="btn-modern btn-detail" onclick="showDetailKecamatan(${data})">
                            <i class="fas fa-eye"></i> Detail
                        </button>
                    `;
                }
            }
        ],
        language: {
            processing: "Sedang memproses...",
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            },
            emptyTable: "Tidak ada data yang tersedia dalam tabel",
            zeroRecords: "Tidak ditemukan data yang sesuai"
        }
    });

    // Row selection functionality
    $('#uptTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedRowId = null;
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedRowId = table.row(this).data().id;
        }
    });

    // Function to load kecamatan checkboxes
    function loadKecamatanCheckboxes() {
        $.get("<?php echo e(url('api/kecamatan')); ?>", function(data) {
            let html = '';
            if (data && data.length > 0) {
                data.forEach(function(kecamatan) {
                    html += `
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="kecamatan_ids[]" value="${kecamatan.id}" id="kec_${kecamatan.id}">
                                <label class="form-check-label" for="kec_${kecamatan.id}">
                                    ${kecamatan.nama}
                                </label>
                            </div>
                        </div>
                    `;
                });
            } else {
                html = '<div class="col-12"><p class="text-muted">Tidak ada data kecamatan</p></div>';
            }
            $('#kecamatanCheckboxes').html(html);
        }).fail(function() {
            $('#kecamatanCheckboxes').html('<div class="col-12"><p class="text-danger">Gagal memuat data kecamatan</p></div>');
        });
    }

    // Add button functionality
    $('#addUptBtn').click(function() {
        $('#uptForm')[0].reset();
        $('#upt_id').val('');
        loadKecamatanCheckboxes();
        $('#uptModalLabel').html('<i class="fas fa-building"></i>Tambah UPT');
        $('#uptModal').modal('show');
    });

    // Edit button functionality
    $('#editUptBtn').click(function() {
        if (!selectedRowId) {
            Swal.fire({
                title: 'Peringatan!',
                text: 'Pilih baris yang akan diedit!',
                icon: 'warning',
                confirmButtonColor: '#00712D'
            });
            return;
        }
        
        loadKecamatanCheckboxes();
        
        $.get("<?php echo e(url('upt')); ?>/" + selectedRowId, function(data) {
            $('#upt_id').val(data.id);
            $('#nama_upt').val(data.nama_upt);
            $('#kepala_upt').val(data.kepala_upt);
            $('#alamat').val(data.alamat);
            
            // Reset and check the selected kecamatans after loading
            setTimeout(function() {
                $('input[name="kecamatan_ids[]"]').prop('checked', false);
                if (data.kecamatans) {
                    data.kecamatans.forEach(function(kec) {
                        $('#kec_' + kec.id).prop('checked', true);
                    });
                }
            }, 500); // Wait for checkboxes to load
            
            $('#uptModalLabel').html('<i class="fas fa-building"></i>Edit UPT');
            $('#uptModal').modal('show');
        }).fail(function() {
            Swal.fire({
                title: 'Error!',
                text: 'Gagal mengambil data UPT.',
                icon: 'error',
                confirmButtonColor: '#00712D'
            });
        });
    });

    // Delete button functionality
    $('#deleteUptBtn').click(function() {
        if (!selectedRowId) {
            Swal.fire({
                title: 'Peringatan!',
                text: 'Pilih baris yang akan dihapus!',
                icon: 'warning',
                confirmButtonColor: '#00712D'
            });
            return;
        }
        
        let rowData = table.row('.selected').data();
        if (!rowData) {
            Swal.fire({
                title: 'Error!',
                text: 'Data tidak ditemukan atau sudah dihapus.',
                icon: 'error',
                confirmButtonColor: '#00712D'
            });
            table.ajax.reload();
            selectedRowId = null;
            return;
        }
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Yakin ingin menghapus UPT "' + rowData.nama_upt + '"?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo e(url('upt')); ?>/" + selectedRowId,
                    type: 'DELETE',
                    data: { _token: '<?php echo e(csrf_token()); ?>' },
                    success: function() {
                        table.ajax.reload();
                        selectedRowId = null;
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data UPT berhasil dihapus.',
                            icon: 'success',
                            confirmButtonColor: '#00712D'
                        });
                    },
                    error: function(xhr) {
                        let msg = 'Gagal menghapus data.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            title: 'Gagal!',
                            text: msg,
                            icon: 'error',
                            confirmButtonColor: '#00712D'
                        });
                    }
                });
            }
        });
    });

    // Form submission
    $('#uptForm').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        let id = $('#upt_id').val();
        let url, type;
        
        if (id) {
            url = "<?php echo e(url('upt')); ?>/" + id;
            type = 'PUT';
        } else {
            url = "<?php echo e(route('upt.store')); ?>";
            type = 'POST';
        }
        
        // Show loading
        Swal.fire({
            title: 'Menyimpan...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        $.ajax({
            url: url,
            type: type,
            data: $.param(formData),
            success: function() {
                $('#uptModal').modal('hide');
                table.ajax.reload();
                selectedRowId = null;
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data UPT berhasil disimpan.',
                    icon: 'success',
                    confirmButtonColor: '#00712D'
                });
            },
            error: function(xhr) {
                let msg = 'Gagal menyimpan data';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    msg = Object.values(errors).flat().join('<br>');
                }
                Swal.fire({
                    title: 'Gagal!',
                    html: msg,
                    icon: 'error',
                    confirmButtonColor: '#00712D'
                });
            }
        });
    });

    // Detail kecamatan function
    window.showDetailKecamatan = function(id) {
        $('#listKecamatanUPT').html('<li class="list-group-item"><i class="fas fa-spinner fa-spin me-2"></i>Memuat data...</li>');
        $('#modalDetailKecamatan').modal('show');
        
        $.get('<?php echo e(url("upt")); ?>/' + id + '/kecamatan', function(data) {
            let html = '';
            if (data.length === 0) {
                html = '<li class="list-group-item text-muted"><i class="fas fa-info-circle me-2"></i>Tidak ada kecamatan terdaftar</li>';
            } else {
                data.forEach(function(kec, index) {
                    html += `<li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-map-pin me-3 text-success"></i>
                                <span class="fw-semibold">${kec.nama}</span>
                            </li>`;
                });
            }
            $('#listKecamatanUPT').html(html);
        }).fail(function() {
            $('#listKecamatanUPT').html('<li class="list-group-item text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Gagal memuat data</li>');
        });
    };
    
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');
        });
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpad new\simpad\resources\views/upt/index.blade.php ENDPATH**/ ?>