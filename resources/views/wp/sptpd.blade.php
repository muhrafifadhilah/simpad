@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid p-4">
    <div class="row mb-3">
        <div class="col-md-8">
            <h3 class="text-dark">
                <i class="fas fa-file-invoice-dollar text-primary me-2"></i>
                Data SPTPD Saya
            </h3>
            <p class="text-muted mb-0">Kelola dan pantau status SPTPD Anda</p>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createSptpdModal">
                <i class="fas fa-plus me-2"></i>Buat SPTPD Baru
            </button>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%)">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title opacity-75">Total SPTPD</h6>
                            <h3 class="mb-0">{{ $sptpd->count() }}</h3>
                        </div>
                        <i class="fas fa-file-invoice fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%)">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title opacity-75">Belum Bayar</h6>
                            <h3 class="mb-0">{{ $sptpd->where('status', '!=', 'Lunas')->count() }}</h3>
                        </div>
                        <i class="fas fa-clock fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title opacity-75">Sudah Lunas</h6>
                            <h3 class="mb-0">{{ $sptpd->where('status', 'Lunas')->count() }}</h3>
                        </div>
                        <i class="fas fa-check-circle fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%)">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title opacity-75">Total Pajak</h6>
                            <h3 class="mb-0">Rp {{ number_format($sptpd->sum('pajak_terutang'), 0, ',', '.') }}</h3>
                        </div>
                        <i class="fas fa-money-bill-wave fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter dan Search -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" id="searchSptpd" placeholder="Cari nomor SPTPD...">
            </div>
        </div>
        <div class="col-md-3">
            <select class="form-select" id="filterStatus">
                <option value="">Semua Status</option>
                <option value="Draft">Draft</option>
                <option value="Terkirim">Terkirim</option>
                <option value="Lunas">Lunas</option>
                <option value="Terlambat">Terlambat</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select" id="filterYear">
                <option value="">Semua Tahun</option>
                @for($year = date('Y'); $year >= date('Y') - 5; $year--)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>
        </div>
    </div>

    <!-- Tabel SPTPD -->
    <div class="card shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">
                <i class="fas fa-list me-2 text-primary"></i>
                Daftar SPTPD
            </h5>
        </div>
        <div class="card-body p-0">
            @if($sptpd->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="sptpdTable">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3">No</th>
                                <th class="py-3">Nomor SPTPD</th>
                                <th class="py-3">Periode</th>
                                <th class="py-3">Jatuh Tempo</th>
                                <th class="py-3">Objek Pajak</th>
                                <th class="py-3">Pajak Terutang</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sptpd as $index => $item)
                            <tr>
                                <td class="align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle">
                                    <strong>{{ $item->nomor_sptpd ?? 'SPTPD-' . str_pad($item->id, 6, '0', STR_PAD_LEFT) }}</strong>
                                </td>
                                <td class="align-middle">
                                    @if($item->masa_pajak_awal && $item->masa_pajak_akhir)
                                        {{ \Carbon\Carbon::parse($item->masa_pajak_awal)->format('M Y') }} -
                                        {{ \Carbon\Carbon::parse($item->masa_pajak_akhir)->format('M Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if($item->jatuh_tempo)
                                        @php
                                            $jatuhTempo = \Carbon\Carbon::parse($item->jatuh_tempo);
                                            $isOverdue = $jatuhTempo->isPast() && ($item->status != 'Lunas');
                                        @endphp
                                        <span class="{{ $isOverdue ? 'text-danger fw-bold' : '' }}">
                                            {{ $jatuhTempo->format('d/m/Y') }}
                                        </span>
                                        @if($isOverdue)
                                            <br><small class="text-danger">Terlambat {{ $jatuhTempo->diffForHumans() }}</small>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    {{ $item->objekPajak->jenis_pajak ?? 'Objek Pajak Umum' }}
                                </td>
                                <td class="align-middle">
                                    <strong class="text-success">
                                        Rp {{ number_format($item->pajak_terutang ?? 0, 0, ',', '.') }}
                                    </strong>
                                </td>
                                <td class="align-middle">
                                    @php
                                        $status = $item->status ?? 'Draft';
                                        $badgeClass = match($status) {
                                            'Lunas' => 'bg-success',
                                            'Terkirim' => 'bg-info',
                                            'Terlambat' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} px-3 py-2">
                                        <i class="fas fa-{{ $status == 'Lunas' ? 'check' : ($status == 'Terkirim' ? 'paper-plane' : 'clock') }} me-1"></i>
                                        {{ $status }}
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" title="Lihat Detail" onclick="viewDetail({{ $item->id }})">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @if($item->status != 'Lunas')
                                            <button class="btn btn-sm btn-outline-success" title="Bayar" onclick="bayarSptpd({{ $item->id }})">
                                                <i class="fas fa-credit-card"></i>
                                            </button>
                                        @endif
                                        @if($item->status == 'Lunas')
                                            <button class="btn btn-sm btn-outline-secondary" title="Bukti Bayar" onclick="buktiBayar({{ $item->id }})">
                                                <i class="fas fa-receipt"></i>
                                            </button>
                                        @endif
                                        <button class="btn btn-sm btn-outline-info" title="Cetak PDF" onclick="printPdf({{ $item->id }})">
                                            <i class="fas fa-print"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-file-invoice fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum Ada Data SPTPD</h5>
                    <p class="text-muted mb-4">Anda belum memiliki data SPTPD. Silakan buat SPTPD baru untuk memulai.</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSptpdModal">
                        <i class="fas fa-plus me-2"></i>Buat SPTPD Pertama
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Buat SPTPD Baru -->
<div class="modal fade" id="createSptpdModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus me-2"></i>Buat SPTPD Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> SPTPD baru akan dibuat dengan data Subjek Pajak Anda.
                </div>
                <form id="createSptpdForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Masa Pajak Awal</label>
                                <input type="month" class="form-control" name="masa_pajak_awal" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Masa Pajak Akhir</label>
                                <input type="month" class="form-control" name="masa_pajak_akhir" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Pajak</label>
                        <select class="form-select" name="objek_pajak_id" required>
                            <option value="">Pilih Jenis Pajak</option>
                            @if(isset($objekPajaks) && $objekPajaks->count() > 0)
                                @foreach($objekPajaks as $objek)
                                    <option value="{{ $objek->id }}">{{ $objek->jenis_pajak }}</option>
                                @endforeach
                            @else
                                <option value="184">PBB</option>
                                <option value="192">PBJT atas Jasa Perhotelan</option>
                                <option value="188">Pajak Reklame</option>
                                <option value="195">PBJT atas Makanan dan / atau Minuman</option>
                                <option value="191">PBJT atas Jasa Parkir</option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Omzet/Dasar Pengenaan</label>
                        <input type="number" class="form-control" name="dasar" placeholder="Masukkan omzet dalam rupiah" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="createSptpd()">
                    <i class="fas fa-save me-2"></i>Simpan SPTPD
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal View Detail SPTPD -->
<div class="modal fade" id="viewSptpdModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-eye me-2"></i>Detail SPTPD
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewSptpdContent">
                <div class="text-center">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                    <p class="mt-2">Memuat data...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-info" id="printDetailBtn" onclick="printDetailPdf()">
                    <i class="fas fa-print me-2"></i>Cetak PDF
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bayar SPTPD -->
<div class="modal fade" id="bayarSptpdModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-credit-card me-2"></i>Pembayaran SPTPD
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Setelah pembayaran, SPTPD akan berstatus "Lunas" dan tidak dapat diubah lagi.
                </div>
                
                <!-- Info SPTPD -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Detail SPTPD</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nomor SPTPD:</strong> <span id="bayarNomorSptpd">-</span></p>
                                <p><strong>Periode:</strong> <span id="bayarPeriode">-</span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Pajak Terutang:</strong> <span id="bayarPajakTerutang">-</span></p>
                                <p><strong>Total Bayar:</strong> <span id="bayarTotalBayar" class="text-success fw-bold">-</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="bayarSptpdForm" enctype="multipart/form-data">
                    <input type="hidden" id="bayarSptpdId" name="sptpd_id">
                    
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                        <select class="form-select" name="metode_bayar" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="tunai">Tunai (di Kantor Bapenda)</option>
                            <option value="va">Virtual Account</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Bukti Bayar (Opsional)</label>
                        <input type="file" class="form-control" name="bukti_bayar" accept=".pdf,.jpg,.jpeg,.png">
                        <div class="form-text">Format: PDF, JPG, JPEG, PNG. Maksimal 2MB</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan (Opsional)</label>
                        <textarea class="form-control" name="keterangan" rows="3" placeholder="Catatan tambahan tentang pembayaran..."></textarea>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Penting:</strong> Pastikan pembayaran sudah benar-benar dilakukan sebelum mengklik tombol "Konfirmasi Pembayaran".
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" onclick="konfirmasiBayar()">
                    <i class="fas fa-check me-2"></i>Konfirmasi Pembayaran
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Filter dan Search functionality
document.getElementById('searchSptpd').addEventListener('keyup', filterTable);
document.getElementById('filterStatus').addEventListener('change', filterTable);
document.getElementById('filterYear').addEventListener('change', filterTable);

function filterTable() {
    const search = document.getElementById('searchSptpd').value.toLowerCase();
    const status = document.getElementById('filterStatus').value;
    const year = document.getElementById('filterYear').value;
    const rows = document.querySelectorAll('#sptpdTable tbody tr');

    rows.forEach(row => {
        const nomor = row.cells[1].textContent.toLowerCase();
        const statusCell = row.cells[6].textContent;
        const periode = row.cells[2].textContent;
        
        let showRow = true;
        
        if (search && !nomor.includes(search)) showRow = false;
        if (status && !statusCell.includes(status)) showRow = false;
        if (year && !periode.includes(year)) showRow = false;
        
        row.style.display = showRow ? '' : 'none';
    });
}

function viewDetail(id) {
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('viewSptpdModal'));
    modal.show();
    
    // Reset content
    document.getElementById('viewSptpdContent').innerHTML = `
        <div class="text-center">
            <i class="fas fa-spinner fa-spin fa-2x"></i>
            <p class="mt-2">Memuat data...</p>
        </div>
    `;
    
    // Store ID for print function
    window.currentSptpdId = id;
    
    fetch(`/wp/sptpd/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const sptpd = data.data;
                document.getElementById('viewSptpdContent').innerHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">Informasi SPTPD</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Nomor SPTPD:</strong></td>
                                            <td>${sptpd.nomor_sptpd || 'SPTPD-' + String(sptpd.id).padStart(6, '0')}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td><span class="badge bg-${getStatusColor(sptpd.status)}">${sptpd.status}</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal Dibuat:</strong></td>
                                            <td>${formatDate(sptpd.created_at)}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jatuh Tempo:</strong></td>
                                            <td>${formatDate(sptpd.jatuh_tempo)}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0">Data Wajib Pajak</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Nama:</strong></td>
                                            <td>${sptpd.subjek_pajak ? sptpd.subjek_pajak.subjek_pajak : '-'}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>NPWPD:</strong></td>
                                            <td>${sptpd.subjek_pajak ? sptpd.subjek_pajak.npwpd : '-'}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Alamat:</strong></td>
                                            <td>${sptpd.subjek_pajak ? sptpd.subjek_pajak.alamat : '-'}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Pajak:</strong></td>
                                            <td>${sptpd.objek_pajak ? sptpd.objek_pajak.jenis_pajak : 'Pajak Umum'}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0">Perhitungan Pajak</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Masa Pajak:</strong></td>
                                                    <td>${formatMonth(sptpd.masa_pajak_awal)} - ${formatMonth(sptpd.masa_pajak_akhir)}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Dasar Pengenaan:</strong></td>
                                                    <td>Rp ${formatNumber(sptpd.dasar || 0)}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tarif Pajak:</strong></td>
                                                    <td>${sptpd.tarif || 0}%</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Pajak Terutang:</strong></td>
                                                    <td class="text-success"><strong>Rp ${formatNumber(sptpd.pajak_terutang || 0)}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Denda:</strong></td>
                                                    <td>Rp ${formatNumber(sptpd.denda || 0)}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Total Bayar:</strong></td>
                                                    <td class="text-danger"><strong>Rp ${formatNumber((sptpd.pajak_terutang || 0) + (sptpd.denda || 0))}</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                document.getElementById('viewSptpdContent').innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Error: ${data.message || 'Gagal memuat data SPTPD'}
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('viewSptpdContent').innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Terjadi kesalahan saat mengambil detail SPTPD
                </div>
            `;
        });
}

function printDetailPdf() {
    if (window.currentSptpdId) {
        window.open(`/wp/sptpd/${window.currentSptpdId}/pdf`, '_blank');
    }
}

// Helper functions
function getStatusColor(status) {
    switch(status) {
        case 'Lunas': return 'success';
        case 'Terkirim': return 'info';
        case 'Terlambat': return 'danger';
        default: return 'secondary';
    }
}

function formatDate(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'long',
        year: 'numeric'
    });
}

