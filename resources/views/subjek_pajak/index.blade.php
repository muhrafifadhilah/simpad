@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 98%;">
    <div style="background: #fff; border-radius: 4px; border: 1px solid #eee; margin-top: 20px;">
        <div style="padding: 20px 25px 10px 25px;">
            <div style="font-size: 22px; font-weight: bold; letter-spacing: 1px; margin-bottom: 10px;">
                <span style="border-bottom: 3px solid #eaeaea; padding-bottom: 5px;">PENDAFTARAN - SUBJEK PAJAK</span>
            </div>
            <div class="d-flex align-items-center mb-2 flex-wrap gap-2">
                <input type="text" id="filterSubjek" class="form-control form-control-sm me-2" placeholder="Subjek Pajak" style="width:180px;">
                <input type="text" id="filterPemilik" class="form-control form-control-sm me-2" placeholder="Pemilik" style="width:140px;">
                <button class="btn btn-primary btn-sm me-2" id="btnCari">Cari</button>
                <button class="btn btn-primary btn-sm me-2" id="btnRefresh">Refresh</button>
                <select id="filterKecamatan" class="form-select form-select-sm me-2" style="width:180px;display:inline-block;">
                    <option value="">SEMUA KECAMATAN</option>
                </select>
                <select id="filterKelurahan" class="form-select form-select-sm" style="width:180px;display:inline-block;">
                    <option value="">SEMUA KELURAHAN</option>
                </select>
            </div>
            <div class="d-flex align-items-center mb-2 flex-wrap gap-2">
                <button class="btn btn-sm" id="addSubjekBtn" style="background:#22b8cf;color:#fff;min-width:70px;">Tambah</button>
                <button class="btn btn-sm" id="editSubjekBtn" style="background:#fab005;color:#fff;min-width:70px;">Edit</button>
                <button class="btn btn-sm" id="deleteSubjekBtn" style="background:#fa5252;color:#fff;min-width:70px;">Hapus</button>
                <button class="btn btn-sm btn-secondary" id="btnCetakKartu">Cetak Kartu</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="subjekTable" style="background: #fafaff; user-select: text;">
                    <thead>
                        <tr>
                            <th>NPWPD</th>
                            <th>Subjek Pajak</th>
                            <th>Pemilik/Pengelola</th>
                            <th>Alamat</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                        </tr>
                    </thead>
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
                            <input type="text" name="kecamatan" id="kecamatan" class="form-control" required>
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
        background-color: #1976d2 !important;
        color: #fff !important;
    }
    #subjekTable tbody tr:nth-child(even):not(.selected) {
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
                d.kecamatan = $('#filterKecamatan').val();
                d.kelurahan = $('#filterKelurahan').val();
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
        // Set tanggal ke hari ini dan readonly
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
                        table.ajax.reload();
                        selectedRowId = null;
                        Swal.fire('Berhasil!', 'Data subjek pajak dihapus.', 'success');
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    });

    $('#btnCari, #btnRefresh').click(function() {
        table.ajax.reload();
    });

    $('#filterKecamatan').change(function() {
        // TODO: Load kelurahan sesuai kecamatan
        table.ajax.reload();
    });

    $('#filterKelurahan').change(function() {
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
                table.ajax.reload();
                selectedRowId = null;
                Swal.fire('Berhasil!', 'Data subjek pajak disimpan.', 'success');
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
        // Ganti URL berikut sesuai route cetak kartu PDF Anda
        let url = `/subjek_pajak/cetak-kartu/${rowData.id}?npwpd=${encodeURIComponent(rowData.npwpd)}`;
        window.open(url, '_blank');
    });

    $('#btnCetakBack').click(function() {
        Swal.fire('Fitur belum tersedia.');
    });

    // TODO: Load kecamatan & kelurahan options via AJAX jika perlu
});
</script>
@endsection
