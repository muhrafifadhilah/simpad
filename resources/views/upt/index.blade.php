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
        
        .action-buttons {
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .modern-table {
            font-size: 0.85rem;
        }
        
        .modern-table thead th,
        .modern-table tbody td {
<!-- Modal untuk UPT -->
<div class="modal fade" id="uptModal" tabindex="-1" aria-labelledby="uptModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="uptForm">
        @csrf
        <input type="hidden" name="id" id="upt_id">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uptModalLabel">Tambah/Edit UPT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Nama UPT</label>
                            <input type="text" name="nama_upt" id="nama_upt" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Kepala UPT</label>
                            <input type="text" name="kepala_upt" id="kepala_upt" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label>Kecamatan yang Dikelola</label>
                        <div class="row" id="kecamatanCheckboxes">
                            <!-- Kecamatan checkboxes will be loaded via AJAX -->
                            <div class="col-12">
                                <p class="text-muted">Memuat data kecamatan...</p>
                            </div>
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
@endsection

@section('scripts')
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

    // Row selection
    $('#uptTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedRowId = null;
        } else {
            $('#uptTable tbody tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedRowId = $(this).data('id');
        }
    });

    $('#addUptBtn').click(function() {
        $('#uptForm')[0].reset();
        $('#upt_id').val('');
        loadKecamatanCheckboxes();
        $('#uptModalLabel').text('Tambah UPT');
        $('#uptModal').modal('show');
    });

    // Function to load kecamatan checkboxes
    function loadKecamatanCheckboxes() {
        $.get("{{ url('api/kecamatan') }}", function(data) {
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

    $('#editUptBtn').click(function() {
        if (!selectedRowId) {
            Swal.fire('Pilih baris yang akan diedit!', '', 'warning');
            return;
        }
        
        loadKecamatanCheckboxes();
        
        $.get("{{ url('upt') }}/" + selectedRowId, function(data) {
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
            
            $('#uptModalLabel').text('Edit UPT');
            $('#uptModal').modal('show');
        }).fail(function() {
            Swal.fire('Error!', 'Gagal mengambil data UPT.', 'error');
        });
    });

    $('#deleteUptBtn').click(function() {
        if (!selectedRowId) {
            Swal.fire('Pilih baris yang akan dihapus!', '', 'warning');
            return;
        }
        
        Swal.fire({
            title: 'Yakin ingin menghapus UPT ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('upt') }}/" + selectedRowId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function() {
                        Swal.fire('Berhasil!', 'Data UPT dihapus.', 'success');
                        location.reload();
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    });

    $('#uptForm').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        let id = $('#upt_id').val();
        let url, type;
        
        if (id) {
            url = "{{ url('upt') }}/" + id;
            type = 'PUT';
        } else {
            url = "{{ route('upt.store') }}";
            type = 'POST';
        }
        
        $.ajax({
            url: url,
            type: type,
            data: $.param(formData),
            success: function(res) {
                $('#uptModal').modal('hide');
                Swal.fire('Berhasil!', 'Data UPT disimpan.', 'success');
                location.reload();
            },
            error: function(xhr) {
                let msg = 'Gagal menyimpan data';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                Swal.fire('Error!', msg, 'error');
            }
        });
    });
});
</script>
@endsection
    }
    
    .btn-detail:hover {
        background: #138496;
        color: white;
        text-decoration: none;
    }
    
    /* DataTables Styling */
    .dataTables_wrapper {
        padding: 20px;
    }
    
    .dataTables_filter input {
        border: 2px solid var(--neutral-300);
        border-radius: var(--radius-md);
        padding: 8px 12px;
    }
    
    .dataTables_filter input:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(0, 113, 45, 0.1);
    }
    
    .dataTables_length select {
        border: 2px solid var(--neutral-300);
        border-radius: var(--radius-md);
        padding: 6px 10px;
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
        
        #uptTable {
            font-size: 0.8rem;
        }
        
        #uptTable thead th,
        #uptTable tbody td {
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
                        <h2 class="header-title">Unit Pelayanan Teknis (UPT)</h2>
                        <p class="header-subtitle">Manajemen Data UPT dan Kecamatan</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modern Controls -->
        <div class="modern-controls-container">
            <div class="action-buttons">
                <a href="{{ route('upt.create') }}" class="btn-modern btn-add">
                    <i class="fas fa-plus"></i>Tambah UPT
                </a>
            </div>
        </div>
        
        <!-- Modern Table -->
        <div class="modern-table-container">
            <table class="table table-hover" id="uptTable">
                <thead>
                    <tr>
                        <th><i class="fas fa-list-ol me-2"></i>No.</th>
                        <th><i class="fas fa-building me-2"></i>UPT</th>
                        <th><i class="fas fa-user-tie me-2"></i>Kepala UPT</th>
                        <th><i class="fas fa-map-marker-alt me-2"></i>Alamat</th>
                        <th><i class="fas fa-check-circle me-2"></i>Status</th>
                        <th><i class="fas fa-cogs me-2"></i>Aksi</th>
                    </tr>
                </thead>
            </table>
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
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(function() {
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');
        });
    }
    
    let table = $('#uptTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('upt.index') }}',
        language: {
            processing: "Memuat data...",
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            infoFiltered: "(difilter dari _MAX_ total data)",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        columns: [
            { data: 'no', name: 'no' },
            { data: 'nama', name: 'nama' },
            { data: 'kepala_upt', name: 'kepala_upt' },
            { data: 'alamat', name: 'alamat' },
            { 
                data: 'status', 
                name: 'status',
                render: function(data) {
                    return data == 1 ? 
                        '<span class="status-badge status-active"><i class="fas fa-check me-1"></i>Aktif</span>' : 
                        '<span class="status-badge status-inactive"><i class="fas fa-times me-1"></i>Non-Aktif</span>';
                }
            },
            { 
                data: 'id',
                orderable: false,
                searchable: false,
                render: function(id, type, row) {
                    return `
                        <button class="btn-action btn-detail" data-id="${id}">
                            <i class="fas fa-eye"></i> Detail
                        </button>
                    `;
                }
            }
        ],
        responsive: true,
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]]
    });

    $('#uptTable').on('click', '.btn-delete', function() {
        let id = $(this).data('id');
        if (confirm('Yakin ingin menghapus UPT ini?')) {
            $.ajax({
                url: '/upt/' + id,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function() {
                    table.ajax.reload();
                }
            });
        }
    });

    // Detail kecamatan
    $('#uptTable').on('click', '.btn-detail', function() {
        let id = $(this).data('id');
        $('#listKecamatanUPT').html('<li class="list-group-item"><i class="fas fa-spinner fa-spin me-2"></i>Memuat data...</li>');
        $('#modalDetailKecamatan').modal('show');
        $.get('/upt/' + id + '/kecamatan', function(data) {
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
    });
});
</script>
@endsection
