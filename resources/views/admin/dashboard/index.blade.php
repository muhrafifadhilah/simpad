@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="modern-header d-flex justify-content-between p-4 align-items-center mb-5">
                    <div class="header-content">
                        <div class="header-left d-flex align-items-center">
                            <button class="sidebar-toggle-btn me-3" id="sidebarToggle">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div>
                                <h2 class="header-title">Executive Summary</h2>
                                <p class="header-subtitle">Dashboard Pajak Daerah - Tahun 2025</p>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user())
                        <div class="user-profile-modern dropdown">
                            <div class="profile-container" data-bs-toggle="dropdown">
                                <div class="profile-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="profile-info">
                                    <span class="profile-name">{{ Auth::user()->userid }}</span>
                                    @if(Auth::user()->role)
                                        <small class="profile-role">{{ ucfirst(Auth::user()->role->name) }}</small>
                                    @endif
                                </div>
                                <i class="fas fa-chevron-down profile-dropdown-icon"></i>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end modern-dropdown">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- MODERN FILTER CONTROLS --}}
                <div class="modern-controls-container mb-4">
                    <div class="controls-grid">
                        <div class="control-group">
                            <label for="filterUpt" class="modern-label">
                                <i class="fas fa-building me-2"></i>Filter UPT
                            </label>
                            <select id="filterUpt" class="modern-select">
                                <option value="">Semua UPT</option>
                                @foreach($uptList as $upt)
                                    <option value="{{ $upt->id }}">{{ $upt->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="control-group">
                            <label for="searchBox" class="modern-label">
                                <i class="fas fa-search me-2"></i>Cari Jenis Pajak
                            </label>
                            <div class="search-input-container">
                                <input type="text" id="searchBox" class="modern-search" placeholder="Ketik untuk mencari...">
                                <i class="fas fa-search search-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END MODERN FILTER CONTROLS --}}

                {{-- MODERN MAIN DASHBOARD CARDS --}}
                <div class="dashboard-grid mb-4">
                    <div class="main-card tax-summary-card">
                        <div class="card-header-modern">
                            <div class="card-title-section">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-bar me-2"></i>
                                    Tabulasi Penerimaan Pajak Daerah
                                </h3>
                                <p class="card-subtitle">Tahun 2025</p>
                            </div>
                            <div class="view-toggle-modern">
                                <button id="showTableButton" class="toggle-btn active" data-tooltip="Tampilan Tabel">
                                    <i class="fas fa-table"></i>
                                </button>
                                <button id="showChartButton" class="toggle-btn" data-tooltip="Tampilan Grafik">
                                    <i class="fas fa-chart-bar"></i>
                                </button>
                            </div>
                        </div>
    
                        <div id="tableContainer" class="modern-table-container">
                            <div class="table-wrapper">
                                <table class="modern-table">
                                    <thead>
                                        <tr>
                                            <th class="text-start">
                                                <div class="th-content">
                                                    <i class="fas fa-receipt me-2"></i>Jenis Pajak
                                                </div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">
                                                    <i class="fas fa-bullseye me-2"></i>Target (Rp.)
                                                </div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">
                                                    <i class="fas fa-coins me-2"></i>Realisasi (Rp.)
                                                </div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">
                                                    <i class="fas fa-percentage me-2"></i>Progress (%)
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($taxData as $tax)
                                        @php
                                            $persen = ($tax['targetAnggaran'] > 0) ? ($tax['realisasi'] / $tax['targetAnggaran']) * 100 : 0;
                                            $rowClass = $persen > 100 ? 'success-row' : '';
                                        @endphp
                                        <tr class="{{ $rowClass }}">
                                            <td class="text-start">
                                                <div class="tax-name">{{ $tax['jenisPajak'] }}</div>
                                            </td>
                                            <td class="text-end">
                                                <div class="amount">{{ number_format($tax['targetAnggaran'], 0, ',', '.') }}</div>
                                            </td>
                                            <td class="text-end">
                                                <div class="amount">{{ number_format($tax['realisasi'], 0, ',', '.') }}</div>
                                            </td>
                                            <td class="text-end">
                                                <div class="progress-container">
                                                    <span class="progress-text">{{ number_format($persen, 2) }}%</span>
                                                    <div class="mini-progress">
                                                        <div class="progress-fill" style="width: {{ min($persen, 100) }}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                        <tr class="total-row">
                                            <td class="text-start">
                                                <div class="total-label">
                                                    <i class="fas fa-calculator me-2"></i>Total
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="total-amount">{{ number_format(array_sum(array_column($taxData, 'targetAnggaran')), 0, ',', '.') }}</div>
                                            </td>
                                            <td class="text-end">
                                                <div class="total-amount">{{ number_format(array_sum(array_column($taxData, 'realisasi')), 0, ',', '.') }}</div>
                                            </td>
                                            <td class="text-end">
                                                <div class="total-percentage">{{ number_format((array_sum(array_column($taxData, 'realisasi')) / array_sum(array_column($taxData, 'targetAnggaran'))) * 100, 2) }}%</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div id="chartContainer" style="display: none;" class="chart-container">
                            <canvas id="combinedChart"></canvas>
                        </div>
                    </div>

                    <div class="summary-card total-revenue-card">
                        <div class="summary-content">
                            <div class="summary-header">
                                <h3 class="summary-title">
                                    <i class="fas fa-money-bill-wave me-2"></i>
                                    Total Penerimaan
                                </h3>
                                <p class="summary-subtitle">Tahun 2025</p>
                            </div>
                            
                            <!-- Logo Area - Full Width -->
                            <div class="revenue-logo-area">
                                <img src="/assets/img/semut.svg" alt="Logo Bapenda" class="revenue-logo-full">
                            </div>
                            
                            <!-- Revenue Amount -->
                            <div class="revenue-amount-section">
                                <div class="revenue-amount">
                                    Rp.{{ number_format(array_sum(array_column($taxData, 'realisasi')), 0, ',', '.') }}
                                </div>
                            </div>
                            
                            <!-- Progress Section - Bottom -->
                            <div class="revenue-progress-section">
                                <div class="progress-info">
                                    <span class="progress-label">Progress:</span>
                                    <span class="progress-value">{{ number_format((array_sum(array_column($taxData, 'realisasi')) / array_sum(array_column($taxData, 'targetAnggaran'))) * 100, 2) }}%</span>
                                </div>
                                <div class="progress-bar-modern">
                                    <div class="progress-fill-modern" style="width: {{ (array_sum(array_column($taxData, 'realisasi')) / array_sum(array_column($taxData, 'targetAnggaran'))) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END MODERN MAIN DASHBOARD CARDS --}}

                {{-- MODERN COMPARISON SECTION --}}
                <div class="comparison-section mb-4">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="fas fa-chart-line me-2"></i>
                            Perbandingan Realisasi Tahun Pajak
                        </h3>
                        <p class="section-subtitle">Tahun 2025 vs 2024</p>
                    </div>
                    
                    <div class="comparison-grid">
                        @foreach($taxData as $tax)
                            <div class="comparison-card">
                                <div class="card-icon">
                                    <img src="{{ $tax['img'] }}" alt="{{ $tax['jenisPajak'] }}" class="tax-icon">
                                </div>
                                
                                <div class="card-content">
                                    <h4 class="tax-title">{{ $tax['jenisPajak'] }}</h4>
                                    
                                    <div class="comparison-stats">
                                        <div class="stat-item current-year">
                                            <span class="year-label">2025</span>
                                            <span class="amount-value">Rp {{ number_format($tax['realisasi'], 0, ',', '.') }}</span>
                                        </div>
                                        
                                        <div class="stat-item previous-year">
                                            <span class="year-label">2024</span>
                                            <span class="amount-value">Rp {{ number_format($tax['tahunLalu'], 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="card-actions">
                                        <button class="detail-btn btn-detail-sptpd" data-jenis="{{ $tax['jenisPajak'] }}">
                                            <i class="fas fa-eye me-1"></i>
                                            Lihat Detail
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- END MODERN COMPARISON SECTION --}}

                {{-- MODERN MONTHLY TABLE --}}
                <div class="monthly-table-section">
                    <div class="main-card">
                        <div class="card-header-modern">
                            <div class="card-title-section">
                                <h3 class="card-title">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    Tabulasi Penerimaan Pajak Per Bulan
                                </h3>
                                <p class="card-subtitle">Tahun 2025 - Breakdown Triwulan</p>
                            </div>
                            <div class="view-toggle-modern">
                                <button id="showTableButton2" class="toggle-btn active" data-tooltip="Tampilan Tabel">
                                    <i class="fas fa-table"></i>
                                </button>
                                <button id="showChartButton2" class="toggle-btn" data-tooltip="Tampilan Grafik">
                                    <i class="fas fa-chart-line"></i>
                                </button>
                            </div>
                        </div>

                        <div id="tableContainer2" class="modern-table-container">
                            <div class="table-wrapper" style="overflow-x: auto;">
                                <table class="modern-table monthly-table">
                                    <thead>
                                        <tr>
                                            <th class="text-start sticky-col">
                                                <div class="th-content">
                                                    <i class="fas fa-receipt me-2"></i>Jenis Pajak
                                                </div>
                                            </th>
                                            <th class="text-end quarter-header">
                                                <div class="th-content">
                                                    <i class="fas fa-bullseye me-2"></i>Target TW 1
                                                </div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">Januari</div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">Februari</div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">Maret</div>
                                            </th>
                                            <th class="text-end quarter-result">
                                                <div class="th-content">
                                                    <i class="fas fa-percentage me-2"></i>Real TW 1
                                                </div>
                                            </th>
                                            <th class="text-end quarter-header">
                                                <div class="th-content">
                                                    <i class="fas fa-bullseye me-2"></i>Target TW 2
                                                </div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">April</div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">Mei</div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">Juni</div>
                                            </th>
                                            <th class="text-end quarter-result">
                                                <div class="th-content">
                                                    <i class="fas fa-percentage me-2"></i>Real TW 2
                                                </div>
                                            </th>
                                            <th class="text-end quarter-header">
                                                <div class="th-content">
                                                    <i class="fas fa-bullseye me-2"></i>Target TW 3
                                                </div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">Juli</div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">Agustus</div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">September</div>
                                            </th>
                                            <th class="text-end quarter-result">
                                                <div class="th-content">
                                                    <i class="fas fa-percentage me-2"></i>Real TW 3
                                                </div>
                                            </th>
                                            <th class="text-end quarter-header">
                                                <div class="th-content">
                                                    <i class="fas fa-bullseye me-2"></i>Target TW 4
                                                </div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">Oktober</div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">November</div>
                                            </th>
                                            <th class="text-end">
                                                <div class="th-content">Desember</div>
                                            </th>
                                            <th class="text-end quarter-result">
                                                <div class="th-content">
                                                    <i class="fas fa-percentage me-2"></i>Real TW 4
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($taxData2 as $tax)
                                            <tr>
                                                <td class="text-start sticky-col">
                                                    <div class="tax-name">{{ $tax['jenisPajak'] }}</div>
                                                </td>
                                                <td class="text-end quarter-target">
                                                    <div class="amount">{{ number_format($tax['targetTW1'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="amount">{{ number_format($tax['januari'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="amount">{{ number_format($tax['februari'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="amount">{{ number_format($tax['maret'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end quarter-percentage">
                                                    <div class="percentage">{{ number_format((($tax['januari'] + $tax['februari'] + $tax['maret']) / $tax['targetTW1']) * 100, 2) }}%</div>
                                                </td>
                                                <td class="text-end quarter-target">
                                                    <div class="amount">{{ number_format($tax['targetTW2'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="amount">{{ number_format($tax['april'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="amount">{{ number_format($tax['mei'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="amount">{{ number_format($tax['juni'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end quarter-percentage">
                                                    <div class="percentage">{{ number_format((($tax['april'] + $tax['mei'] + $tax['juni']) / $tax['targetTW2']) * 100, 2) }}%</div>
                                                </td>
                                                <td class="text-end quarter-target">
                                                    <div class="amount">{{ number_format($tax['targetTW3'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="amount">{{ number_format($tax['juli'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="amount">{{ number_format($tax['agustus'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="amount">{{ number_format($tax['september'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end quarter-percentage">
                                                    <div class="percentage">{{ number_format((($tax['juli'] + $tax['agustus'] + $tax['september']) / $tax['targetTW3']) * 100, 2) }}%</div>
                                                </td>
                                                <td class="text-end quarter-target">
                                                    <div class="amount">{{ number_format($tax['targetTW4'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="amount">{{ number_format($tax['oktober'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="amount">{{ number_format($tax['november'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="amount">{{ number_format($tax['desember'], 0, ',', '.') }}</div>
                                                </td>
                                                <td class="text-end quarter-percentage">
                                                    <div class="percentage">{{ number_format((($tax['oktober'] + $tax['november'] + $tax['desember']) / $tax['targetTW4']) * 100, 2) }}%</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="total-row">
                                            <td class="text-start sticky-col">
                                                <div class="total-label">
                                                    <i class="fas fa-calculator me-2"></i>Total
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'targetTW1')), 0, ',', '.') }}</div>
                                            </td>
                                            <td class="text-end">
                                                <div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'januari')), 0, ',', '.') }}</div>
                                            </td>
                                            <td class="text-end">
                                                <div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'februari')), 0, ',', '.') }}</div>
                                            </td>
                                            <td class="text-end">
                                                <div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'maret')), 0, ',', '.') }}</div>
                                            </td>
                                            <td class="text-end">
                                                <div class="total-percentage">
                                                    @php
                                                        $totalTargetTW1 = array_sum(array_column($taxData2, 'targetTW1'));
                                                        $totalRealisasiTW1 = array_sum(array_column($taxData2, 'januari')) + array_sum(array_column($taxData2, 'februari')) + array_sum(array_column($taxData2, 'maret'));
                                                    @endphp
                                                    {{ $totalTargetTW1 > 0 ? number_format(($totalRealisasiTW1 / $totalTargetTW1) * 100, 2) . '%' : '0%' }}
                                                </div>
                                            </td>
                                            <!-- Continue with other quarters... -->
                                            <td class="text-end"><div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'targetTW2')), 0, ',', '.') }}</div></td>
                                            <td class="text-end"><div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'april')), 0, ',', '.') }}</div></td>
                                            <td class="text-end"><div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'mei')), 0, ',', '.') }}</div></td>
                                            <td class="text-end"><div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'juni')), 0, ',', '.') }}</div></td>
                                            <td class="text-end"><div class="total-percentage">
                                                @php
                                                    $totalTargetTW2 = array_sum(array_column($taxData2, 'targetTW2'));
                                                    $totalRealisasiTW2 = array_sum(array_column($taxData2, 'april')) + array_sum(array_column($taxData2, 'mei')) + array_sum(array_column($taxData2, 'juni'));
                                                @endphp
                                                {{ $totalTargetTW2 > 0 ? number_format(($totalRealisasiTW2 / $totalTargetTW2) * 100, 2) . '%' : '0%' }}
                                            </div></td>
                                            <td class="text-end"><div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'targetTW3')), 0, ',', '.') }}</div></td>
                                            <td class="text-end"><div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'juli')), 0, ',', '.') }}</div></td>
                                            <td class="text-end"><div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'agustus')), 0, ',', '.') }}</div></td>
                                            <td class="text-end"><div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'september')), 0, ',', '.') }}</div></td>
                                            <td class="text-end"><div class="total-percentage">
                                                @php
                                                    $totalTargetTW3 = array_sum(array_column($taxData2, 'targetTW3'));
                                                    $totalRealisasiTW3 = array_sum(array_column($taxData2, 'juli')) + array_sum(array_column($taxData2, 'agustus')) + array_sum(array_column($taxData2, 'september'));
                                                @endphp
                                                {{ $totalTargetTW3 > 0 ? number_format(($totalRealisasiTW3 / $totalTargetTW3) * 100, 2) . '%' : '0%' }}
                                            </div></td>
                                            <td class="text-end"><div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'targetTW4')), 0, ',', '.') }}</div></td>
                                            <td class="text-end"><div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'oktober')), 0, ',', '.') }}</div></td>
                                            <td class="text-end"><div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'november')), 0, ',', '.') }}</div></td>
                                            <td class="text-end"><div class="total-amount">{{ number_format(array_sum(array_column($taxData2, 'desember')), 0, ',', '.') }}</div></td>
                                            <td class="text-end"><div class="total-percentage">
                                                @php
                                                    $totalTargetTW4 = array_sum(array_column($taxData2, 'targetTW4'));
                                                    $totalRealisasiTW4 = array_sum(array_column($taxData2, 'oktober')) + array_sum(array_column($taxData2, 'november')) + array_sum(array_column($taxData2, 'desember'));
                                                @endphp
                                                {{ $totalTargetTW4 > 0 ? number_format(($totalRealisasiTW4 / $totalTargetTW4) * 100, 2) . '%' : '0%' }}
                                            </div></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div id="chartContainer2" style="display: none;" class="chart-container">
                            <canvas id="combinedChart2"></canvas>
                        </div>
                    </div>
                </div>
                {{-- END MODERN MONTHLY TABLE --}}
            </div>
        </div>
    </div>
    {{-- MODERN MODAL DETAIL SPTPD --}}
    <div class="modal fade" id="modalDetailSptpd" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content modern-modal">
                <div class="modal-header modern-modal-header">
                    <div class="modal-title-section">
                        <h5 class="modal-title">
                            <i class="fas fa-file-invoice me-2"></i>
                            Detail SPTPD: <span id="modalJenisPajak" class="tax-type-name"></span>
                        </h5>
                        <p class="modal-subtitle">Rincian data SPTPD berdasarkan jenis pajak</p>
                    </div>
                    <button type="button" class="btn-close modern-close-btn" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body modern-modal-body">
                    <div class="modern-table-container">
                        <div class="table-wrapper">
                            <table class="modern-table" id="tableDetailSptpd">
                                <thead>
                                    <tr>
                                        <th class="text-start">
                                            <div class="th-content">
                                                <i class="fas fa-hashtag me-2"></i>No SPTPD
                                            </div>
                                        </th>
                                        <th class="text-center">
                                            <div class="th-content">
                                                <i class="fas fa-calendar me-2"></i>Tanggal
                                            </div>
                                        </th>
                                        <th class="text-center">
                                            <div class="th-content">
                                                <i class="fas fa-id-card me-2"></i>NOPD
                                            </div>
                                        </th>
                                        <th class="text-start">
                                            <div class="th-content">
                                                <i class="fas fa-user-tie me-2"></i>Subjek Pajak
                                            </div>
                                        </th>
                                        <th class="text-center">
                                            <div class="th-content">
                                                <i class="fas fa-clock me-2"></i>Masa Pajak
                                            </div>
                                        </th>
                                        <th class="text-end">
                                            <div class="th-content">
                                                <i class="fas fa-calculator me-2"></i>Dasar
                                            </div>
                                        </th>
                                        <th class="text-end">
                                            <div class="th-content">
                                                <i class="fas fa-money-bill-wave me-2"></i>Pajak Terutang
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Data via JS --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modern-modal-footer">
                    <div class="footer-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <span>Total data akan ditampilkan setelah data dimuat</span>
                    </div>
                    <button type="button" class="btn btn-secondary modern-btn" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- END MODERN MODAL --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let allTaxData = @json($taxData);
        let allTaxData2 = @json($taxData2);
        let allSptpdByJenis = @json($sptpdByJenis ?? []);
        let taxData = allTaxData;
        let taxData2 = allTaxData2;
        let sptpdByJenis = allSptpdByJenis;

        function filterByUpt(uptId) {
            if (!uptId) {
                taxData = allTaxData;
                taxData2 = allTaxData2;
                sptpdByJenis = allSptpdByJenis;
            } else {
                taxData = allTaxData.map(function(item) {
                    let filtered = {...item};
                    filtered.realisasi = (item.realisasi_by_upt && item.realisasi_by_upt[uptId]) ? item.realisasi_by_upt[uptId] : 0;
                    return filtered;
                });
                taxData2 = allTaxData2.map(function(item) {
                    let filtered = {...item};
                    ['januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'].forEach(function(bulan) {
                        filtered[bulan] = (item[bulan+'_by_upt'] && item[bulan+'_by_upt'][uptId]) ? item[bulan+'_by_upt'][uptId] : 0;
                    });
                    return filtered;
                });
                sptpdByJenis = {};
                Object.keys(allSptpdByJenis).forEach(function(jenis) {
                    sptpdByJenis[jenis] = allSptpdByJenis[jenis].filter(function(row) {
                        return row.upt_id == uptId;
                    });
                });
            }
            renderTaxTable();
            renderChart();
        }

        $('#filterUpt').on('change', function() {
            filterByUpt($(this).val());
        });

        // Search functionality
        $('#searchBox').on('input', function() {
            const searchTerm = $(this).val().toLowerCase();
            filterData(searchTerm);
        });

        function filterData(searchTerm) {
            // Filter tabel pertama
            $('#tableContainer tbody tr').each(function() {
                const jenisPajak = $(this).find('td:first').text().toLowerCase();
                if (jenisPajak.includes(searchTerm) || searchTerm === '') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            // Filter tabel kedua
            $('#tableContainer2 tbody tr').each(function() {
                const jenisPajak = $(this).find('td:first').text().toLowerCase();
                if (jenisPajak.includes(searchTerm) || searchTerm === '') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            // Filter cards perbandingan
            $('.col-3').each(function() {
                const jenisPajak = $(this).find('span').eq(1).text().toLowerCase();
                if (jenisPajak.includes(searchTerm) || searchTerm === '') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        let combinedChart = null;

        function renderTaxTable() {
            const tbody = document.querySelector('#tableContainer tbody');
            tbody.innerHTML = '';
            let totalTarget = 0, totalRealisasi = 0;
            taxData.forEach(function(tax) {
                const persen = (tax.targetAnggaran > 0) ? (tax.realisasi / tax.targetAnggaran) * 100 : 0;
                const style = persen > 100 ? 'style="background-color:#00712D!important;color:white!important;"' : '';
                tbody.innerHTML += `
                    <tr>
                        <td ${style} style="text-align: left;${persen > 100 ? 'background-color:#00712D!important;color:white!important;' : ''}">${tax.jenisPajak}</td>
                        <td ${style} style="text-align: right;${persen > 100 ? 'background-color:#00712D!important;color:white!important;' : ''}">${Number(tax.targetAnggaran).toLocaleString('id-ID')}</td>
                        <td ${style} style="text-align: right;${persen > 100 ? 'background-color:#00712D!important;color:white!important;' : ''}">${Number(tax.realisasi).toLocaleString('id-ID')}</td>
                        <td ${style} style="text-align: right;${persen > 100 ? 'background-color:#00712D!important;color:white!important;' : ''}">${persen.toFixed(2)}%</td>
                    </tr>
                `;
                totalTarget += Number(tax.targetAnggaran);
                totalRealisasi += Number(tax.realisasi);
            });
            const totalPersen = totalTarget > 0 ? (totalRealisasi / totalTarget) * 100 : 0;
            tbody.innerHTML += `
                <tr>
                    <td style="font-weight: bold; color: #00712D; text-align: left;">Total</td>
                    <td style="font-weight: bold; color: #00712D; text-align: right;">${totalTarget.toLocaleString('id-ID')}</td>
                    <td style="font-weight: bold; color: #00712D; text-align: right;">${totalRealisasi.toLocaleString('id-ID')}</td>
                    <td style="font-weight: bold; color: #00712D; text-align: right;">${totalPersen.toFixed(2)}%</td>
                </tr>
            `;
            
            // Apply current search if exists
            const currentSearch = $('#searchBox').val();
            if (currentSearch) {
                filterData(currentSearch.toLowerCase());
            }
        }

        function renderChart() {
            const labels = taxData.map(item => item.jenisPajak);
            const realizationData = taxData.map(item => item.realisasi);
            const targetData = taxData.map(item => item.targetAnggaran);

            const dataCombined = {
                labels: labels,
                datasets: [
                    {
                        type: 'line',
                        label: 'Target Anggaran',
                        data: targetData,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        fill: false,
                        tension: 0.2,
                        pointRadius: 5,
                        pointStyle: 'circle'
                    },
                    {
                        type: 'bar',
                        label: 'Realisasi',
                        data: realizationData,
                        backgroundColor: 'rgba(54, 162, 235, 1)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                ]
            };

            const optionsCombined = {
                responsive: true,
                scales: {
                    x: {
                        stacked: false,
                        title: {
                            display: true,
                            text: 'Jenis Pajak'
                        }
                    },
                    y: {
                        stacked: false,
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        },
                        title: {
                            display: true,
                            text: 'Nominal (Rp)'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            };

            if (combinedChart) {
                combinedChart.destroy();
            }
            const ctxCombined = document.getElementById('combinedChart').getContext('2d');
            combinedChart = new Chart(ctxCombined, {
                type: 'bar',
                data: dataCombined,
                options: optionsCombined
            });
        }

        renderTaxTable();
        renderChart();

        const ctxTaxPerMonth = document.getElementById('combinedChart2').getContext('2d');
        const monthLabels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        const datasetsPerMonth = taxData2.map((item, index) => ({
            label: item.jenisPajak,
            data: [
                item.januari,
                item.februari,
                item.maret,
                item.april,
                item.mei,
                item.juni,
                item.juli,
                item.agustus,
                item.september,
                item.oktober,
                item.november,
                item.desember
            ],
            backgroundColor: `hsl(${index * 35}, 70%, 60%)`
        }));

        const chartPerMonth = new Chart(ctxTaxPerMonth, {
            type: 'bar',
            data: {
                labels: monthLabels,
                datasets: datasetsPerMonth
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        },
                        title: {
                            display: true,
                            text: 'Nominal (Rp)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                let value = context.parsed.y;
                                return `${label}: Rp${value.toLocaleString()}`;
                            }
                        }
                    }
                }
            }
        });

        // Modal detail SPTPD per jenis pajak
        $(document).on('click', '.btn-detail-sptpd', function(e) {
            e.preventDefault();
            let jenis = $(this).data('jenis');
            $('#modalJenisPajak').text(jenis);
            let data = sptpdByJenis[jenis] || [];
            let tbody = $('#tableDetailSptpd tbody');
            tbody.empty();
            if (data.length === 0) {
                tbody.append('<tr><td colspan="7" class="text-center">Data tidak ada</td></tr>');
            } else {
                data.forEach(function(row) {
                    tbody.append(`
                        <tr>
                            <td>${row.no_sptpd}</td>
                            <td>${row.tanggal}</td>
                            <td>${row.nopd}</td>
                            <td>${row.subjek_pajak}</td>
                            <td>${row.masa_pajak}</td>
                            <td>${parseInt(row.dasar).toLocaleString('id-ID')}</td>
                            <td>${parseInt(row.pajak_terutang).toLocaleString('id-ID')}</td>
                        </tr>
                    `);
                });
            }
            $('#modalDetailSptpd').modal('show');
        });

        document.getElementById('showTableButton').addEventListener('click', () => {
            document.getElementById('tableContainer').style.display = 'block';
            document.getElementById('chartContainer').style.display = 'none';
            document.getElementById('showTableButton').classList.add('active');
            document.getElementById('showChartButton').classList.remove('active');
        });

        document.getElementById('showChartButton').addEventListener('click', () => {
            document.getElementById('chartContainer').style.display = 'block';
            document.getElementById('tableContainer').style.display = 'none';
            document.getElementById('showChartButton').classList.add('active');
            document.getElementById('showTableButton').classList.remove('active');
        });

        document.getElementById('showTableButton2').addEventListener('click', () => {
            document.getElementById('tableContainer2').style.display = 'block';
            document.getElementById('chartContainer2').style.display = 'none';
            document.getElementById('showTableButton2').classList.add('active');
            document.getElementById('showChartButton2').classList.remove('active');
        });

        document.getElementById('showChartButton2').addEventListener('click', () => {
            document.getElementById('chartContainer2').style.display = 'block';
            document.getElementById('tableContainer2').style.display = 'none';
            document.getElementById('showChartButton2').classList.add('active');
            document.getElementById('showTableButton2').classList.remove('active');
        });

        // Sidebar Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.container');
            const footer = document.querySelector('.modern-footer');
            
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    // Toggle sidebar visibility
                    sidebar.classList.toggle('collapsed');
                    
                    // Add/remove class to body for main content adjustment
                    document.body.classList.toggle('sidebar-collapsed');
                    
                    // Update button icon
                    const icon = sidebarToggle.querySelector('i');
                    if (sidebar.classList.contains('collapsed')) {
                        icon.className = 'fas fa-indent';
                    } else {
                        icon.className = 'fas fa-bars';
                    }
                });
            }
        });
    </script>
    <style>
        /* CSS Variables for consistent theming */
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

        /* Container adjustments for proper spacing */
        .container {
            padding-top: 20px;
        }

        /* Modern Design System - Enhanced */
        .modern-header {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            border-bottom: 3px solid var(--primary-orange);
            margin-bottom: 2rem;
        }
        /* Modern Design System */
        :root {
            --primary-green: #00712D;
            --primary-orange: #FF6600;
            --secondary-green: #D5ED9F;
            --neutral-100: #FFFBE6;
            --neutral-200: #F8F9FA;
            --neutral-300: #E9ECEF;
            --neutral-400: #DEE2E6;
            --neutral-500: #ADB5BD;
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
            
            /* Green Theme Variables - Updated to match green palette */
            --primary-color: #00712D;
            --accent-color: #4CAF50;
            --accent-light: #8BC34A;
            --border-color: #e5e7eb;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --success-color: #2E7D32;
            --warning-color: #FF6600;
            --error-color: #D32F2F;
            --background-light: #f9fafb;
        }

        /* Modern Header with Sidebar Toggle */
        .header-left {
            display: flex;
            align-items: center;
        }

        .sidebar-toggle-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: var(--radius-md);
            color: var(--primary-green);
            padding: 12px 16px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .sidebar-toggle-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            color: var(--primary-green);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        /* Modern Footer Styles */
        .modern-footer {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-top: 3px solid var(--primary-green);
            padding: 3rem 0 2rem;
            margin-top: 4rem;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08);
        }

        .footer-content {
            padding: 0 2rem;
        }

        .footer-logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .footer-logo {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .footer-title {
            color: var(--primary-green);
            font-weight: 700;
            margin: 0;
            font-size: 1.2rem;
        }

        .footer-subtitle {
            color: var(--neutral-700);
            margin: 0;
            font-size: 0.9rem;
        }

        .footer-copyright {
            color: var(--neutral-700);
            margin: 0;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .footer-version {
            color: var(--neutral-600);
            margin: 4px 0 0 0;
            font-size: 0.8rem;
        }

        .footer-bottom {
            padding-top: 1.5rem;
            border-top: 1px solid var(--neutral-300);
            text-align: center;
        }

        .footer-stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .stats-item {
            color: var(--neutral-600);
            font-size: 0.85rem;
            display: flex;
            align-items: center;
        }

        .status-online {
            color: var(--primary-green);
            font-weight: 600;
        }

        /* Responsive adjustments for footer */
        @media (max-width: 768px) {
            .footer-stats {
                gap: 1rem;
                flex-direction: column;
                align-items: center;
            }
            
            .footer-logo-section {
                justify-content: center;
                margin-bottom: 1rem;
            }
            
            .footer-right {
                text-align: center !important;
            }
        }
        .modern-header {
            background: linear-gradient(135deg, var(--secondary-green) 0%, #B8E6B8 100%);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(10px);
        }

        .header-title {
            color: var(--primary-green);
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.025em;
        }

        .header-subtitle {
            color: var(--neutral-700);
            font-size: 0.95rem;
            margin: 0;
            opacity: 0.8;
        }

        /* Modern User Profile */
        .user-profile-modern .profile-container {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: rgba(255,255,255,0.2);
            border-radius: var(--radius-md);
            border: 1px solid rgba(255,255,255,0.3);
            cursor: pointer;
            transition: var(--transition);
        }

        .user-profile-modern .profile-container:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            background: var(--primary-green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
        }

        .profile-name {
            font-weight: 600;
            color: var(--primary-green);
            font-size: 0.95rem;
        }

        .profile-role {
            color: var(--neutral-700);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .profile-dropdown-icon {
            color: var(--primary-green);
            font-size: 0.8rem;
            transition: var(--transition);
        }

        .modern-dropdown {
            border: none;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            padding: 8px;
            margin-top: 8px;
        }

        .modern-dropdown .dropdown-item {
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .modern-dropdown .dropdown-item:hover {
            background: var(--neutral-100);
            transform: translateX(4px);
        }

        /* Modern Controls */
        .modern-controls-container {
            background: white;
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--neutral-300);
        }

        .controls-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .control-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .modern-label {
            font-weight: 600;
            color: var(--primary-green);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .modern-select {
            padding: 12px 16px;
            border: 2px solid var(--neutral-300);
            border-radius: var(--radius-md);
            font-size: 0.95rem;
            transition: var(--transition);
            background: white !important;
            color: var(--text-primary) !important;
        }

        .modern-select:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
            background: white !important;
            color: var(--text-primary) !important;
        }

        .modern-search {
            width: 100%;
            padding: 12px 16px 12px 44px;
            border: 2px solid var(--neutral-300);
            border-radius: var(--radius-md);
            font-size: 0.95rem;
            transition: var(--transition);
            background: white !important;
            color: var(--text-primary) !important;
        }

        .modern-search:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
            background: white !important;
            color: var(--text-primary) !important;
        }

        .modern-search::placeholder {
            color: var(--text-secondary) !important;
        }

        .search-input-container {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--neutral-500);
            font-size: 0.9rem;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        /* Main Cards */
        .main-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--neutral-200);
            overflow: hidden;
            transition: var(--transition);
        }

        .main-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .card-header-modern {
            background: linear-gradient(135deg, var(--primary-green) 0%, #005A23 100%);
            color: white;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .card-subtitle {
            font-size: 0.85rem;
            opacity: 0.9;
            margin: 4px 0 0 0;
        }

        /* View Toggle */
        .view-toggle-modern {
            display: flex;
            gap: 4px;
            background: rgba(255,255,255,0.1);
            border-radius: var(--radius-sm);
            padding: 4px;
        }

        .toggle-btn {
            padding: 8px 12px;
            background: transparent;
            border: none;
            color: rgba(255,255,255,0.7);
            border-radius: var(--radius-sm);
            transition: var(--transition);
            cursor: pointer;
            position: relative;
        }

        .toggle-btn:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }

        .toggle-btn.active {
            background: rgba(255,255,255,0.2);
            color: white;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Modern Table */
        .modern-table-container {
            padding: 24px;
        }

        .table-wrapper {
            border-radius: var(--radius-md);
            overflow: hidden;
            border: 1px solid var(--neutral-200);
        }

        .modern-table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
        }

        .modern-table thead {
            background: linear-gradient(135deg, var(--neutral-100) 0%, var(--neutral-200) 100%);
        }

        .modern-table th {
            padding: 16px;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--primary-orange);
            border-bottom: 2px solid var(--neutral-300);
        }

        .th-content {
            display: flex;
            align-items: center;
        }

        .modern-table td {
            padding: 16px;
            border-bottom: 1px solid var(--neutral-200);
            transition: var(--transition);
        }

        .modern-table tr:hover td {
            background: var(--neutral-100);
        }

        .modern-table .success-row td {
            background: linear-gradient(135deg, var(--primary-green) 0%, #005A23 100%) !important;
            color: white !important;
        }

        .tax-name {
            font-weight: 500;
            color: var(--neutral-800);
        }

        .amount {
            font-weight: 600;
            font-family: 'Monaco', 'Consolas', monospace;
            color: var(--neutral-700);
        }

        .progress-container {
            display: flex;
            flex-direction: column;
            gap: 4px;
            align-items: flex-end;
        }

        .progress-text {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--primary-green);
        }

        .mini-progress {
            width: 60px;
            height: 6px;
            background: var(--neutral-300);
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-orange) 0%, var(--primary-green) 100%);
            border-radius: 3px;
            transition: var(--transition);
        }

        .total-row td {
            background: linear-gradient(135deg, var(--secondary-green) 0%, #C8E6C9 100%) !important;
            border-top: 2px solid var(--primary-green);
            font-weight: 600;
        }

        .total-label {
            color: var(--primary-green);
            display: flex;
            align-items: center;
            font-size: 1rem;
        }

        .total-amount {
            color: var(--primary-green);
            font-family: 'Monaco', 'Consolas', monospace;
            font-size: 1rem;
        }

        .total-percentage {
            color: var(--primary-orange);
            font-weight: 700;
            font-size: 1.1rem;
        }

        /* Summary Card */
        .summary-card {
            background: linear-gradient(135deg, white 0%, var(--neutral-100) 100%);
            border-radius: var(--radius-lg);
            border: 1px solid var(--neutral-200);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }

        .summary-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .summary-content {
            padding: 24px;
        }

        .summary-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .summary-title {
            color: var(--primary-green);
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .summary-subtitle {
            color: var(--neutral-700);
            font-size: 0.9rem;
            margin: 8px 0 0 0;
        }

        .revenue-visual {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .revenue-icon {
            width: 100%;
            background: var(--secondary-green);
            border-radius: var(--radius-md);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 120px;
        }

        .revenue-image {
            width: 100%;
            max-width: 120px;
            height: auto;
            object-fit: contain;
        }

        .revenue-stats {
            text-align: center;
            width: 100%;
        }

        .revenue-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-green);
            font-family: 'Monaco', 'Consolas', monospace;
            margin-bottom: 12px;
        }

        .revenue-progress {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .progress-label {
            color: var(--neutral-700);
            font-size: 0.9rem;
        }

        .progress-value {
            color: var(--primary-green);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .progress-bar-modern {
            width: 100%;
            height: 12px;
            background: var(--neutral-300);
            border-radius: 6px;
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        }

        .progress-fill-modern {
            height: 100%;
            background: linear-gradient(90deg, var(--accent-color) 0%, var(--primary-green) 100%);
            border-radius: 6px;
            transition: var(--transition);
        }

        /* Chart Container */
        .chart-container {
            padding: 24px;
        }

        /* Comparison Section */
        .comparison-section {
            margin: 32px 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .section-title {
            color: var(--primary-green);
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section-subtitle {
            color: var(--neutral-700);
            font-size: 1rem;
            margin: 8px 0 0 0;
        }

        .comparison-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .comparison-card {
            background: white;
            border-radius: var(--radius-lg);
            border: 1px solid var(--neutral-200);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: var(--transition);
        }

        .comparison-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--accent-color);
        }

        .card-icon {
            background: linear-gradient(135deg, var(--secondary-green) 0%, #B8E6B8 100%);
            padding: 20px;
            text-align: center;
        }

        .tax-icon {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .card-content {
            padding: 20px;
        }

        .tax-title {
            color: var(--primary-green);
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0 0 16px 0;
            text-align: center;
        }

        .comparison-stats {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            border-radius: var(--radius-sm);
        }

        .current-year {
            background: linear-gradient(135deg, var(--primary-green) 10%, transparent 10%);
            border-left: 4px solid var(--primary-green);
        }

        .previous-year {
            background: linear-gradient(135deg, var(--neutral-400) 10%, transparent 10%);
            border-left: 4px solid var(--neutral-400);
        }

        .year-label {
            font-weight: 600;
            color: var(--neutral-800);
            font-size: 0.9rem;
        }

        .amount-value {
            font-weight: 600;
            color: var(--neutral-700);
            font-family: 'Monaco', 'Consolas', monospace;
            font-size: 0.85rem;
        }

        .card-actions {
            text-align: center;
        }

        .detail-btn {
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--primary-green) 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--radius-md);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .detail-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-color) 100%);
        }

        /* Fix untuk button yang ada di comparison cards */
        .btn-detail-sptpd {
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--primary-green) 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--radius-md);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-detail-sptpd:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-color) 100%);
            color: white;
            text-decoration: none;
        }

        .btn-detail-sptpd:focus {
            color: white;
            text-decoration: none;
            outline: none;
        }

        /* Comparison Section */
        .comparison-section {
            background: white;
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--neutral-200);
        }

        .section-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .section-title {
            color: var(--primary-green);
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section-subtitle {
            color: var(--neutral-700);
            font-size: 1rem;
            margin: 8px 0 0 0;
        }

        .comparison-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .comparison-card {
            background: linear-gradient(135deg, white 0%, var(--neutral-100) 100%);
            border-radius: var(--radius-md);
            padding: 20px;
            border: 2px solid transparent;
            background-clip: padding-box;
            position: relative;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .comparison-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-orange) 0%, var(--primary-green) 100%);
            border-radius: var(--radius-md) var(--radius-md) 0 0;
        }

        .comparison-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-orange);
        }

        .card-icon {
            background: var(--secondary-green);
            border-radius: 50%;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            box-shadow: var(--shadow-sm);
        }

        .tax-icon {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .card-content {
            text-align: center;
        }

        .tax-title {
            color: var(--primary-green);
            font-size: 1rem;
            font-weight: 600;
            margin: 0 0 16px 0;
            min-height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1.3;
        }

        .comparison-stats {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            border-radius: var(--radius-sm);
            background: rgba(255,255,255,0.5);
        }

        .current-year {
            border-left: 4px solid var(--primary-green);
        }

        .previous-year {
            border-left: 4px solid var(--primary-orange);
        }

        .year-label {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .current-year .year-label {
            color: var(--primary-green);
        }

        .previous-year .year-label {
            color: var(--primary-orange);
        }

        .amount-value {
            font-weight: 600;
            font-family: 'Monaco', 'Consolas', monospace;
            font-size: 0.85rem;
            color: var(--neutral-800);
        }

        .card-actions {
            text-align: center;
        }

        .detail-btn {
            background: linear-gradient(135deg, var(--primary-orange) 0%, #E55A00 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .detail-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
            background: linear-gradient(135deg, #E55A00 0%, var(--primary-orange) 100%);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .controls-grid {
                grid-template-columns: 1fr;
            }
            
            .header-title {
                font-size: 1.5rem;
            }
            
            .modern-table td,
            .modern-table th {
                padding: 12px 8px;
                font-size: 0.85rem;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Legacy Button Styles (for compatibility) */
        .btn-success {
            background-color: var(--primary-green) !important;
            color: white !important;
            border: 1px solid var(--primary-green) !important;
        }
        .btn-success:hover {
            background-color: #005A23 !important;
            color: white !important;
            border-color: #005A23 !important;
        }
        .active {
            background-color: var(--primary-green) !important;
            color: white !important;
            border-color: var(--primary-green) !important;
        }

        /* Fix Text Visibility Issues */
        body {
            background-color: var(--background-light);
            color: var(--text-primary);
        }

        .container {
            background-color: var(--background-light);
        }

        /* Ensure all text has proper contrast */
        .text-muted {
            color: var(--text-secondary) !important;
        }

        .text-dark {
            color: var(--text-primary) !important;
        }

        /* Fix any transparent backgrounds that might cause issues */
        .card {
            background-color: white !important;
            color: var(--text-primary) !important;
        }

        .card-body {
            background-color: white !important;
            color: var(--text-primary) !important;
        }

        /* Fix dropdown text visibility */
        .dropdown-menu {
            background-color: white !important;
            border: 1px solid var(--border-color) !important;
        }

        .dropdown-item {
            color: var(--text-primary) !important;
        }

        .dropdown-item:hover {
            background-color: var(--neutral-100) !important;
            color: var(--text-primary) !important;
        }

        /* Monthly Table Specific Styles */
        .monthly-table-section {
            margin-top: 2rem;
        }

        .monthly-table {
            font-size: 0.9rem;
            width: 100%;
        }

        .monthly-table th {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            font-weight: 600;
            padding: 1rem 0.75rem;
            border: none;
            white-space: nowrap;
            position: relative;
        }

        .monthly-table th.quarter-header {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
        }

        .monthly-table th.quarter-result {
            background: linear-gradient(135deg, #f39c12, #d68910);
        }

        .monthly-table th.sticky-col {
            position: sticky;
            left: 0;
            z-index: 10;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color)) !important;
        }

        .monthly-table .th-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .monthly-table td {
            padding: 1rem 0.75rem;
            border-bottom: 1px solid var(--border-color);
            border-right: 1px solid var(--border-color);
            background: white;
            transition: all 0.2s ease;
        }

        .monthly-table td.sticky-col {
            position: sticky;
            left: 0;
            z-index: 5;
            background: white !important;
            border-right: 2px solid var(--primary-color);
        }

        .monthly-table tbody tr:hover td {
            background-color: rgba(59, 130, 246, 0.05);
        }

        .monthly-table .tax-name {
            font-weight: 600;
            color: var(--text-primary);
        }

        .monthly-table .amount {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-primary);
        }

        .monthly-table .percentage {
            font-weight: 600;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            background: linear-gradient(135deg, var(--success-color), var(--primary-green));
            color: white;
            display: inline-block;
            min-width: 60px;
            text-align: center;
        }

        .monthly-table .quarter-target {
            background-color: rgba(231, 76, 60, 0.05);
        }

        .monthly-table .quarter-percentage {
            background-color: rgba(243, 156, 18, 0.05);
        }

        .monthly-table .total-row {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(99, 102, 241, 0.1));
            font-weight: 600;
        }

        .monthly-table .total-row td {
            border-top: 2px solid var(--primary-color);
            padding: 1.25rem 0.75rem;
        }

        .monthly-table .total-label {
            display: flex;
            align-items: center;
            color: var(--primary-color);
            font-weight: 700;
        }

        .monthly-table .total-amount {
            color: var(--primary-color);
            font-weight: 700;
        }

        .monthly-table .total-percentage {
            font-weight: 700;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            display: inline-block;
            min-width: 80px;
            text-align: center;
        }

        .view-toggle-modern {
            display: flex;
            gap: 0.5rem;
        }

        .toggle-btn {
            padding: 0.75rem 1rem;
            border: 2px solid var(--border-color);
            background: white !important;
            color: var(--text-primary) !important;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
        }

        .toggle-btn:hover {
            border-color: var(--primary-color);
            color: var(--primary-color) !important;
            transform: translateY(-2px);
            background: white !important;
        }

        .toggle-btn.active {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color)) !important;
            color: white !important;
            border-color: var(--primary-color);
        }

        .toggle-btn[data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: -2.5rem;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.8rem;
            white-space: nowrap;
            z-index: 1000;
        }

        .modern-table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .table-wrapper {
            max-height: 600px;
            overflow: auto;
        }

        .table-wrapper::-webkit-scrollbar {
            height: 8px;
            width: 8px;
        }

        .table-wrapper::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        .chart-container {
            padding: 2rem;
            background: white;
            border-radius: 12px;
            margin-top: 1rem;
        }

        /* Modern Modal Styles */
        .modern-modal {
            border: none;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .modern-modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            border-bottom: none;
            border-radius: 20px 20px 0 0;
            padding: 2rem;
        }

        .modal-title-section {
            flex: 1;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .tax-type-name {
            color: var(--accent-light);
            font-weight: 800;
        }

        .modal-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            margin: 0;
        }

        .modern-close-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .modern-close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: rotate(90deg);
        }

        .modern-modal-body {
            padding: 2rem;
            background: #f8fafc;
        }

        .modern-modal-footer {
            background: white;
            border-top: 1px solid var(--border-color);
            border-radius: 0 0 20px 20px;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-info {
            color: var(--text-secondary);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .modern-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .modern-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .header-content {
                align-items: center;
            }

            .user-profile {
                justify-content: center;
            }

            .filter-section {
                flex-direction: column;
                gap: 1rem;
            }

            .filter-row {
                flex-direction: column;
                gap: 1rem;
            }

            .search-container,
            .filter-group {
                width: 100%;
            }

            .data-cards {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .comparison-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .card-header-modern {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .view-toggle-modern {
                justify-content: center;
            }

            .monthly-table th,
            .monthly-table td {
                padding: 0.5rem;
                font-size: 0.8rem;
            }

            .modern-modal-header {
                padding: 1.5rem;
            }

            .modal-title {
                font-size: 1.25rem;
            }

            .modern-modal-body {
                padding: 1rem;
            }

            .modern-modal-footer {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .dashboard-title {
                font-size: 1.5rem;
            }

            .dashboard-subtitle {
                font-size: 0.9rem;
            }

            .data-value {
                font-size: 1.5rem;
            }

            .comparison-value {
                font-size: 1.5rem;
            }

            .filter-input,
            .filter-select,
            .search-input {
                font-size: 14px;
            }
        }
    </style>
@endsection