@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 20px; max-width: 500px;">
    <h5>REGISTRASI WAJIB PAJAK</h5>
    <form action="{{ route('wp.store') }}" method="POST" id="wpForm">
        @csrf
        <div class="mb-2">
            <label>User ID</label>
            <input type="text" id="userid" class="form-control" readonly>
        </div>
        <div class="mb-2 d-flex">
            <div style="flex:1;">
                <label>Nama</label>
                <input type="text" id="nama" class="form-control" readonly>
                <input type="hidden" name="subjek_pajak_id" id="subjek_pajak_id">
            </div>
            <button type="button" class="btn btn-success" id="btnCari" style="margin-top: 28px; margin-left: 8px;">Cari</button>
        </div>
        <div class="mb-2">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="new password" required>
        </div>
        <div class="mb-2">
            <label>
                <input type="checkbox" name="disabled" checked disabled> Disabled
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('wp.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<!-- Modal Cari Subjek Pajak -->
<div class="modal fade" id="modalCariSubjek" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cari Subjek Pajak</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="keywordCariSubjek" class="form-control mb-2" placeholder="Nama/NPWPD Subjek Pajak">
        <button type="button" class="btn btn-primary mb-3" id="doCariSubjek">Cari</button>
        <div id="hasilCariSubjek">
            <table class="table table-bordered table-hover" id="tableCariSubjek">
                <thead>
                    <tr>
                        <th>NPWPD</th>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data akan diisi via JS --}}
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script>
let cariTable = null;

document.getElementById('btnCari').onclick = function() {
    $('#modalCariSubjek').modal('show');
    if (!cariTable) {
        cariTable = $('#tableCariSubjek').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('subjek_pajak') }}",
                type: "GET",
                data: function(d) {
                    d.search = $('#keywordCariSubjek').val();
                }
            },
            searching: false,
            paging: true,
            info: false,
            columns: [
                { data: 'npwpd', name: 'npwpd' },
                { data: 'subjek_pajak', name: 'subjek_pajak' },
                { data: 'nohp', name: 'nohp' },
                { data: null, orderable: false, searchable: false, render: function(data, type, row) {
                    return `<button type="button" class="btn btn-sm btn-primary pilih-subjek-btn" data-id="${row.id}" data-npwpd="${row.npwpd}" data-nama="${row.subjek_pajak}">Pilih</button>`;
                }}
            ]
        });
    } else {
        cariTable.ajax.reload();
    }
};

document.getElementById('doCariSubjek').onclick = function() {
    if (cariTable) {
        cariTable.ajax.reload();
    }
};

// Pilih subjek pajak dari tabel
$(document).on('click', '.pilih-subjek-btn', function() {
    let npwpd = $(this).data('npwpd');
    let nama = $(this).data('nama');
    let id = $(this).data('id');
    document.getElementById('userid').value = npwpd;
    document.getElementById('nama').value = nama;
    document.getElementById('subjek_pajak_id').value = id;
    $('#modalCariSubjek').modal('hide');
});
</script>
@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        html: `{!! implode('<br>', $errors->all()) !!}`
    });
</script>
@endif
@endsection
