@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 98%;">
    <div style="background: #fff; border-radius: 4px; border: 1px solid #eee; margin-top: 20px;">
        <div style="padding: 20px 25px 10px 25px;">
            <div style="font-size: 22px; font-weight: bold; letter-spacing: 1px; margin-bottom: 10px;">
                <span style="border-bottom: 3px solid #eaeaea; padding-bottom: 5px;">Objek Pajak</span>
            </div>
            <div class="d-flex align-items-center mb-2 flex-wrap gap-2">
                <select id="filterSubjek" class="form-select form-select-sm me-2" style="width:220px;">
                    <option value="">SEMUA SUBJEK PAJAK</option>
                    @foreach($subjekList as $subjek)
                        <option value="{{ $subjek->id }}">{{ $subjek->subjek_pajak }} ({{ $subjek->npwpd }})</option>
                    @endforeach
                </select>
                <select id="filterKecamatan" class="form-select form-select-sm me-2" style="width:180px;">
                    <option value="">SEMUA KECAMATAN</option>
                    @foreach($kecamatanList as $kec)
                        <option value="{{ $kec->nama }}">{{ $kec->nama }}</option>
                    @endforeach
                </select>
                <button class="btn btn-sm" id="addObjekBtn" style="background:#22b8cf;color:#fff;min-width:70px;">Tambah</button>
                <button class="btn btn-sm" id="editObjekBtn" style="background:#fab005;color:#fff;min-width:70px;">Edit</button>
                <button class="btn btn-sm" id="deleteObjekBtn" style="background:#fa5252;color:#fff;min-width:70px;">Hapus</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="objekTable" style="background: #fafaff; user-select: text;">
                    <thead>
                        <tr>
                            <th>NPWPD</th>
                            <th>NOPD</th>
                            <th>Nama Usaha</th>
                            <th>Kategori Usaha</th>
                            <th>Jenis Usaha</th>
                            <th>Jenis Pajak</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
});
</script>
@endsection
