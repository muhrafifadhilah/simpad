@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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
    
    .controls-grid {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 20px;
        align-items: end;
        margin-bottom: 20px;
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
    
    .modern-select {
        padding: 12px 16px;
        border: 2px solid var(--neutral-300);
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        transition: var(--transition);
        background: white;
        min-width: 150px;
    }
    
    .modern-select:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(0, 113, 45, 0.1);
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
        user-select: text;
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
    
    /* Level Badge */
    .level-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .level-admin {
        background: rgba(255, 193, 7, 0.2);
        color: #f57c00;
    }
    
    .level-pegawai {
        background: rgba(0, 123, 255, 0.2);
        color: #0056b3;
    }
    
    .level-wp {
        background: rgba(40, 167, 69, 0.2);
        color: #28a745;
    }
    
    /* Filter Section */
    .filter-section {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .filter-label {
        font-weight: 600;
        color: var(--neutral-700);
        font-style: italic;
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
        
        .controls-grid {
            grid-template-columns: 1fr;
            gap: 16px;
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
        
        .filter-section {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
    }

    /* Table Styles */
    #pegawaiTable th, #pegawaiTable td {
        vertical-align: middle;
        text-align: center;
        user-select: text !important;
        -webkit-user-select: text !important;
        -moz-user-select: text !important;
        -ms-user-select: text !important;
    }
    #pegawaiTable tbody tr.selected,
    #pegawaiTable tbody tr.selected td {
        background-color: #1976d2 !important;
        color: #fff !important;
    }
    #pegawaiTable tbody tr:nth-child(even):not(.selected) {
        background-color: #e8edff !important;
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

@section('content')
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
                        <h2 class="header-title">Manajemen Pegawai</h2>
                        <p class="header-subtitle">Data Pegawai dan Administrator Sistem</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modern Controls -->
        <div class="modern-controls-container">
            <div class="controls-grid">
                <div class="action-buttons">
                    <button class="btn-modern btn-add" id="addPegawaiBtn">
                        <i class="fas fa-plus"></i>Tambah
                    </button>
                    <button class="btn-modern btn-edit" id="editPegawaiBtn">
                        <i class="fas fa-edit"></i>Edit
                    </button>
                    <button class="btn-modern btn-delete" id="deletePegawaiBtn">
                        <i class="fas fa-trash"></i>Hapus
                    </button>
                </div>
                
                <div class="filter-section">
                    <span class="filter-label">LEVEL</span>
                    <select id="levelFilter" class="modern-select">
                        <option value="">SEMUA</option>
                        <option value="psi">Admin</option>
                        <option value="pegawai">Pegawai</option>
                        <option value="wp">Wajib Pajak</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Modern Table -->
        <div class="modern-table-container">
            <table class="modern-table" id="pegawaiTable">
                <thead>
                    <tr>
                        <th><i class="fas fa-id-badge me-2"></i>User ID</th>
                        <th><i class="fas fa-user me-2"></i>Nama</th>
                        <th><i class="fas fa-briefcase me-2"></i>Jabatan</th>
                        <th><i class="fas fa-id-card me-2"></i>NIP</th>
                        <th><i class="fas fa-layer-group me-2"></i>Level</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

<!-- Modal -->
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="pegawaiModal" tabindex="-1" aria-labelledby="pegawaiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="pegawaiForm">
        @csrf
        <input type="hidden" name="id" id="pegawai_id">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pegawaiModalLabel">Tambah/Edit Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label>NIP</label>
                    <input type="text" name="nip" id="nip" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
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
    let table = $('#pegawaiTable').DataTable({
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
                first: "Pertama",
                last: "Terakhir",
                next: "Berikutnya",
                previous: "Sebelumnya"
            }
        },
        ajax: {
            url: '{{ route('pegawai.index') }}',
            data: function(d) {
                d.level = $('#levelFilter').val();
            }
        },
        columns: [
            { 
                data: 'userid', 
                name: 'userid',
                render: function(data, type, row) {
                    return data ? `<span class="editable" data-field="userid" data-id="${row.id}">${data}</span>` : '';
                }
            },
            { 
                data: 'nama', 
                name: 'nama',
                render: function(data, type, row) {
                    return `<span class="editable" data-field="nama" data-id="${row.id}">${data}</span>`;
                }
            },
            { 
                data: 'jabatan', 
                name: 'jabatan',
                render: function(data, type, row) {
                    return `<span class="editable" data-field="jabatan" data-id="${row.id}">${data}</span>`;
                }
            },
            { 
                data: 'nip', 
                name: 'nip',
                render: function(data, type, row) {
                    return `<span class="editable" data-field="nip" data-id="${row.id}">${data}</span>`;
                }
            }
        ]
    });

    // Row selection
    $('#pegawaiTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedRowId = null;
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedRowId = table.row(this).data().id;
        }
    });

    $('#addPegawaiBtn').click(function() {
        $('#pegawaiForm')[0].reset();
        $('#pegawai_id').val('');
        $('#pegawaiModalLabel').text('Tambah Pegawai');
        $('#password').prop('required', true);
        $('#nip').prop('readonly', false);
        $('#pegawaiModal').modal('show');
    });

    $('#editPegawaiBtn').click(function() {
        if (!selectedRowId) {
            Swal.fire('Pilih baris yang akan diedit!', '', 'warning');
            return;
        }
        // Ambil data row yang dipilih
        let rowData = table.row('.selected').data();

        // Cek jika rowData undefined/null (misal data sudah dihapus dari server)
        if (!rowData) {
            Swal.fire('Data tidak ditemukan atau sudah dihapus.', '', 'error');
            table.ajax.reload();
            selectedRowId = null;
            return;
        }

        $('#pegawai_id').val(rowData.id);
        $('#nama').val(rowData.nama);
        $('#nip').val(rowData.nip);
        $('#jabatan').val(rowData.jabatan);
        $('#password').prop('required', false);
        $('#nip').prop('readonly', true);
        $('#pegawaiModalLabel').text('Edit Pegawai');
        $('#pegawaiModal').modal('show');
    });

    // Enable inline edit only if row is selected
    $('#pegawaiTable').on('dblclick', '.editable', function() {
        let $span = $(this);
        let row = $span.closest('tr');
        if (!row.hasClass('selected')) {
            Swal.fire('Pilih baris terlebih dahulu sebelum mengedit!', '', 'warning');
            return;
        }
        let oldValue = $span.text();
        let field = $span.data('field');
        let id = $span.data('id');
        let input = $('<input type="text" class="form-control form-control-sm" style="display:inline;width:auto;min-width:80px;">').val(oldValue);
        $span.replaceWith(input);
        input.focus();

        input.on('blur keydown', function(e) {
            if (e.type === 'blur' || (e.type === 'keydown' && e.which === 13)) {
                let newValue = input.val();
                if (newValue !== oldValue) {
                    let data = {};
                    data[field] = newValue;
                    data['_token'] = '{{ csrf_token() }}';
                    $.ajax({
                        url: "{{ url('pegawai') }}/" + id,
                        type: 'PUT',
                        data: data,
                        success: function() {
                            table.ajax.reload(null, false);
                            Swal.fire('Berhasil!', 'Data berhasil diubah.', 'success');
                        },
                        error: function(xhr) {
                            Swal.fire('Gagal!', 'Gagal mengubah data.', 'error');
                        }
                    });
                } else {
                    input.replaceWith(`<span class="editable" data-field="${field}" data-id="${id}">${oldValue}</span>`);
                }
            }
        });
    });

    $('#pegawaiTable').on('click', '.edit-btn', function() {
        let id = $(this).data('id');
        $.get("{{ url('pegawai') }}/" + id, function(data) {
            $('#pegawai_id').val(data.id);
            $('#nama').val(data.nama);
            $('#nip').val(data.nip);
            $('#jabatan').val(data.jabatan);
            $('#password').prop('required', false);
            $('#nip').prop('readonly', true);
            $('#pegawaiModalLabel').text('Edit Pegawai');
            $('#pegawaiModal').modal('show');
        });
    });

    // Hapus event handler tombol delete-btn, gunakan tombol Hapus di atas tabel
    $('#deletePegawaiBtn').click(function() {
        if (!selectedRowId) {
            Swal.fire('Pilih baris yang akan dihapus!', '', 'warning');
            return;
        }
        // Ambil data row yang dipilih
        let rowData = table.row('.selected').data();
        if (!rowData) {
            Swal.fire('Data tidak ditemukan atau sudah dihapus.', '', 'error');
            table.ajax.reload();
            selectedRowId = null;
            return;
        }
        Swal.fire({
            title: 'Yakin ingin menghapus pegawai ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('pegawai') }}/" + selectedRowId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function() {
                        table.ajax.reload();
                        selectedRowId = null;
                        Swal.fire('Berhasil!', 'Data pegawai dihapus.', 'success');
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    });

    $('#levelFilter').change(function() {
        table.ajax.reload();
    });

    $('#pegawaiForm').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        let nipVal = $('#nip').val();
        formData.push({name: 'userid', value: nipVal});

        let id = $('#pegawai_id').val();
        let url, type;
        if (id) {
            // Jika ada id, maka update (PUT)
            url = "{{ url('pegawai') }}/" + id;
            type = 'PUT';
        } else {
            // Jika tidak ada id, maka create (POST)
            url = "{{ route('pegawai.store') }}";
            type = 'POST';
        }

        $.ajax({
            url: url,
            type: type,
            data: $.param(formData),
            success: function() {
                $('#pegawaiModal').modal('hide');
                table.ajax.reload();
                selectedRowId = null;
                Swal.fire('Berhasil!', 'Data pegawai disimpan.', 'success');
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
});
</script>
@endsection