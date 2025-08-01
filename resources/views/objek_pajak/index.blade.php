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
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
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
        padding: 18px 16px;
        text-align: left;
        border: none;
        font-size: 0.95rem;
        white-space: nowrap;
    }
    
    .modern-table tbody tr {
        border-bottom: 1px solid var(--neutral-200);
        transition: var(--transition);
    }
    
    .modern-table tbody tr:hover {
        background: var(--neutral-100);
    }
    
    .modern-table tbody tr.selected {
        background: rgba(0, 113, 45, 0.1);
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
                        <h2 class="header-title">Objek Pajak</h2>
                        <p class="header-subtitle">Manajemen Data Objek Pajak Daerah</p>
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
                    <select id="filterSubjek" class="modern-select">
                        <option value="">Semua Subjek Pajak</option>
                        @foreach($subjekList as $subjek)
                            <option value="{{ $subjek->id }}">{{ $subjek->subjek_pajak }} ({{ $subjek->npwpd }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="control-group">
                    <label class="modern-label">
                        <i class="fas fa-map-marker-alt me-2"></i>Kecamatan
                    </label>
                    <select id="filterKecamatan" class="modern-select">
                        <option value="">Semua Kecamatan</option>
                        @foreach($kecamatanList as $kec)
                            <option value="{{ $kec->nama }}">{{ $kec->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="action-buttons">
                <button class="btn-modern btn-add" id="addObjekBtn">
                    <i class="fas fa-plus"></i>Tambah
                </button>
                <button class="btn-modern btn-edit" id="editObjekBtn">
                    <i class="fas fa-edit"></i>Edit
                </button>
                <button class="btn-modern btn-delete" id="deleteObjekBtn">
                    <i class="fas fa-trash"></i>Hapus
                </button>
            </div>
        </div>
        
        <!-- Modern Table -->
        <div class="modern-table-container">
            <table class="modern-table" id="objekTable">
                <thead>
                    <tr>
                        <th><i class="fas fa-id-card me-2"></i>NPWPD</th>
                        <th><i class="fas fa-barcode me-2"></i>NOPD</th>
                        <th><i class="fas fa-store me-2"></i>Nama Usaha</th>
                        <th><i class="fas fa-tags me-2"></i>Kategori Usaha</th>
                        <th><i class="fas fa-briefcase me-2"></i>Jenis Usaha</th>
                        <th><i class="fas fa-receipt me-2"></i>Jenis Pajak</th>
                        <th><i class="fas fa-city me-2"></i>Kecamatan</th>
                        <th><i class="fas fa-building me-2"></i>Kelurahan</th>
                        <th><i class="fas fa-check-circle me-2"></i>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be loaded via AJAX -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="objekModal" tabindex="-1" aria-labelledby="objekModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="objekForm">
        @csrf
        <input type="hidden" name="id" id="objek_id">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="objekModalLabel">Tambah/Edit Objek Pajak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label>Subjek Pajak</label>
                            <select name="subjek_pajak_id" id="subjek_pajak_id" class="form-select" required>
                                <option value="">Pilih Subjek Pajak</option>
                                @foreach($subjekList as $subjek)
                                    <option value="{{ $subjek->id }}">{{ $subjek->subjek_pajak }} ({{ $subjek->npwpd }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>NOPD</label>
                            <input type="text" name="nopd" id="nopd" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Nama Usaha</label>
                            <input type="text" name="nama_usaha" id="nama_usaha" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Kategori Usaha</label>
                            <select name="kategori_usaha" id="kategori_usaha" class="form-select" required>
                                <option value="">Pilih Kategori Usaha</option>
                                <option value="PBJT atas Jasa Perhotelan">PBJT atas Jasa Perhotelan</option>
                                <option value="PBJT atas Makanan dan / atau Minuman">PBJT atas Makanan dan / atau Minuman</option>
                                <option value="PBJT atas Jasa Kesenian dan Hiburan">PBJT atas Jasa Kesenian dan Hiburan</option>
                                <option value="Pajak Reklame">Pajak Reklame</option>
                                <option value="PBJT atas Tenaga Listrik">PBJT atas Tenaga Listrik</option>
                                <option value="PBJT atas Jasa Parkir">PBJT atas Jasa Parkir</option>
                                <option value="PBJT Air Tanah">PBJT Air Tanah</option>
                                <option value="PBJT Mineral Bukan Logam Dan Batuan">PBJT Mineral Bukan Logam Dan Batuan</option>
                                <option value="PBB">PBB</option>
                                <option value="BPHTB">BPHTB</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Jenis Usaha</label>
                            <select name="jenis_usaha" id="jenis_usaha" class="form-select" required>
                                <option value="">Pilih Jenis Usaha</option>
                                <option value="PBJT atas Jasa Perhotelan">PBJT atas Jasa Perhotelan</option>
                                <option value="PBJT atas Makanan dan / atau Minuman">PBJT atas Makanan dan / atau Minuman</option>
                                <option value="PBJT atas Jasa Kesenian dan Hiburan">PBJT atas Jasa Kesenian dan Hiburan</option>
                                <option value="Pajak Reklame">Pajak Reklame</option>
                                <option value="PBJT atas Tenaga Listrik">PBJT atas Tenaga Listrik</option>
                                <option value="PBJT atas Jasa Parkir">PBJT atas Jasa Parkir</option>
                                <option value="PBJT Air Tanah">PBJT Air Tanah</option>
                                <option value="PBJT Mineral Bukan Logam Dan Batuan">PBJT Mineral Bukan Logam Dan Batuan</option>
                                <option value="PBB">PBB</option>
                                <option value="BPHTB">BPHTB</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Jenis Pajak</label>
                            <select name="jenis_pajak" id="jenis_pajak" class="form-select" required>
                                <option value="">Pilih Jenis Pajak</option>
                                <option value="PBJT atas Jasa Perhotelan">PBJT atas Jasa Perhotelan</option>
                                <option value="PBJT atas Makanan dan / atau Minuman">PBJT atas Makanan dan / atau Minuman</option>
                                <option value="PBJT atas Jasa Kesenian dan Hiburan">PBJT atas Jasa Kesenian dan Hiburan</option>
                                <option value="Pajak Reklame">Pajak Reklame</option>
                                <option value="PBJT atas Tenaga Listrik">PBJT atas Tenaga Listrik</option>
                                <option value="PBJT atas Jasa Parkir">PBJT atas Jasa Parkir</option>
                                <option value="PBJT Air Tanah">PBJT Air Tanah</option>
                                <option value="PBJT Mineral Bukan Logam Dan Batuan">PBJT Mineral Bukan Logam Dan Batuan</option>
                                <option value="PBB">PBB</option>
                                <option value="BPHTB">BPHTB</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label>Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-select" required>
                                <option value="">Pilih Kecamatan</option>
                                @foreach($kecamatanList as $kec)
                                    <option value="{{ $kec->nama }}">{{ $kec->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Kelurahan</label>
                            <input type="text" name="kelurahan" id="kelurahan" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="aktif">Aktif</option>
                                <option value="tutup">Tutup</option>
                                <option value="tutup-sementara">Tutup Sementara</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>TMT Status</label>
                            <input type="date" name="status_tmt" id="status_tmt" class="form-control" required>
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

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    #objekTable th, #objekTable td {
        vertical-align: middle;
        text-align: center;
        user-select: text !important;
    }
    #objekTable tbody tr.selected,
    #objekTable tbody tr.selected td {
        background-color: #1976d2 !important;
        color: #fff !important;
    }
    #objekTable tbody tr:nth-child(even):not(.selected) {
        background-color: #e8edff !important;
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
    let selectedRowId = null;
    let table = $('#objekTable').DataTable({
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
            url: '{{ route('objek_pajak.index') }}',
            data: function(d) {
                d.subjek_pajak_id = $('#filterSubjek').val();
                d.kecamatan = $('#filterKecamatan').val();
            }
        },
        columns: [
            { data: 'subjek_npwpd', name: 'subjek_npwpd', defaultContent: '' },
            { data: 'nopd', name: 'nopd' },
            { data: 'nama_usaha', name: 'nama_usaha' },
            { data: 'kategori_usaha', name: 'kategori_usaha' },
            { data: 'jenis_usaha', name: 'jenis_usaha' },
            { data: 'jenis_pajak', name: 'jenis_pajak' },
            { data: 'kecamatan', name: 'kecamatan' },
            { data: 'kelurahan', name: 'kelurahan' },
            { data: 'status', name: 'status' }
        ]
    });

    $('#objekTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedRowId = null;
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedRowId = table.row(this).data().id;
        }
    });

    $('#addObjekBtn').click(function() {
        $('#objekForm')[0].reset();
        $('#objek_id').val('');
        $('#objekModalLabel').text('Tambah Objek Pajak');
        $('#objekModal').modal('show');
    });

    $('#editObjekBtn').click(function() {
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
        $('#objek_id').val(rowData.id);
        $('#subjek_pajak_id').val(rowData.subjek_pajak_id);
        $('#nopd').val(rowData.nopd);
        $('#nama_usaha').val(rowData.nama_usaha);
        $('#kategori_usaha').val(rowData.kategori_usaha);
        $('#jenis_usaha').val(rowData.jenis_usaha);
        $('#jenis_pajak').val(rowData.jenis_pajak);
        $('#kecamatan').val(rowData.kecamatan);
        $('#kelurahan').val(rowData.kelurahan);
        $('#alamat').val(rowData.alamat);
        $('#keterangan').val(rowData.keterangan);
        $('#status').val(rowData.status);
        $('#status_tmt').val(rowData.status_tmt);
        $('#objekModalLabel').text('Edit Objek Pajak');
        $('#objekModal').modal('show');
    });

    $('#deleteObjekBtn').click(function() {
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
            title: 'Yakin ingin menghapus objek pajak ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('objek_pajak') }}/" + selectedRowId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function() {
                        table.ajax.reload();
                        selectedRowId = null;
                        Swal.fire('Berhasil!', 'Data objek pajak dihapus.', 'success');
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    });

    $('#filterSubjek').change(function() {
        table.ajax.reload();
    });

    $('#filterKecamatan').change(function() {
        table.ajax.reload();
    });

    $('#objekForm').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        let id = $('#objek_id').val();
        let url, type;
        if (id) {
            url = "{{ url('objek_pajak') }}/" + id;
            type = 'PUT';
        } else {
            url = "{{ route('objek_pajak.store') }}";
            type = 'POST';
        }
        $.ajax({
            url: url,
            type: type,
            data: $.param(formData),
            success: function() {
                $('#objekModal').modal('hide');
                table.ajax.reload();
                selectedRowId = null;
                Swal.fire('Berhasil!', 'Data objek pajak disimpan.', 'success');
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

    // Sinkronisasi dropdown
    $('#kategori_usaha').on('change', function() {
        var val = $(this).val();
        if(val) {
            $('#jenis_usaha').val(val);
            $('#jenis_pajak').val(val);
        } else {
            $('#jenis_usaha').val('');
            $('#jenis_pajak').val('');
        }
    });

    // Jika ingin sinkron dua arah, tambahkan juga event di jenis_usaha/jenis_pajak jika perlu
    
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
