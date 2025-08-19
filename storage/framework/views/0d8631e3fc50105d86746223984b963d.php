<?php $__env->startSection('content'); ?>
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
            <i class="fas fa-plus-circle me-3"></i>Tambah SPTPD
        </h1>
        <p class="header-subtitle">Surat Pemberitahuan Pajak Daerah - Form Tambah Data</p>
    </div>

    <!-- Modern Form -->
    <div class="modern-form-container">
        <form action="<?php echo e(route('sptpd.store')); ?>" method="POST" id="sptpdForm">
            <?php echo csrf_field(); ?>
            
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
                                <input type="text" class="form-control" value="Auto Generate" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Tanggal Terima</label>
                            <div class="input-icon">
                                <i class="fas fa-calendar"></i>
                                <input type="date" name="tanggal_terima" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Jatuh Tempo</label>
                            <div class="input-icon">
                                <i class="fas fa-calendar-check"></i>
                                <input type="date" name="jatuh_tempo" class="form-control" required>
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
                            <label class="form-label">NOPD</label>
                            <div class="input-icon">
                                <i class="fas fa-id-card"></i>
                                <select name="objek_pajak_id" class="form-select" required id="objek_pajak_id">
                                    <option value="">Pilih NOPD</option>
                                    <?php $__currentLoopData = $objekPajaks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $objek): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($objek->id); ?>"
                                            data-npwpd="<?php echo e($objek->subjekPajak->npwpd ?? ''); ?>"
                                            data-nama="<?php echo e($objek->subjekPajak->subjek_pajak ?? ''); ?>"
                                            data-jenis="<?php echo e($objek->jenis_pajak ?? ''); ?>">
                                            <?php echo e($objek->nopd); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">NPWPD</label>
                            <div class="input-icon">
                                <i class="fas fa-certificate"></i>
                                <input type="text" id="npwpd" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Subjek Pajak</label>
                            <div class="input-icon">
                                <i class="fas fa-user"></i>
                                <input type="text" id="nama_pajak" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Jenis Pajak</label>
                            <div class="input-icon">
                                <i class="fas fa-tags"></i>
                                <input type="text" id="jenis_pajak" class="form-control" disabled>
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
                            <label class="form-label">UPT</label>
                            <div class="input-icon">
                                <i class="fas fa-building-user"></i>
                                <select name="upt_id" class="form-select" required>
                                    <option value="">Pilih UPT</option>
                                    <?php $__currentLoopData = $upts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($upt->id); ?>"><?php echo e($upt->nama); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Masa Pajak Awal</label>
                            <div class="input-icon">
                                <i class="fas fa-calendar-week"></i>
                                <input type="date" name="masa_pajak_awal" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Masa Pajak Akhir</label>
                            <div class="input-icon">
                                <i class="fas fa-calendar-week"></i>
                                <input type="date" name="masa_pajak_akhir" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 4: Data Keuangan -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-calculator"></i>
                    Data Keuangan & Perhitungan
                </h3>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Dasar Pengenaan Pajak</label>
                            <div class="input-icon">
                                <i class="fas fa-money-bill-wave"></i>
                                <input type="number" name="dasar_pengenaan" class="form-control" step="0.01" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Tarif (%)</label>
                            <div class="input-icon">
                                <i class="fas fa-percentage"></i>
                                <input type="number" name="tarif" class="form-control" value="0" step="0.001">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Omset/Tapping Box</label>
                            <div class="input-icon">
                                <i class="fas fa-chart-line"></i>
                                <input type="number" name="omset_tapping_box" class="form-control" step="0.01" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Jumlah Pajak Terutang</label>
                            <div class="input-icon">
                                <i class="fas fa-receipt"></i>
                                <input type="number" name="pajak_terutang" class="form-control" step="0.01" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Denda</label>
                            <div class="input-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                                <input type="number" name="denda" class="form-control" value="0" step="0.01">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Bunga</label>
                            <div class="input-icon">
                                <i class="fas fa-percentage"></i>
                                <input type="number" name="bunga" class="form-control" value="0" step="0.01">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Setoran</label>
                            <div class="input-icon">
                                <i class="fas fa-coins"></i>
                                <input type="number" name="setoran" class="form-control" value="0" step="0.01">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Kenaikan</label>
                            <div class="input-icon">
                                <i class="fas fa-arrow-up"></i>
                                <input type="number" name="kenaikan" class="form-control" value="0" step="0.01">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Kompensasi</label>
                            <div class="input-icon">
                                <i class="fas fa-balance-scale"></i>
                                <input type="number" name="kompensasi" class="form-control" value="0" step="0.01">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Lain-lain</label>
                            <div class="input-icon">
                                <i class="fas fa-ellipsis-h"></i>
                                <input type="number" name="lain_lain" class="form-control" value="0" step="0.01">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="btn-group">
                <a href="<?php echo e(route('sptpd.index')); ?>" class="btn-modern btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button type="submit" class="btn-modern btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Auto-fill data when NOPD is selected
        $('#objek_pajak_id').change(function() {
            var selectedOption = $(this).find('option:selected');
            $('#npwpd').val(selectedOption.data('npwpd'));
            $('#nama_pajak').val(selectedOption.data('nama'));
            $('#jenis_pajak').val(selectedOption.data('jenis'));
        });

        // Form submission with SweetAlert
        $('#sptpdForm').on('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Konfirmasi Simpan',
                text: 'Apakah data SPTPD yang diinput sudah benar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Cek Kembali',
                confirmButtonColor: '#00712D',
                cancelButtonColor: '#6c757d',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Sedang menyimpan data SPTPD',
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
                                text: 'Data SPTPD berhasil disimpan',
                                icon: 'success',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#00712D',
                                timer: 2000,
                                timerProgressBar: true
                            }).then(() => {
                                window.location.href = "<?php echo e(route('sptpd.index')); ?>";
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = 'Terjadi kesalahan saat menyimpan data';
                            
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

        // Format currency input
        $('input[name="dasar_pengenaan"], input[name="tarif"], input[name="omset_tapping_box"], input[name="pajak_terutang"], input[name="denda"], input[name="bunga"], input[name="setoran"], input[name="kenaikan"], input[name="kompensasi"], input[name="lain_lain"]').on('input', function() {
            // Allow decimal input for financial fields
            let value = this.value;
            if (value && !isNaN(value)) {
                // Format for display but keep actual value
                $(this).attr('data-original', value);
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpad new\simpad\resources\views/sptpd/create.blade.php ENDPATH**/ ?>