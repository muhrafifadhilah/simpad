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
        box-shadow: var(--shadow-sm);
        margin-bottom: 30px;
        padding: 25px 30px;
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
        padding: 30px;
        margin-bottom: 30px;
    }
    
    .controls-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 24px;
    }
    
    .control-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .modern-label {
        font-weight: 600;
        color: var(--neutral-700);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .modern-input, .modern-select {
        padding: 12px 16px;
        border: 2px solid var(--neutral-300);
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        transition: var(--transition);
        background: white;
    }
    
    .modern-input:focus, .modern-select:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(0, 113, 45, 0.1);
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 16px;
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
    
    .btn-search {
        background: var(--primary-green);
        color: white;
    }
    
    .btn-search:hover {
        background: var(--accent-green);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    
    .btn-refresh {
        background: var(--neutral-600);
        color: white;
    }
    
    .btn-refresh:hover {
        background: var(--neutral-700);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
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
    
    .btn-print {
        background: var(--neutral-700);
        color: white;
    }
    
    .btn-print:hover {
        background: var(--neutral-800);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-info {
        background: #17a2b8;
        color: white;
    }
    
    .btn-info:hover {
        background: #138496;
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
        font-size: 0.95rem;
        min-width: 800px;
    }
    
    .modern-table thead {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
    }
    
    .modern-table thead th {
        color: white;
        font-weight: 600;
        padding: 18px 16px;
        text-align: left;
        border: none;
        font-size: 0.95rem;
        white-space: nowrap;
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
        background: rgba(0, 113, 45, 0.1) !important;
        border-left: 4px solid var(--primary-green);
    }
    
    .modern-table tbody td {
        padding: 16px;
        border: none;
        color: var(--neutral-700);
        vertical-align: middle;
    }
    
    /* Status Badge */
    .status-badge {
        padding: 6px 14px;
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
    
    /* Table Container Improvements */
    .table-wrapper::-webkit-scrollbar {
        height: 8px;
    }
    
    .table-wrapper::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    
    .table-wrapper::-webkit-scrollbar-thumb {
        background: var(--primary-green);
        border-radius: 4px;
    }
    
    .table-wrapper::-webkit-scrollbar-thumb:hover {
        background: var(--accent-green);
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .main-content-wrapper {
            padding: 15px;
        }
        
        .container-fluid {
            padding: 0 15px;
        }
        
        .modern-header {
            flex-direction: column;
            gap: 16px;
            text-align: center;
            padding: 20px;
        }
        
        .controls-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .action-buttons {
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .modern-table {
            font-size: 0.85rem;
        }
        
        .modern-table thead th,
        .modern-table tbody td {
            padding: 12px 8px;
        }
        
        .modern-table thead th {
            font-size: 0.85rem;
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
                        <h2 class="header-title">Pendaftaran - Subjek Pajak</h2>
                        <p class="header-subtitle">Manajemen Data Wajib Pajak</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modern Controls -->
        <div class="modern-controls-container">
            <div class="controls-grid">
                <div class="control-group">
                    <label class="modern-label">
                        <i class="fas fa-user me-2"></i>Subjek Pajak
                    </label>
                    <input type="text" id="filterSubjek" class="modern-input" placeholder="Cari subjek pajak...">
                </div>
                <div class="control-group">
                    <label class="modern-label">
                        <i class="fas fa-user-tie me-2"></i>Pemilik/Pengelola
                    </label>
                    <input type="text" id="filterPemilik" class="modern-input" placeholder="Cari pemilik...">
                </div>
            </div>
            
            <div class="action-buttons">
                <button class="btn-modern btn-search" id="btnCari">
                    <i class="fas fa-search"></i>Cari
                </button>
                <button class="btn-modern btn-refresh" id="btnRefresh">
                    <i class="fas fa-sync-alt"></i>Refresh
                </button>
                <button class="btn-modern btn-add" id="addSubjekBtn">
                    <i class="fas fa-plus"></i>Tambah
                </button>
                <button class="btn-modern btn-edit" id="editSubjekBtn">
                    <i class="fas fa-edit"></i>Edit
                </button>
                <button class="btn-modern btn-delete" id="deleteSubjekBtn">
                    <i class="fas fa-trash"></i>Hapus
                </button>
                <button class="btn-modern btn-print" id="btnCetakKartu">
                    <i class="fas fa-print"></i>Cetak Kartu
                </button>
                <button class="btn-modern btn-info" id="btnLihatAkunWP">
                    <i class="fas fa-user-circle"></i>Akun WP
                </button>
            </div>
        </div>
        
        <!-- Modern Table -->
        <div class="modern-table-container">
            <div class="table-wrapper">
                <table class="modern-table" id="subjekTable">
                    <thead>
                        <tr>
                            <th><i class="fas fa-id-card me-2"></i>NPWPD</th>
                            <th><i class="fas fa-user me-2"></i>Subjek Pajak</th>
                            <th><i class="fas fa-user-tie me-2"></i>Pemilik/Pengelola</th>
                            <th><i class="fas fa-map-marker-alt me-2"></i>Alamat</th>
                            <th><i class="fas fa-city me-2"></i>Kecamatan</th>
                            <th><i class="fas fa-building me-2"></i>Kelurahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be loaded via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="subjekModal" tabindex="-1" aria-labelledby="subjekModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="subjekForm">
        @csrf
        <input type="hidden" name="id" id="subjek_id">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subjekModalLabel">Tambah/Edit Subjek Pajak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label>No. Form</label>
                            <input type="text" name="no_form" id="no_form" class="form-control" readonly>
                        </div>
                        <div class="mb-2">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" readonly>
                        </div>
                        <div class="mb-2">
                            <label>Tipe</label>
                            <select name="pribadi_badan" id="pribadi_badan" class="form-select" required>
                                <option value="pribadi">Pribadi</option>
                                <option value="badan">Badan</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Subjek Pajak</label>
                            <input type="text" name="subjek_pajak" id="subjek_pajak" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Pemilik/Pengelola</label>
                            <input type="text" name="pemilik" id="pemilik" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>NPWPD</label>
                            <input type="text" name="npwpd" id="npwpd" class="form-control" readonly>
                        </div>
                        <div class="mb-2">
                            <label>No. Pengukuhan</label>
                            <input type="text" name="noPengukuhan" id="noPengukuhan" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Tanggal Pengukuhan</label>
                            <input type="date" name="tanggalPengukuhan" id="tanggalPengukuhan" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label>Pejabat</label>
                            <input type="text" name="pejabat" id="pejabat" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-control" required>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Kelurahan</label>
                            <input type="text" name="kelurahan" id="kelurahan" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Kabupaten</label>
                            <input type="text" name="kabupaten" id="kabupaten" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Kode Pos</label>
                            <input type="text" name="kode_pos" id="kode_pos" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>No. HP</label>
                            <input type="text" name="nohp" id="nohp" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
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

<!-- Modal untuk melihat informasi Akun WP -->
<div class="modal fade" id="wpAccountModal" tabindex="-1" aria-labelledby="wpAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wpAccountModalLabel">Informasi Akun WP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="wpAccountInfo">
                    <!-- Konten akan diisi melalui JavaScript -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="btnResetPassword">
                    <i class="fas fa-key"></i> Reset Password
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    #subjekTable th, #subjekTable td {
        vertical-align: middle;
        text-align: center;
        user-select: text !important;
        -webkit-user-select: text !important;
        -moz-user-select: text !important;
        -ms-user-select: text !important;
    }
    #subjekTable tbody tr.selected,
    #subjekTable tbody tr.selected td {
        background-color: rgba(0, 113, 45, 0.1) !important;
        color: var(--primary-green) !important;
        font-weight: 600;
    }
    .dataTables_wrapper .dataTables_filter label {
        font-weight: bold;
    }
    .btn:focus, .btn:active {
        outline: none !important;
        box-shadow: none !important;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
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
    let table = $('#subjekTable').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        info: false,
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
            url: '{{ route('subjek_pajak.index') }}',
            data: function(d) {
                d.subjek = $('#filterSubjek').val();
                d.pemilik = $('#filterPemilik').val();
            }
        },
        columns: [
            { data: 'npwpd', name: 'npwpd' },
            { data: 'subjek_pajak', name: 'subjek_pajak' },
            { data: 'pemilik', name: 'pemilik' },
            { data: 'alamat', name: 'alamat' },
            { data: 'kecamatan', name: 'kecamatan' },
            { data: 'kelurahan', name: 'kelurahan' },
        ]
    });

    $('#subjekTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedRowId = null;
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedRowId = table.row(this).data().id;
        }
    });

    $('#addSubjekBtn').click(function() {
        $('#subjekForm')[0].reset();
        $('#subjek_id').val('');
        $('#no_form').val('Auto Generate');
        $('#npwpd').val('Auto Generate');
        let today = new Date().toISOString().slice(0, 10);
        $('#tanggal').val(today);
        $('#tanggal').prop('readonly', true);
        $('#subjekModalLabel').text('Tambah Subjek Pajak');
        $('#subjekModal').modal('show');
    });

    $('#editSubjekBtn').click(function() {
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
        $('#subjek_id').val(rowData.id);
        $('#no_form').val(rowData.no_form);
        $('#tanggal').val(rowData.tanggal);
        $('#pribadi_badan').val(rowData.pribadi_badan);
        $('#subjek_pajak').val(rowData.subjek_pajak);
        $('#pemilik').val(rowData.pemilik);
        $('#npwpd').val(rowData.npwpd);
        $('#noPengukuhan').val(rowData.noPengukuhan);
        $('#tanggalPengukuhan').val(rowData.tanggalPengukuhan);
        $('#pejabat').val(rowData.pejabat);
        $('#alamat').val(rowData.alamat);
        $('#kecamatan').val(rowData.kecamatan);
        $('#kelurahan').val(rowData.kelurahan);
        $('#kabupaten').val(rowData.kabupaten);
        $('#kode_pos').val(rowData.kode_pos);
        $('#nohp').val(rowData.nohp);
        $('#email').val(rowData.email);
        $('#tanggal').prop('readonly', true);
        $('#subjekModalLabel').text('Edit Subjek Pajak');
        $('#subjekModal').modal('show');
    });

    $('#deleteSubjekBtn').click(function() {
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
            title: 'Yakin ingin menghapus subjek pajak ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('subjek_pajak') }}/" + selectedRowId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function() {
                        Swal.fire('Berhasil!', 'Data subjek pajak dihapus.', 'success');
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

    $('#btnCari, #btnRefresh').click(function() {
        table.ajax.reload();
    });


    $('#subjekForm').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        let id = $('#subjek_id').val();
        let url, type;
        if (id) {
            url = "{{ url('subjek_pajak') }}/" + id;
            type = 'PUT';
        } else {
            url = "{{ route('subjek_pajak.store') }}";
            type = 'POST';
        }
        $.ajax({
            url: url,
            type: type,
            data: $.param(formData),
            success: function(res) {
                $('#subjekModal').modal('hide');
                
                // Tampilkan pesan sukses dengan informasi akun WP
                if (res.message) {
                    Swal.fire({
                        title: 'Berhasil!',
                        html: res.message + '<br><br><strong>Informasi Login WP:</strong><br>' +
                              'Username: <strong>' + res.npwpd + '</strong><br>' +
                              'Password: <strong>wp' + new Date().getFullYear() + '</strong><br><br>' +
                              '<small>Silakan berikan informasi login ini kepada Wajib Pajak.</small>',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire('Berhasil!', 'Data subjek pajak disimpan.', 'success');
                }
                
                table.ajax.reload();
                selectedRowId = null;
            },
            error: function(xhr) {
                Swal.fire('Error!', 'Gagal menyimpan data.', 'error');
            }
        });
    });

    $('#btnCetakKartu').click(function() {
        if (!selectedRowId) {
            Swal.fire('Pilih baris yang akan dicetak!', '', 'warning');
            return;
        }
        let rowData = table.row('.selected').data();
        if (!rowData) {
            Swal.fire('Data tidak ditemukan atau sudah dihapus.', '', 'error');
            table.ajax.reload();
            selectedRowId = null;
            return;
        }
        let url = `/subjek_pajak/cetak-kartu/${rowData.id}?npwpd=${encodeURIComponent(rowData.npwpd)}`;
        window.open(url, '_blank');
    });

    // Handle tombol Lihat Akun WP
    $('#btnLihatAkunWP').click(function() {
        if (!selectedRowId) {
            Swal.fire('Pilih baris subjek pajak yang akan dilihat akun WP-nya!', '', 'warning');
            return;
        }

        let rowData = table.row($('#subjekTable tbody tr.selected')).data();
        if (!rowData) {
            Swal.fire('Data tidak ditemukan atau sudah dihapus.', '', 'error');
            return;
        }

        // Ambil informasi akun WP
        $.get(`/subjek_pajak/wp-account/${rowData.id}`, function(response) {
            if (response.success) {
                let data = response.data;
                let statusBadge = data.disabled ? 
                    '<span class="badge bg-danger">Nonaktif</span>' : 
                    '<span class="badge bg-success">Aktif</span>';
                
                let html = `
                    <div class="row">
                        <div class="col-sm-4"><strong>NPWPD:</strong></div>
                        <div class="col-sm-8">${data.npwpd}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4"><strong>Username:</strong></div>
                        <div class="col-sm-8">${data.username}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4"><strong>Nama:</strong></div>
                        <div class="col-sm-8">${data.name}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4"><strong>NIP:</strong></div>
                        <div class="col-sm-8">${data.nip}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4"><strong>No HP:</strong></div>
                        <div class="col-sm-8">${data.nohp}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4"><strong>Status:</strong></div>
                        <div class="col-sm-8">${statusBadge}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4"><strong>Dibuat:</strong></div>
                        <div class="col-sm-8">${data.created_at}</div>
                    </div>
                `;
                
                $('#wpAccountInfo').html(html);
                $('#wpAccountModal').modal('show');
            } else {
                Swal.fire('Info', response.message, 'info');
            }
        }).fail(function() {
            Swal.fire('Error!', 'Gagal mengambil informasi akun WP.', 'error');
        });
    });

    // Handle tombol Reset Password
    $('#btnResetPassword').click(function() {
        if (!selectedRowId) {
            return;
        }

        Swal.fire({
            title: 'Reset Password?',
            text: 'Password akan direset ke default (wp' + new Date().getFullYear() + ')',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Reset!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                let rowData = table.row($('#subjekTable tbody tr.selected')).data();
                
                $.post(`/subjek_pajak/reset-wp-password/${rowData.id}`, {
                    _token: '{{ csrf_token() }}'
                }, function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            html: response.message + '<br><br><strong>Password Baru:</strong> ' + response.new_password,
                            icon: 'success'
                        });
                        $('#wpAccountModal').modal('hide');
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                }).fail(function() {
                    Swal.fire('Error!', 'Gagal mereset password.', 'error');
                });
            }
        });
    });
});
</script>
@endsection
