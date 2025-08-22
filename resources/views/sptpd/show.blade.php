@extends('layouts.app')

@section('content')
<style>
    /* Modern Detail View Styling */
    :root {
        --primary-green: #00712D;
        --primary-orange: #FF6600;
        --secondary-green: #D5ED9F;
        --accent-green: #4CAF50;
        --neutral-100: #FFFBE6;
        --neutral-200: #F8F9FA;
        --neutral-300: #E9ECEF;
        --neutral-400: #DEE2E6;
        --neutral-500: #ADB5BD;
        --neutral-600: #6C757D;
        --neutral-700: #495057;
        --neutral-800: #343A40;
        --neutral-900: #212529;
        --shadow-sm: 0 2px 4px rgba(0,0,0,0.06);
        --shadow-md: 0 4px 8px rgba(0,0,0,0.12);
        --shadow-lg: 0 8px 16px rgba(0,0,0,0.15);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modern-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 24px;
        background-color: var(--neutral-200);
        min-height: 100vh;
    }

    .modern-header {
        background: linear-gradient(135deg, var(--secondary-green) 0%, #E8F5E8 100%);
        border-radius: var(--radius-lg);
        padding: 32px;
        margin-bottom: 32px;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(0, 113, 45, 0.1);
    }

    .header-title {
        color: var(--primary-green);
        font-size: 2.25rem;
        font-weight: 800;
        margin: 0 0 8px 0;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        letter-spacing: -0.025em;
    }

    .header-subtitle {
        color: var(--neutral-700);
        font-size: 1.1rem;
        margin: 0;
        font-weight: 500;
        opacity: 0.9;
    }

    .detail-container {
        background: white;
        border-radius: var(--radius-lg);
        padding: 40px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--neutral-300);
    }

    .detail-section {
        margin-bottom: 32px;
    }

    .section-title {
        color: var(--primary-green);
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--secondary-green);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
    }

    .detail-item {
        padding: 16px;
        border: 1px solid var(--neutral-300);
        border-radius: var(--radius-md);
        background: var(--neutral-100);
    }

    .detail-label {
        font-weight: 600;
        color: var(--neutral-700);
        font-size: 0.9rem;
        margin-bottom: 8px;
        display: block;
    }

    .detail-value {
        color: var(--neutral-900);
        font-size: 1rem;
        font-weight: 500;
    }

    .highlight-value {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
        color: white;
        padding: 12px 16px;
        border-radius: var(--radius-md);
        font-size: 1.25rem;
        font-weight: 700;
        text-align: center;
        box-shadow: var(--shadow-sm);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 0.9rem;
    }

    .status-draft {
        background: linear-gradient(135deg, #FFA500 0%, #FF8C00 100%);
        color: white;
    }

    .status-final {
        background: linear-gradient(135deg, var(--accent-green) 0%, var(--primary-green) 100%);
        color: white;
    }

    .btn-group {
        display: flex;
        gap: 16px;
        justify-content: flex-end;
        margin-top: 40px;
        padding-top: 24px;
        border-top: 1px solid var(--neutral-300);
    }

    .btn-modern {
        padding: 14px 32px;
        border: none;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 140px;
        justify-content: center;
        text-decoration: none;
        box-shadow: var(--shadow-sm);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--accent-green) 0%, var(--primary-green) 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-secondary {
        background: linear-gradient(135deg, var(--neutral-500) 0%, var(--neutral-600) 100%);
        color: white;
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, var(--neutral-600) 0%, var(--neutral-700) 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: white;
        text-decoration: none;
    }

    .btn-warning {
        background: linear-gradient(135deg, var(--primary-orange) 0%, #FF8A33 100%);
        color: white;
    }

    .btn-warning:hover {
        background: linear-gradient(135deg, #FF8A33 0%, var(--primary-orange) 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: white;
        text-decoration: none;
    }

    .info-badge {
        background: linear-gradient(135deg, var(--primary-orange) 0%, #FF8A33 100%);
        color: white;
        padding: 8px 16px;
        border-radius: var(--radius-md);
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .modern-container {
            padding: 16px;
        }

        .detail-container {
            padding: 24px;
        }

        .header-title {
            font-size: 1.75rem;
        }

        .btn-group {
            flex-direction: column;
        }

        .btn-modern {
            width: 100%;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="modern-container">
    <!-- Modern Header -->
    <div class="modern-header">
        <h1 class="header-title">
            <i class="fas fa-eye me-3"></i>Detail SPTPD
        </h1>
        <p class="header-subtitle">Surat Pemberitahuan Pajak Daerah - Informasi Lengkap</p>
    </div>

    <!-- Detail Container -->
    <div class="detail-container">
        <div class="info-badge">
            <i class="fas fa-info-circle"></i>
            ID SPTPD: {{ $sptpd->id }} | Dibuat: {{ $sptpd->created_at->format('d/m/Y H:i') }}
        </div>

        <!-- Section 1: Informasi Dasar -->
        <div class="detail-section">
            <h3 class="section-title">
                <i class="fas fa-info-circle"></i>
                Informasi Dasar
            </h3>
            
            <div class="detail-grid">
                <div class="detail-item">
                    <label class="detail-label">No. SPTPD</label>
                    <div class="detail-value">{{ $sptpd->id }}</div>
                </div>
                
                <div class="detail-item">
                    <label class="detail-label">Status</label>
                    <div class="detail-value">
                        <span class="status-badge {{ $sptpd->status === 'Draft' ? 'status-draft' : 'status-final' }}">
                            <i class="fas {{ $sptpd->status === 'Draft' ? 'fa-edit' : 'fa-check-circle' }}"></i>
                            {{ $sptpd->status }}
                        </span>
                    </div>
                </div>
                
                <div class="detail-item">
                    <label class="detail-label">Tanggal Terima</label>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($sptpd->tanggal_terima)->format('d F Y') }}</div>
                </div>
                
                <div class="detail-item">
                    <label class="detail-label">Jatuh Tempo</label>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($sptpd->jatuh_tempo)->format('d F Y') }}</div>
                </div>
            </div>
        </div>

        <!-- Section 2: Data Objek Pajak -->
        <div class="detail-section">
            <h3 class="section-title">
                <i class="fas fa-building"></i>
                Data Objek Pajak
            </h3>
            
            <div class="detail-grid">
                <div class="detail-item">
                    <label class="detail-label">NOPD (Nomor Objek Pajak Daerah)</label>
                    <div class="detail-value">{{ $sptpd->objekPajak->nopd ?? '-' }}</div>
                </div>
                
                <div class="detail-item">
                    <label class="detail-label">NPWPD (Nomor Pokok Wajib Pajak Daerah)</label>
                    <div class="detail-value">{{ $sptpd->objekPajak->subjekPajak->npwpd ?? '-' }}</div>
                </div>
                
                <div class="detail-item">
                    <label class="detail-label">Nama Wajib Pajak</label>
                    <div class="detail-value">{{ $sptpd->objekPajak->subjekPajak->subjek_pajak ?? '-' }}</div>
                </div>
                
                <div class="detail-item">
                    <label class="detail-label">Jenis Pajak</label>
                    <div class="detail-value">{{ $sptpd->objekPajak->jenis_pajak ?? '-' }}</div>
                </div>
                
                <div class="detail-item">
                    <label class="detail-label">Alamat Objek</label>
                    <div class="detail-value">{{ $sptpd->objekPajak->alamat ?? '-' }}</div>
                </div>
                
                <div class="detail-item">
                    <label class="detail-label">Kecamatan</label>
                    <div class="detail-value">{{ $sptpd->objekPajak->kecamatan ?? '-' }}</div>
                </div>
                
                <div class="detail-item">
                    <label class="detail-label">Kelurahan</label>
                    <div class="detail-value">{{ $sptpd->objekPajak->kelurahan ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Section 3: Data Administrasi -->
        <div class="detail-section">
            <h3 class="section-title">
                <i class="fas fa-cogs"></i>
                Data Administrasi
            </h3>
            
            <div class="detail-grid">
                <div class="detail-item">
                    <label class="detail-label">UPT (Unit Pelaksana Teknis)</label>
                    <div class="detail-value">{{ $sptpd->upt->nama ?? '-' }}</div>
                </div>
                
                <div class="detail-item">
                    <label class="detail-label">Masa Pajak Awal</label>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($sptpd->masa_pajak_awal)->format('d F Y') }}</div>
                </div>
                
                <div class="detail-item">
                    <label class="detail-label">Masa Pajak Akhir</label>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($sptpd->masa_pajak_akhir)->format('d F Y') }}</div>
                </div>
                
                <div class="detail-item">
                    <label class="detail-label">Periode Pajak</label>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($sptpd->masa_pajak_awal)->format('F Y') }}</div>
                </div>
            </div>
        </div>

        <!-- Section 4: Informasi Pajak -->
        <div class="detail-section">
            <h3 class="section-title">
                <i class="fas fa-money-bill-wave"></i>
                Informasi Pajak
            </h3>
            
            <div class="detail-grid">
                <div class="detail-item" style="grid-column: 1 / -1;">
                    <label class="detail-label">Total Pajak yang Harus Dibayarkan</label>
                    <div class="highlight-value">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        {{ 'Rp ' . number_format($sptpd->total_pajak_terutang ?? 0, 0, ',', '.') }}
                    </div>
                </div>
                
                @if($sptpd->keterangan)
                <div class="detail-item" style="grid-column: 1 / -1;">
                    <label class="detail-label">Keterangan</label>
                    <div class="detail-value">{{ $sptpd->keterangan }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="btn-group">
            <a href="{{ route('sptpd.index') }}" class="btn-modern btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
            <a href="{{ route('sptpd.edit', $sptpd) }}" class="btn-modern btn-warning">
                <i class="fas fa-edit"></i>
                Edit Data
            </a>
            <button onclick="window.print()" class="btn-modern btn-primary">
                <i class="fas fa-print"></i>
                Cetak
            </button>
        </div>
    </div>
</div>

<style media="print">
    .btn-group, .modern-header {
        display: none !important;
    }
    
    .modern-container {
        padding: 0 !important;
        background: white !important;
    }
    
    .detail-container {
        box-shadow: none !important;
        border: none !important;
        padding: 20px !important;
    }
    
    .info-badge {
        background: #333 !important;
        color: white !important;
        -webkit-print-color-adjust: exact;
    }
</style>
@endsection
