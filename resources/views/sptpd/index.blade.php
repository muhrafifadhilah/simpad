@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: -70px;">
    <div style="background: #fff; border-radius: 4px; border: 1px solid #eee; margin-top: 20px;">
        <div style="padding: 20px 25px 10px 25px;">
            <div style="font-size: 22px; font-weight: bold; letter-spacing: 1px; margin-bottom: 10px;">
                <span style="border-bottom: 3px solid #eaeaea; padding-bottom: 5px;">PENDATAAN - SPTPD</span>
            </div>
            <div class="d-flex align-items-center mb-2 flex-wrap gap-2">
                <a href="{{ route('sptpd.create') }}" class="btn btn-sm" style="background:#22b8cf;color:#fff;min-width:70px;">Tambah</a>
                <button class="btn btn-sm" id="editSptpdBtn" style="background:#fab005;color:#fff;min-width:70px;">Edit</button>
                <button class="btn btn-sm" id="deleteSptpdBtn" style="background:#fa5252;color:#fff;min-width:70px;">Hapus</button>
                <button class="btn btn-sm btn-secondary" id="exportPdfBtn">Export PDF</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="sptpdTable" style="background: #fafaff; user-select: text;">
                    <thead>
                        <tr>
                            <th>SPTPD</th>
                            <th>Tanggal</th>
                            <th>Dok.</th>
                            <th>NOPD</th>
                            <th>Subjek Pajak</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Jenis Pajak</th>
                            <th>Masa</th>
                            <th>Dasar</th>
                            <th>Omset Tapping Box</th>
                            <th>Pajak</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Data dummy diisi oleh JS --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    let selectedRowId = null;
    let table = $('#sptpdTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('sptpd.index') }}',
        },
        columns: [
            { 
                data: 'no_sptpd', 
                name: 'no_sptpd', 
                title: 'SPTPD', 
                className: 'text-center' 
            },
            { data: 'tanggal', name: 'created_at', title: 'Tanggal', className: 'text-center' },
            { data: 'dok', name: 'dok', title: 'Dok.', className: 'text-center' },
            { data: 'nopd', name: 'objek_pajak.nopd', title: 'NOPD', className: 'text-center' },
            { 
                data: 'subjek_pajak', 
                name: 'subjek_pajak.subjek_pajak', 
                title: 'Subjek Pajak', 
                className: 'text-center',
                render: function(data) {
                    // Hanya tampilkan nama subjek pajak saja (tanpa NPWPD)
                    return data ?? '';
                }
            },
            { data: 'kecamatan', name: 'objek_pajak.kecamatan', title: 'Kecamatan', className: 'text-center' },
            { data: 'kelurahan', name: 'objek_pajak.kelurahan', title: 'Kelurahan', className: 'text-center' },
            { data: 'jenis_pajak', name: 'objek_pajak.jenis_pajak', title: 'Jenis Pajak', className: 'text-center' },
            { data: 'masa', name: 'masa_pajak_awal', title: 'Masa', className: 'text-center' },
            { 
                data: 'dasar', 
                name: 'dasar', 
                title: 'Dasar', 
                className: 'text-end',
                render: d => d ? parseInt(d).toLocaleString('id-ID') : '0'
            },
            { 
                data: 'omset_tapping_box', 
                name: 'omset_tapping_box', 
                title: 'Omset Tapping Box', 
                className: 'text-end',
                render: d => d ? parseInt(d).toLocaleString('id-ID') : '0'
            },
            { 
                data: 'pajak', 
                name: 'pajak_terutang', 
                title: 'Pajak', 
                className: 'text-end',
                render: d => d ? parseInt(d).toLocaleString('id-ID') : '0'
            }
        ],
        searching: true,
        info: false,
        paging: true,
        ordering: false,
        createdRow: function(row, data, dataIndex) {
            // Tambahkan style agar rata tengah/kanan pada cell tertentu
            $(row).find('td').css('vertical-align', 'middle');
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                text: 'Export PDF',
                className: 'd-none',
                title: 'Data SPTPD',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                },
                orientation: 'landscape',
                pageSize: 'A4',
                customize: function (doc) {
                    doc.styles.tableHeader.alignment = 'center';
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.content[1].table.widths = [
                        '4%', '8%', '7%', '8%', '13%', '8%', '8%', '8%', '8%', '8%', '10%', '8%'
                    ];
                }
            }
        ],
        language: {
            search: "Cari:",
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
        }
    });

    // Custom Export PDF button
    $('#exportPdfBtn').on('click', function() {
        table.button('.buttons-pdf').trigger();
    });

    // Row selection
    $('#sptpdTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedRowId = null;
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedRowId = table.row(this).data().id;
        }
    });

    // Edit
    $('#editSptpdBtn').click(function() {
        if (!selectedRowId) {
            Swal.fire('Pilih baris yang akan diedit!', '', 'warning');
            return;
        }
        // Redirect ke halaman edit
        window.location.href = '/sptpd/' + selectedRowId + '/edit';
    });

    // Hapus
    $('#deleteSptpdBtn').click(function() {
        if (!selectedRowId) {
            Swal.fire('Pilih baris yang akan dihapus!', '', 'warning');
            return;
        }
        Swal.fire({
            title: 'Yakin ingin menghapus data SPTPD ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/sptpd/" + selectedRowId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function() {
                        table.ajax.reload();
                        selectedRowId = null;
                        Swal.fire('Berhasil!', 'Data SPTPD dihapus.', 'success');
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    });

    // Sweetalert untuk notifikasi sukses dari session Laravel
    @if(session('success'))
        setTimeout(function() {
            Swal.fire('Berhasil!', '{{ session('success') }}', 'success');
        }, 300);
    @endif

    // Sweetalert untuk notifikasi error dari session Laravel
    @if(session('errors'))
        @php
            $allErrors = session('errors')->all();
        @endphp
        setTimeout(function() {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: `{!! implode('<br>', $allErrors) !!}`
            });
        }, 300);
    @endif
});
</script>
@endsection