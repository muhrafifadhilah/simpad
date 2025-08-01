@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* CSS Variables */
    :root {
        --primary-green: #00712D;
        --accent-green: #005a24;
        --secondary-green: #D5ED9F;
        --neutral-100: #f5f5f5;
        --neutral-200: #e5e5e5;
        --neutral-300: #d4d4d4;
        --neutral-700: #404040;
        --neutral-800: #262626;
        --radius-sm: 4px;
        --radius-md: 8px;
        --radius-lg: 12px;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        --transition: all 0.2s ease-in-out;
    }

    /* Modern Page Styling */
    .main-content-wrapper {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        overflow-x: hidden;
        padding: 20px;
        min-height: 100vh;
        background-color: #f8fafc;
    }
    
    .container-fluid {
        padding: 0 20px;
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        box-sizing: border-box;
    }
    
    /* Modern Header */
    .modern-header {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        background: linear-gradient(135deg, var(--secondary-green) 0%, #E8F5E8 100%);
        border-radius: var(--radius-lg);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        padding: 30px;
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
        font-size: 2rem;
        font-weight: 800;
        margin: 0;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    
    .header-subtitle {
        color: var(--neutral-700);
        font-size: 1rem;
        margin: 8px 0 0 0;
        font-weight: 500;
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
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border: 1px solid var(--neutral-300);
        padding: 20px;
        margin-bottom: 25px;
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .btn-modern {
        padding: 12px 20px;
        border: none;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 120px;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .btn-add {
        background: #22b8cf;
        color: white;
    }
    
    .btn-add:hover {
        background: #1a94a8;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        color: white;
        text-decoration: none;
    }
    
    .btn-edit {
        background: #fab005;
        color: white;
    }
    
    .btn-edit:hover {
        background: #d19903;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .btn-delete {
        background: #fa5252;
        color: white;
    }
    
    .btn-delete:hover {
        background: #e03131;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .btn-export {
        background: var(--neutral-700);
        color: white;
    }
    
    .btn-export:hover {
        background: var(--neutral-800);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    /* Modern Table */
    .modern-table-container {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border: 1px solid var(--neutral-300);
        overflow: hidden;
        margin-bottom: 30px;
    }
    
    .table-wrapper {
        overflow-x: auto;
        border-radius: var(--radius-lg);
    }
    
    .modern-table {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
        font-size: 0.875rem;
        min-width: 1200px;
    }
    
    .modern-table thead {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
    }
    
    .modern-table thead th {
        color: white;
        font-weight: 700;
        padding: 18px 15px;
        text-align: left;
        border: none;
        font-size: 0.9rem;
        white-space: nowrap;
        text-shadow: 0 1px 2px rgba(0,0,0,0.2);
    }

    .modern-table thead th i {
        margin-right: 8px;
        opacity: 0.9;
    }
    
    .modern-table tbody tr {
        border-bottom: 1px solid var(--neutral-200);
        transition: var(--transition);
        cursor: pointer;
    }
    
    .modern-table tbody tr:hover {
        background: var(--neutral-100);
        transform: translateX(2px);
    }
    
    .modern-table tbody tr.selected {
        background: rgba(0, 113, 45, 0.1) !important;
        border-left: 4px solid var(--primary-green);
        box-shadow: inset 0 0 0 1px rgba(0, 113, 45, 0.2);
    }
    
    .modern-table tbody td {
        padding: 15px;
        border: none;
        color: var(--neutral-700);
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .sidebar-toggle-btn {
            display: block;
        }
        
        .main-content-wrapper {
            padding: 15px;
        }
        
        .container-fluid {
            padding: 0 15px;
        }
        
        .modern-header {
            padding: 20px;
        }
        
        .header-title {
            font-size: 1.5rem;
        }
        
        .action-buttons {
            justify-content: center;
            flex-wrap: wrap;
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
            padding: 10px 8px;
        }
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
        
        <!-- Modern Controls -->
        <div class="modern-controls-container">
            <div class="action-buttons">
                <a href="{{ route('sptpd.create') }}" class="btn-modern btn-add">
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
                        {{-- Data will be loaded via AJAX --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
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
            url: '{{ route('sptpd.index') }}',
            type: 'GET'
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

    $('#editSptpdBtn').click(function() {
        if (!selectedRowId) {
            Swal.fire('Pilih baris yang akan diedit!', '', 'warning');
            return;
        }
        window.location.href = "{{ url('sptpd') }}/" + selectedRowId + "/edit";
    });

    $('#deleteSptpdBtn').click(function() {
        if (!selectedRowId) {
            Swal.fire('Pilih baris yang akan dihapus!', '', 'warning');
            return;
        }
        
        Swal.fire({
            title: 'Yakin ingin menghapus SPTPD ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('sptpd') }}/" + selectedRowId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function() {
                        Swal.fire('Berhasil!', 'Data SPTPD dihapus.', 'success');
                        table.ajax.reload();
                        selectedRowId = null;
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    });

    $('#exportPdfBtn').click(function() {
        Swal.fire({
            title: 'Export SPTPD',
            text: 'Apakah Anda yakin ingin export data SPTPD?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Export!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.open("{{ route('sptpd.export-pdf') }}", '_blank');
            }
        });
    });
});
</script>
@endsection