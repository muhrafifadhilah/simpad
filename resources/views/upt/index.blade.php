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
                render: function(id) {
                    return `
                        <a href="/upt/${id}/edit" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="${id}">Hapus</button>
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
});
</script>
@endsection
