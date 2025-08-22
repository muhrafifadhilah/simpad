@extends('layouts.app')

@section('content')
<style>
    /* Modern Form Styling */
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

    .modern-form-container {
        background: white;
        border-radius: var(--radius-lg);
        padding: 40px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--neutral-300);
    }

    .form-section {
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

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--neutral-700);
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid var(--neutral-300);
        border-radius: var(--radius-md);
        font-size: 1rem;
        transition: var(--transition);
        background-color: white;
        box-sizing: border-box;
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(0, 113, 45, 0.1);
    }

    .form-control:disabled {
        background-color: var(--neutral-100);
        color: var(--neutral-600);
        cursor: not-allowed;
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

    .input-icon {
        position: relative;
    }

    .input-icon i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--neutral-500);
        z-index: 2;
    }

    .input-icon .form-control,
    .input-icon .form-select {
        padding-left: 48px;
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

        .modern-form-container {
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
    }
</style>

<div class="modern-container">
    <!-- Modern Header -->
    <div class="modern-header">
        <h1 class="header-title">
            <i class="fas fa-edit me-3"></i>Edit SPTPD
        </h1>
        <p class="header-subtitle">Surat Pemberitahuan Pajak Daerah - Form Edit Data Sederhana</p>
    </div>

    <!-- Modern Form -->
    <div class="modern-form-container">
        <div class="info-badge">
            <i class="fas fa-info-circle"></i>
            ID SPTPD: {{ $sptpd->id }} | Dibuat: {{ $sptpd->created_at->format('d/m/Y H:i') }}
        </div>

        <form action="{{ route('sptpd.update', $sptpd) }}" method="POST" id="sptpdEditForm">
            @csrf 
            @method('PUT')
            
            <!-- Section 1: Informasi Dasar -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Informasi Dasar
                </h3>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">No. SPTPD</label>
                            <div class="input-icon">
                                <i class="fas fa-hashtag"></i>
                                <input type="text" class="form-control" value="ID: {{ $sptpd->id }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Tanggal Terima <span class="text-danger">*</span></label>
                            <div class="input-icon">
                                <i class="fas fa-calendar"></i>
                                <input type="date" name="tanggal_terima" class="form-control" value="{{ $sptpd->tanggal_terima }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Jatuh Tempo <span class="text-danger">*</span></label>
                            <div class="input-icon">
                                <i class="fas fa-calendar-check"></i>
                                <input type="date" name="jatuh_tempo" class="form-control" value="{{ $sptpd->jatuh_tempo }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Data Objek Pajak -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-building"></i>
                    Data Objek Pajak
                </h3>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">NOPD <span class="text-danger">*</span></label>
                            <div class="input-icon">
                                <i class="fas fa-id-card"></i>
                                <select name="objek_pajak_id" class="form-select" required id="objek_pajak_id">
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
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">NPWPD</label>
                            <div class="input-icon">
                                <i class="fas fa-certificate"></i>
                                <input type="text" id="npwpd" class="form-control" value="{{ $sptpd->objekPajak->subjekPajak->npwpd ?? '' }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Nama Wajib Pajak</label>
                            <div class="input-icon">
                                <i class="fas fa-user"></i>
                                <input type="text" id="nama_subjek" class="form-control" value="{{ $sptpd->objekPajak->subjekPajak->subjek_pajak ?? '' }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Jenis Pajak</label>
                            <div class="input-icon">
                                <i class="fas fa-tags"></i>
                                <input type="text" id="jenis_pajak" class="form-control" value="{{ $sptpd->objekPajak->jenis_pajak ?? '' }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Data Administrasi -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-cogs"></i>
                    Data Administrasi
                </h3>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">UPT <span class="text-danger">*</span></label>
                            <div class="input-icon">
                                <i class="fas fa-building-user"></i>
                                <select name="upt_id" class="form-select" required>
                                    <option value="">Pilih UPT</option>
                                    @foreach($upts as $upt)
                                        <option value="{{ $upt->id }}" @if($sptpd->upt_id == $upt->id) selected @endif>{{ $upt->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Masa Pajak Awal <span class="text-danger">*</span></label>
                            <div class="input-icon">
                                <i class="fas fa-calendar-week"></i>
                                <input type="date" name="masa_pajak_awal" class="form-control" value="{{ $sptpd->masa_pajak_awal }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Masa Pajak Akhir <span class="text-danger">*</span></label>
                            <div class="input-icon">
                                <i class="fas fa-calendar-week"></i>
                                <input type="date" name="masa_pajak_akhir" class="form-control" value="{{ $sptpd->masa_pajak_akhir }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 4: Data Pajak -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-money-bill-wave"></i>
                    Informasi Pajak
                </h3>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="form-label">Total Pajak yang Harus Dibayarkan <span class="text-danger">*</span></label>
                            <div class="input-icon">
                                <i class="fas fa-money-bill-wave"></i>
                                <input type="number" name="total_pajak_terutang" class="form-control" value="{{ $sptpd->total_pajak_terutang }}" step="1" min="0" required id="totalPajak">
                            </div>
                            <div id="previewPajak" class="mt-2 text-muted"></div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Keterangan (Opsional)</label>
                            <div class="input-icon">
                                <i class="fas fa-comment"></i>
                                <textarea name="keterangan" class="form-control" rows="4" style="padding-left: 48px; resize: vertical;" placeholder="Masukkan keterangan tambahan jika diperlukan...">{{ $sptpd->keterangan }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="btn-group">
                <a href="{{ route('sptpd.index') }}" class="btn-modern btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button type="submit" class="btn-modern btn-primary">
                    <i class="fas fa-save"></i>
                    Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Auto-fill data when NOPD is selected
        $('#objek_pajak_id').change(function() {
            var selectedOption = $(this).find('option:selected');
            $('#npwpd').val(selectedOption.data('npwpd'));
            $('#nama_subjek').val(selectedOption.data('nama'));
            $('#jenis_pajak').val(selectedOption.data('jenis'));
        });

        // Format currency preview for total pajak
        function updatePreviewPajak() {
            const totalPajak = document.getElementById('totalPajak').value;
            const previewElement = document.getElementById('previewPajak');
            
            if (totalPajak && !isNaN(totalPajak)) {
                const formatted = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(totalPajak);
                
                previewElement.innerHTML = `<i class="fas fa-eye me-2"></i>Preview: <strong>${formatted}</strong>`;
                previewElement.className = 'mt-2 text-success';
            } else {
                previewElement.innerHTML = '<i class="fas fa-info-circle me-2"></i>Masukkan nominal untuk melihat preview';
                previewElement.className = 'mt-2 text-muted';
            }
        }

        // Initialize preview and bind event
        $('#totalPajak').on('input', updatePreviewPajak);
        updatePreviewPajak(); // Initial call

        // Form submission with SweetAlert
        $('#sptpdEditForm').on('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Konfirmasi Update',
                text: 'Apakah perubahan data SPTPD sudah benar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Update!',
                cancelButtonText: 'Cek Kembali',
                confirmButtonColor: '#00712D',
                cancelButtonColor: '#6c757d',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Mengupdate...',
                        text: 'Sedang menyimpan perubahan data SPTPD',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Submit form
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data SPTPD berhasil diupdate',
                                icon: 'success',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#00712D',
                                timer: 2000,
                                timerProgressBar: true
                            }).then(() => {
                                window.location.href = "{{ route('sptpd.index') }}";
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = 'Terjadi kesalahan saat mengupdate data';
                            
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                let errors = xhr.responseJSON.errors;
                                errorMessage = Object.values(errors).flat().join(', ');
                            }
                            
                            Swal.fire({
                                title: 'Gagal!',
                                text: errorMessage,
                                icon: 'error',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#dc2626'
                            });
                        }
                    });
                }
            });
        });
    });
</script>

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#dc2626'
        });
    });
</script>
@endif
@endsection
