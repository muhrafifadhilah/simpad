@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 98%;">
    <div style="background: #fff; border-radius: 4px; border: 1px solid #eee; margin-top: 20px;">
        <div style="padding: 20px 25px 10px 25px;">
            <div style="font-size: 22px; font-weight: bold; letter-spacing: 1px; margin-bottom: 10px;">
                <span style="border-bottom: 3px solid #eaeaea; padding-bottom: 5px;">USERS</span>
            </div>
            <div class="d-flex align-items-center mb-2 flex-wrap gap-2 justify-content-between">
                <div>
                    <button class="btn" id="addPegawaiBtn" style="background:#22b8cf;color:#fff;min-width:90px;">Tambah</button>
                    <button class="btn" id="editPegawaiBtn" style="background:#fab005;color:#fff;min-width:90px;">Edit</button>
                    <button class="btn" id="deletePegawaiBtn" style="background:#fa5252;color:#fff;min-width:90px;">Hapus</button>
                </div>
                <div>
                    <span style="font-style: italic; font-weight: bold;">LEVEL</span>
                    <select id="levelFilter" class="form-select form-select-sm" style="width: 120px; display: inline-block; margin-left: 5px;">
                        <option value="">SEMUA</option>
                        <option value="psi">Admin</option>
                        <option value="pegawai">Pegawai</option>
                        <option value="wp">Wajib Pajak</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="pegawaiTable" style="background: #fafaff; user-select: text;">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>NIP</th>
                        </tr>
                    </thead>
                </table>
            </div>
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

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
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

@section('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
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