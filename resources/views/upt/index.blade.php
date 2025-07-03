@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 900px;">
    <div style="background: #fff; border-radius: 4px; border: 1px solid #eee; margin-top: 20px;">
        <div style="padding: 20px 25px 10px 25px;">
            <div style="font-size: 22px; font-weight: bold; letter-spacing: 1px; margin-bottom: 10px;">
                <span style="border-bottom: 3px solid #eaeaea; padding-bottom: 5px;">UPT</span>
            </div>
            <div class="mb-2">
                <a href="{{ route('upt.create') }}" class="btn btn-sm" style="background:#22b8cf;color:#fff;min-width:70px;">Tambah</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="uptTable" style="background: #fafaff;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>UPT</th>
                            <th>Kepala UPT</th>
                            <th>Alamat</th>
                            <th>Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- Modal Detail Kecamatan -->
            <div class="modal fade" id="modalDetailKecamatan" tabindex="-1" aria-labelledby="modalDetailKecamatanLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailKecamatanLabel">Daftar Kecamatan UPT</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <ul id="listKecamatanUPT" style="padding-left:18px;"></ul>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(function() {
    let table = $('#uptTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('upt.index') }}',
        columns: [
            { data: 'no', name: 'no' },
            { data: 'nama', name: 'nama' },
            { data: 'kepala_upt', name: 'kepala_upt' },
            { data: 'alamat', name: 'alamat' },
            { 
                data: 'status', 
                name: 'status',
                render: function(data) {
                    return data == 1 ? '<span style="font-size:18px;color:#222;">&#10003;</span>' : '';
                }
            },
            { 
                data: 'id',
                orderable: false,
                searchable: false,
                render: function(id, type, row) {
                    return `
                        <button class="btn btn-info btn-sm btn-detail" data-id="${id}">Detail</button>
                    `;
                }
            }
        ]
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
        $('#listKecamatanUPT').html('<li>Memuat data...</li>');
        $('#modalDetailKecamatan').modal('show');
        $.get('/upt/' + id + '/kecamatan', function(data) {
            let html = '';
            if (data.length === 0) {
                html = '<li><i>Tidak ada kecamatan</i></li>';
            } else {
                data.forEach(function(kec) {
                    html += `<li>${kec.nama}</li>`;
                });
            }
            $('#listKecamatanUPT').html(html);
        });
    });
});
</script>
@endsection
