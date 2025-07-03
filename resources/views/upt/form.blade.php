@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 900px;">
    <form method="POST" action="{{ isset($upt) ? route('upt.update', $upt->id) : route('upt.store') }}">
        @csrf
        @if(isset($upt))
            @method('PUT')
        @endif
        <div style="background: #fff; border-radius: 4px; border: 1px solid #eee; margin-top: 20px;">
            <div style="padding: 20px 25px 10px 25px;">
                <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">
                    UPT({{ isset($upt) ? 'EDIT' : 'TAMBAH' }})
                </div>
                <div class="row mb-2">
                    <div class="col-md-2"><label>No.</label></div>
                    <div class="col-md-4">
                        <input type="text" name="no" class="form-control" value="{{ old('no', $upt->no ?? '') }}" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-2"><label>UPT</label></div>
                    <div class="col-md-4">
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $upt->nama ?? '') }}" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-2"><label>Kepala UPT</label></div>
                    <div class="col-md-4">
                        <input type="text" name="kepala_upt" class="form-control" value="{{ old('kepala_upt', $upt->kepala_upt ?? '') }}" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-2"><label>Alamat</label></div>
                    <div class="col-md-6">
                        <textarea name="alamat" class="form-control" required>{{ old('alamat', $upt->alamat ?? '') }}</textarea>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-2"><label>Aktif</label></div>
                    <div class="col-md-2">
                        <input type="checkbox" name="status" value="1" {{ old('status', $upt->status ?? 1) ? 'checked' : '' }}>
                    </div>
                </div>
                <hr>
                <div style="font-weight:bold;">Detail Kecamatan</div>
                <div class="mb-2">
                    <button type="button" class="btn btn-success btn-sm" id="btnTambahKecamatan">Tambah Kecamatan</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabelKecamatan">
                        <thead style="background:#4caf50;color:#fff;">
                            <tr>
                                <th>Kecamatan</th>
                                <th>Aktif</th>
                                <th>Ubah</th>
                                <th>Batal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($upt))
                                @foreach($upt->kecamatans as $kec)
                                <tr data-id="{{ $kec->id }}">
                                    <td>
                                        <input type="hidden" name="kecamatan_ids[]" value="{{ $kec->id }}">
                                        {{ $kec->nama }}
                                    </td>
                                    <td style="text-align:center;"><span style="color:#222;font-size:18px;">&#10003;</span></td>
                                    <td style="text-align:center;">
                                        <button type="button" class="btn btn-warning btn-sm btnUbahKec" disabled>Ubah</button>
                                    </td>
                                    <td style="text-align:center;">
                                        <button type="button" class="btn btn-danger btn-sm btnHapusKec">Batal</button>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('upt.index') }}" class="btn btn-secondary">Batal / Kembali</a>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal Pilih Kecamatan -->
<div class="modal fade" id="modalPilihKecamatan" tabindex="-1" aria-labelledby="modalPilihKecamatanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Kecamatan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <select id="pilihKecamatan" class="form-select">
                <option value="">Pilih Kecamatan</option>
                @foreach($kecamatanList as $kec)
                    <option value="{{ $kec->id }}">{{ $kec->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnSimpanKecamatan">Tambah</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
$(function() {
    $('#btnTambahKecamatan').click(function() {
        $('#modalPilihKecamatan').modal('show');
    });
    $('#btnSimpanKecamatan').click(function() {
        let kecId = $('#pilihKecamatan').val();
        let kecNama = $('#pilihKecamatan option:selected').text();
        if (!kecId) return;
        // Cek jika sudah ada
        if ($('#tabelKecamatan tbody tr[data-id="'+kecId+'"]').length > 0) {
            alert('Kecamatan sudah dipilih!');
            return;
        }
        let row = `<tr data-id="${kecId}">
            <td>
                <input type="hidden" name="kecamatan_ids[]" value="${kecId}">
                ${kecNama}
            </td>
            <td style="text-align:center;"><span style="color:#222;font-size:18px;">&#10003;</span></td>
            <td style="text-align:center;"><button type="button" class="btn btn-warning btn-sm btnUbahKec" disabled>Ubah</button></td>
            <td style="text-align:center;"><button type="button" class="btn btn-danger btn-sm btnHapusKec">Batal</button></td>
        </tr>`;
        $('#tabelKecamatan tbody').append(row);
        $('#modalPilihKecamatan').modal('hide');
    });
    $('#tabelKecamatan').on('click', '.btnHapusKec', function() {
        $(this).closest('tr').remove();
    });
});
</script>
@endsection
