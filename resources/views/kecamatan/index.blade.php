@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 700px;">
    <div style="background: #fff; border-radius: 4px; border: 1px solid #eee; margin-top: 20px;">
        <div style="padding: 20px 25px 10px 25px;">
            <div style="font-size: 22px; font-weight: bold; letter-spacing: 1px; margin-bottom: 10px;">
                <span style="border-bottom: 3px solid #eaeaea; padding-bottom: 5px;">Kecamatan</span>
            </div>
            <div class="mb-2">
                <button class="btn btn-sm" id="addKecBtn" style="background:#22b8cf;color:#fff;min-width:70px;">Tambah</button>
                <button class="btn btn-sm" id="editKecBtn" style="background:#fab005;color:#fff;min-width:70px;">Edit</button>
                <button class="btn btn-sm" id="deleteKecBtn" style="background:#fa5252;color:#fff;min-width:70px;">Hapus</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="kecamatanTable" style="background: #fafaff;">
                    <thead>
                        <tr style="background:#e8eaff;">
                            <th>Kode</th>
                            <th>Kecamatan</th>
                            <th>TMT</th>
                            <th>Aktif</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="kecModal" tabindex="-1" aria-labelledby="kecModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="kecForm">
        @csrf
        <input type="hidden" name="id" id="kec_id">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kecModalLabel">Tambah/Edit Kecamatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label>Kode</label>
                    <input type="text" name="kode" id="kode" class="form-control" maxlength="4" required>
                </div>
                <div class="mb-2">
                    <label>Nama Kecamatan</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
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
});
</script>
@endsection
