@extends('layouts.app')
@section('content')
<div class="container">
    <h5>Edit SPTPD</h5>
    <form action="{{ route('sptpd.update', $sptpd) }}" method="POST">
        @csrf @method('PUT')
        <div class="row mb-2">
            <div class="col-md-2">No. SPTPD</div>
            <div class="col-md-4"><input type="text" class="form-control" value="{{ $sptpd->id }}" disabled></div>
            <div class="col-md-2">Tanggal Terima</div>
            <div class="col-md-4"><input type="date" class="form-control" value="{{ $sptpd->created_at->format('Y-m-d') }}" disabled></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-2">UPT</div>
            <div class="col-md-4">
                <select name="upt_id" class="form-control" required>
                    <option value="">Pilih UPT</option>
                    @foreach($upts as $upt)
                        <option value="{{ $upt->id }}" @if($sptpd->upt_id == $upt->id) selected @endif>{{ $upt->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">Jatuh Tempo</div>
            <div class="col-md-4">
                <input type="date" name="jatuh_tempo" class="form-control" value="{{ $sptpd->jatuh_tempo }}" required>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-2">NOPD</div>
            <div class="col-md-4">
                <select name="objek_pajak_id" class="form-control" required id="objek_pajak_id">
                    <option value="">Pilih NOPD</option>
                    @foreach($objekPajaks as $objek)
                        <option value="{{ $objek->id }}"
                            data-npwpd="{{ $objek->subjekPajak->npwpd ?? '' }}"
                            data-nama="{{ $objek->subjekPajak->subjek_pajak ?? '' }}"
                            data-jenis="{{ $objek->jenis_pajak ?? '' }}"
                            @if($sptpd->objek_pajak_id == $objek->id) selected @endif>
                            {{ $objek->nopd }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">NPWPD</div>
            <div class="col-md-4">
                <input type="text" id="npwpd" class="form-control" value="{{ $sptpd->objekPajak->subjekPajak->npwpd ?? '' }}" disabled>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-2">Nama Subjek Pajak</div>
            <div class="col-md-4">
                <input type="text" id="nama_subjek" class="form-control" value="{{ $sptpd->objekPajak->subjekPajak->subjek_pajak ?? '' }}" disabled>
            </div>
            <div class="col-md-2">Jenis Pajak</div>
            <div class="col-md-4">
                <input type="text" id="jenis_pajak" class="form-control" value="{{ $sptpd->objekPajak->jenis_pajak ?? '' }}" disabled>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-2">Masa Pajak</div>
            <div class="col-md-4">
                <input type="date" name="masa_pajak_awal" class="form-control" value="{{ $sptpd->masa_pajak_awal }}" required>
            </div>
            <div class="col-md-2">s/d</div>
            <div class="col-md-2">
                <input type="date" name="masa_pajak_akhir" class="form-control" value="{{ $sptpd->masa_pajak_akhir }}" required>
            </div>
        </div>
        <h6 class="mt-3">Perhitungan</h6>
        <div class="row mb-2">
            <div class="col-md-2">Dasar</div>
            <div class="col-md-2"><input type="number" name="dasar" class="form-control" value="{{ $sptpd->dasar }}"></div>
            <div class="col-md-2">Tarif</div>
            <div class="col-md-2"><input type="number" name="tarif" class="form-control" value="{{ $sptpd->tarif }}" step="0.001"></div>
            <div class="col-md-2">Denda</div>
            <div class="col-md-2"><input type="number" name="denda" class="form-control" value="{{ $sptpd->denda }}"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-2">Bunga</div>
            <div class="col-md-2"><input type="number" name="bunga" class="form-control" value="{{ $sptpd->bunga }}"></div>
            <div class="col-md-2">Setoran</div>
            <div class="col-md-2"><input type="number" name="setoran" class="form-control" value="{{ $sptpd->setoran }}"></div>
            <div class="col-md-2">Lain-lain</div>
            <div class="col-md-2"><input type="number" name="lain_lain" class="form-control" value="{{ $sptpd->lain_lain }}"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-2">Kenaikan</div>
            <div class="col-md-2"><input type="number" name="kenaikan" class="form-control" value="{{ $sptpd->kenaikan }}"></div>
            <div class="col-md-2">Kompensasi</div>
            <div class="col-md-2"><input type="number" name="kompensasi" class="form-control" value="{{ $sptpd->kompensasi }}"></div>
            <div class="col-md-2">Pajak Terutang</div>
            <div class="col-md-2"><input type="number" name="pajak_terutang" class="form-control" value="{{ $sptpd->pajak_terutang }}"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-2">Omset Tapping Box</div>
            <div class="col-md-2"><input type="number" name="omset_tapping_box" class="form-control" value="{{ $sptpd->omset_tapping_box }}"></div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('sptpd.index') }}" class="btn btn-secondary">Batal / Kembali</a>
    </form>
</div>
<script>
document.getElementById('objek_pajak_id').addEventListener('change', function() {
    var selected = this.options[this.selectedIndex];
    document.getElementById('npwpd').value = selected.getAttribute('data-npwpd') || '';
    document.getElementById('nama_subjek').value = selected.getAttribute('data-nama') || '';
    document.getElementById('jenis_pajak').value = selected.getAttribute('data-jenis') || '';
});
</script>
@if ($errors->any())
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            html: `{!! implode('<br>', $errors->all()) !!}`
        });
    });
</script>
@endif
@endsection