function formatMonth(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        month: 'long',
        year: 'numeric'
    });
}

function formatDateForInput(dateString) {
    if (!dateString) return '';
    const date = new Date(dateString);
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    return `${year}-${month}`;
}

function formatNumber(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}

function printPdf(id) {
    window.open(`/wp/sptpd/${id}/pdf`, '_blank');
}

function createSptpd() {
    const form = document.getElementById('createSptpdForm');
    const formData = new FormData(form);
    
    // Show loading
    const submitBtn = event.target;
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
    submitBtn.disabled = true;
    
    fetch('/wp/sptpd', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('SPTPD berhasil dibuat!');
            bootstrap.Modal.getInstance(document.getElementById('createSptpdModal')).hide();
            location.reload(); // Refresh halaman
        } else {
            alert('Error: ' + (data.message || 'Terjadi kesalahan'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat membuat SPTPD');
    })
    .finally(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
}

function bayarSptpd(id) {
    fetch(`/wp/sptpd/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const sptpd = data.data;
                
                // Check if can pay
                if (sptpd.status === 'Lunas') {
                    alert('SPTPD sudah lunas!');
                    return;
                }
                
                // Fill payment modal
                document.getElementById('bayarSptpdId').value = sptpd.id;
                document.getElementById('bayarNomorSptpd').textContent = sptpd.nomor_sptpd || 'SPTPD-' + String(sptpd.id).padStart(6, '0');
                document.getElementById('bayarPeriode').textContent = formatMonth(sptpd.masa_pajak_awal) + ' - ' + formatMonth(sptpd.masa_pajak_akhir);
                document.getElementById('bayarPajakTerutang').textContent = 'Rp ' + formatNumber(sptpd.pajak_terutang || 0);
                
                // Calculate total
                const total = (sptpd.pajak_terutang || 0) + (sptpd.denda || 0) + (sptpd.bunga || 0) + (sptpd.kenaikan || 0) - (sptpd.kompensasi || 0) - (sptpd.setoran || 0);
                document.getElementById('bayarTotalBayar').textContent = 'Rp ' + formatNumber(total);
                
                // Show modal
                const modal = new bootstrap.Modal(document.getElementById('bayarSptpdModal'));
                modal.show();
            } else {
                alert('Error: ' + (data.message || 'Gagal memuat data SPTPD'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengambil data SPTPD');
        });
}

function konfirmasiBayar() {
    const form = document.getElementById('bayarSptpdForm');
    const formData = new FormData(form);
    const id = document.getElementById('bayarSptpdId').value;
    
    // Show loading
    const submitBtn = event.target;
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
    submitBtn.disabled = true;
    
    fetch(`/wp/sptpd/${id}/bayar`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Pembayaran berhasil dikonfirmasi! Status SPTPD diubah menjadi Lunas.');
            bootstrap.Modal.getInstance(document.getElementById('bayarSptpdModal')).hide();
            location.reload(); // Refresh halaman
        } else {
            alert('Error: ' + (data.message || 'Terjadi kesalahan'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses pembayaran');
    })
    .finally(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
}

function buktiBayar(id) {
    window.open(`/wp/sptpd/${id}/bukti-bayar`, '_blank');
}
</script>
@endsection
