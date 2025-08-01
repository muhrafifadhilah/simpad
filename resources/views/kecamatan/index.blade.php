@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Modern Page Styling */
    .main-content-wrapper {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        overflow-x: hidden;
        padding: 20px;
        min-height: 100vh;
    }
    
    .container-fluid {
        padding: 0 20px;
        width: 100%;
        max-width: 1200px;
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
        box-shadow: var(--shadow-sm);
        margin-bottom: 24px;
    }
    
    .header-title {
        color: var(--primary-green);
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
    }
    
    .header-subtitle {
        color: var(--neutral-700);
        font-size: 0.95rem;
        margin: 4px 0 0 0;
    }
    
    /* Sidebar toggle button */
    .sidebar-toggle-btn {
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
        margin-bottom: 24px;
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
    }
    
    .btn-add {
        background: #22b8cf;
        color: white;
    }
    
    .btn-add:hover {
        background: #1a94a8;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    
    .btn-edit {
        background: #fab005;
        color: white;
    }
    
    .btn-edit:hover {
        background: #d19903;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    
    .btn-delete {
        background: #fa5252;
        color: white;
    }
    
    .btn-delete:hover {
        background: #e03131;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    
    /* Modern Table */
    .modern-table-container {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--neutral-300);
        overflow: hidden;
        max-width: 900px;
        margin: 0 auto;
    }
    
    .modern-table {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
        font-size: 0.9rem;
    }
    
    .modern-table thead {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
    }
    
    .modern-table thead th {
        color: white;
        font-weight: 600;
        padding: 16px 12px;
        text-align: left;
        border: none;
        font-size: 0.9rem;
    }
    
    .modern-table tbody tr {
        border-bottom: 1px solid var(--neutral-200);
        transition: var(--transition);
        cursor: pointer;
    }
    
    .modern-table tbody tr:hover {
        background: var(--neutral-100);
    }
    
    .modern-table tbody tr.selected {
        background: rgba(0, 113, 45, 0.1);
        border-left: 4px solid var(--primary-green);
    }
    
    .modern-table tbody td {
        padding: 14px 12px;
        border: none;
        color: var(--neutral-700);
        vertical-align: middle;
    }
    
    /* Status Badge */
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-active {
        background: rgba(40, 167, 69, 0.2);
        color: #28a745;
    }
    
    .status-inactive {
        background: rgba(220, 53, 69, 0.2);
        color: #dc3545;
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
    }
    
    .modal-title {
        font-weight: 700;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--neutral-700);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .form-control {
        border: 2px solid var(--neutral-300);
        border-radius: var(--radius-md);
        padding: 12px 16px;
        transition: var(--transition);
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(0, 113, 45, 0.1);
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 16px;
            padding-right: 16px;
        }
        
        .modern-header {
            flex-direction: column;
            gap: 16px;
            text-align: center;
        }
        
        .action-buttons {
            justify-content: center;
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
                        <h2 class="header-title">Data Kecamatan</h2>
                        <p class="header-subtitle">Manajemen Wilayah Kecamatan</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modern Controls -->
        <div class="modern-controls-container">
            <div class="action-buttons">
                <button class="btn-modern btn-add" id="addKecBtn">
                    <i class="fas fa-plus"></i>Tambah
                </button>
                <button class="btn-modern btn-edit" id="editKecBtn">
                    <i class="fas fa-edit"></i>Edit
                </button>
                <button class="btn-modern btn-delete" id="deleteKecBtn">
                    <i class="fas fa-trash"></i>Hapus
                </button>
            </div>
        </div>
        
        <!-- Modern Table -->
        <div class="modern-table-container">
            <table class="modern-table" id="kecamatanTable">
                <thead>
                    <tr>
                        <th><i class="fas fa-barcode me-2"></i>Kode</th>
                        <th><i class="fas fa-map-marked-alt me-2"></i>Kecamatan</th>
                        <th><i class="fas fa-calendar me-2"></i>TMT</th>
                        <th><i class="fas fa-check-circle me-2"></i>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modern Modal -->
<div class="modal fade" id="kecModal" tabindex="-1" aria-labelledby="kecModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="kecForm">
            @csrf
            <input type="hidden" name="id" id="kec_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kecModalLabel">
                        <i class="fas fa-map-marked-alt me-2"></i>Tambah/Edit Kecamatan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-barcode"></i>Kode
                        </label>
                        <input type="text" name="kode" id="kode" class="form-control" maxlength="4" required placeholder="Masukkan kode kecamatan">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-map-marked-alt"></i>Nama Kecamatan
                        </label>
                        <input type="text" name="nama" id="nama" class="form-control" required placeholder="Masukkan nama kecamatan">
                <div class="mb-2">
                    <label>TMT</label>
                    <input type="date" name="tmt" id="tmt" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Aktif</label>
                    <select name="aktif" id="aktif" class="form-select" required>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    #kecamatanTable th, #kecamatanTable td {
        vertical-align: middle;
        text-align: center;
        user-select: text !important;
    }
    #kecamatanTable tbody tr:nth-child(even) {
        background-color: #e8eaff !important;
    }
    #kecamatanTable tbody tr.selected,
    #kecamatanTable tbody tr.selected td {
        background-color: #1976d2 !important;
        color: #fff !important;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    let selectedRowId = null;
    let table = $('#kecamatanTable').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        info: false,
        ajax: '{{ route('kecamatan.index') }}',
        columns: [
            { data: 'kode', name: 'kode' },
            { data: 'nama', name: 'nama' },
            { 
                data: 'tmt', 
                name: 'tmt',
                render: function(data) {
                    if (!data) return '';
                    let d = new Date(data);
                    let day = String(d.getDate()).padStart(2, '0');
                    let month = String(d.getMonth()+1).padStart(2, '0');
                    let year = d.getFullYear();
                    return `${day}-${month}-${year}`;
                }
            },
            { 
                data: 'status', 
                name: 'status',
                render: function(data) {
                    return data == 1 ? '<span style="font-size:18px;color:#222;">&#10003;</span>' : '';
                }
            }
        ]
    });

    $('#kecamatanTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedRowId = null;
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedRowId = table.row(this).data().id;
        }
    });

    $('#addKecBtn').click(function() {
        $('#kecForm')[0].reset();
        $('#kec_id').val('');
        $('#kecModalLabel').text('Tambah Kecamatan');
        $('#aktif').val('1');
        $('#tmt').val(new Date().toISOString().slice(0,10));
        $('#kecModal').modal('show');
    });

    $('#editKecBtn').click(function() {
        if (!selectedRowId) {
            Swal.fire('Pilih baris yang akan diedit!', '', 'warning');
            return;
        }
        let rowData = table.row('.selected').data();
        if (!rowData) {
            Swal.fire('Data tidak ditemukan atau sudah dihapus.', '', 'error');
            table.ajax.reload();
            selectedRowId = null;
            return;
        }
        $('#kec_id').val(rowData.id);
        $('#kode').val(rowData.kode);
        $('#nama').val(rowData.nama);
        $('#tmt').val(rowData.tmt);
        $('#aktif').val(rowData.aktif);
        $('#kecModalLabel').text('Edit Kecamatan');
        $('#kecModal').modal('show');
    });

    $('#deleteKecBtn').click(function() {
        if (!selectedRowId) {
            Swal.fire('Pilih baris yang akan dihapus!', '', 'warning');
            return;
        }
        let rowData = table.row('.selected').data();
        if (!rowData) {
            Swal.fire('Data tidak ditemukan atau sudah dihapus.', '', 'error');
            table.ajax.reload();
            selectedRowId = null;
            return;
        }
        Swal.fire({
            title: 'Yakin ingin menghapus kecamatan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('kecamatan') }}/" + selectedRowId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function() {
                        table.ajax.reload();
                        selectedRowId = null;
                        Swal.fire('Berhasil!', 'Data kecamatan dihapus.', 'success');
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    });

    $('#kecForm').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        let id = $('#kec_id').val();
        let url, type;
        if (id) {
            url = "{{ url('kecamatan') }}/" + id;
            type = 'PUT';
        } else {
            url = "{{ route('kecamatan.store') }}";
            type = 'POST';
        }
        $.ajax({
            url: url,
            type: type,
            data: $.param(formData),
            success: function() {
                $('#kecModal').modal('hide');
                table.ajax.reload();
                selectedRowId = null;
                Swal.fire('Berhasil!', 'Data kecamatan disimpan.', 'success');
            },
            error: function(xhr) {
                let msg = 'Gagal menyimpan data';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                Swal.fire('Gagal!', msg, 'error');
            }
        });
    });
    
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');
        });
    }
});
</script>
@endsection
