@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Modern Page Styling */
    .main-content-wrapper {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        overflow-x: hidden;
        padding: 20px;
        min-height: 100vh;
    }
    
    .container-fluid {
        padding: 0 20px;
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        box-sizing: border-box;
    }
    
    /* Modern Header */
    .modern-header {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        background: linear-gradient(135deg, var(--secondary-green) 0%, #E8F5E8 100%);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        margin-bottom: 24px;
    }
    
    .header-title {
        color: var(--primary-green);
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
    }
    
    .header-subtitle {
        color: var(--neutral-700);
        font-size: 0.95rem;
        margin: 4px 0 0 0;
    }
    
    /* Sidebar toggle button */
    .sidebar-toggle-btn {
        background: var(--primary-green);
        border: none;
        color: white;
        padding: 12px 15px;
        border-radius: var(--radius-md);
        cursor: pointer;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
    }
    
    .sidebar-toggle-btn:hover {
        background: var(--accent-green);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    
    /* Modern Controls */
    .modern-controls-container {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--neutral-300);
        padding: 24px;
        margin-bottom: 24px;
    }
    
    .controls-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 16px;
        margin-bottom: 20px;
    }
    
    .control-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .modern-label {
        font-weight: 600;
        color: var(--neutral-700);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .modern-input {
        padding: 12px 16px;
        border: 2px solid var(--neutral-300);
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        transition: var(--transition);
        background: white;
    }
    
    .modern-input:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(0, 113, 45, 0.1);
    }
    
    .modern-select {
        padding: 12px 16px;
        border: 2px solid var(--neutral-300);
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        transition: var(--transition);
        background: white;
    }
    
    .modern-select:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(0, 113, 45, 0.1);
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 16px;
    }
    
    .btn-modern {
        padding: 12px 20px;
        border: none;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 120px;
        justify-content: center;
        text-decoration: none;
    }
    
    .btn-add {
        background: #22b8cf;
        color: white;
    }
    
    .btn-add:hover {
        background: #1a94a8;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: white;
        text-decoration: none;
    }
    
    .btn-search {
        background: var(--primary-green);
        color: white;
    }
    
    .btn-search:hover {
        background: var(--accent-green);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    
    .btn-reset {
        background: var(--neutral-500);
        color: white;
    }
    
    .btn-reset:hover {
        background: var(--neutral-600);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    
    /* Modern Table */
    .modern-table-container {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--neutral-300);
        overflow: hidden;
    }
    
    .modern-table {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
        font-size: 0.9rem;
    }
    
    .modern-table thead {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
    }
    
    .modern-table thead th {
        color: white;
        font-weight: 600;
        padding: 16px 12px;
        text-align: left;
        border: none;
        font-size: 0.9rem;
    }
    
    .modern-table tbody tr {
        border-bottom: 1px solid var(--neutral-200);
        transition: var(--transition);
    }
    
    .modern-table tbody tr:hover {
        background: var(--neutral-100);
    }
    
    .modern-table tbody td {
        padding: 14px 12px;
        border: none;
        color: var(--neutral-700);
        vertical-align: middle;
    }
    
    /* Status Badge */
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-active {
        background: rgba(40, 167, 69, 0.2);
        color: #28a745;
    }
    
    .status-disabled {
        background: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }
    
    /* Statistics Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }
    
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--neutral-300);
        text-align: center;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        color: var(--primary-green);
        margin-bottom: 4px;
    }
    
    .stat-label {
        color: var(--neutral-600);
        font-size: 0.9rem;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 16px;
            padding-right: 16px;
        }
        
        .modern-header {
            flex-direction: column;
            gap: 16px;
            text-align: center;
        }
        
        .controls-grid {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            justify-content: center;
        }
        
        .modern-table {
            font-size: 0.8rem;
        }
        
        .modern-table thead th,
        .modern-table tbody td {
            padding: 10px 8px;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="main-content-wrapper">
    <div class="container-fluid">
        <!-- Modern Header -->
        <div class="modern-header">
            <div class="header-content">
                <div class="header-left d-flex align-items-center">
                    <button class="sidebar-toggle-btn me-4" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h2 class="header-title">Registrasi Wajib Pajak</h2>
                        <p class="header-subtitle">Manajemen Data Wajib Pajak Daerah</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ count($wajibPajak) }}</div>
                <div class="stat-label">Total Wajib Pajak</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $wajibPajak->where('disabled', 0)->count() }}</div>
                <div class="stat-label">Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $wajibPajak->where('disabled', 1)->count() }}</div>
                <div class="stat-label">Non-Aktif</div>
            </div>
        </div>
        
        <!-- Modern Controls -->
        <div class="modern-controls-container">
            <div class="controls-grid">
                <div class="control-group">
                    <label class="modern-label">
                        <i class="fas fa-search me-2"></i>Cari Nama / NPWPD
                    </label>
                    <input type="text" id="searchName" class="modern-input" placeholder="Masukkan nama atau NPWPD...">
                </div>
                <div class="control-group">
                    <label class="modern-label">
                        <i class="fas fa-filter me-2"></i>Status
                    </label>
                    <select id="filterStatus" class="modern-select">
                        <option value="">Semua Status</option>
                        <option value="0">Aktif</option>
                        <option value="1">Non-Aktif</option>
                    </select>
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('wp.create') }}" class="btn-modern btn-add">
                    <i class="fas fa-plus"></i>Tambah
                </a>
                <button class="btn-modern btn-search" id="searchBtn">
                    <i class="fas fa-search"></i>Cari
                </button>
                <button class="btn-modern btn-reset" id="resetBtn">
                    <i class="fas fa-refresh"></i>Reset
                </button>
            </div>
        </div>
        
        <!-- Modern Table -->
        <div class="modern-table-container">
            <table class="modern-table" id="wpTable">
                <thead>
                    <tr>
                        <th><i class="fas fa-id-card me-2"></i>User ID / NPWPD</th>
                        <th><i class="fas fa-user me-2"></i>Nama</th>
                        <th><i class="fas fa-calendar me-2"></i>Tgl. Register</th>
                        <th><i class="fas fa-toggle-on me-2"></i>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wajibPajak as $wp)
                    <tr>
                        <td>{{ $wp->user->userid ?? '' }}</td>
                        <td>{{ $wp->name }}</td>
                        <td>{{ $wp->user->created_at ? $wp->user->created_at->format('d-m-Y') : '' }}</td>
                        <td>
                            <span class="status-badge {{ $wp->disabled ? 'status-disabled' : 'status-active' }}">
                                {{ $wp->disabled ? 'Non-Aktif' : 'Aktif' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');
        });
    }
    
    // Search functionality
    const searchName = document.getElementById('searchName');
    const filterStatus = document.getElementById('filterStatus');
    const searchBtn = document.getElementById('searchBtn');
    const resetBtn = document.getElementById('resetBtn');
    const table = document.getElementById('wpTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    function filterTable() {
        const searchTerm = searchName.value.toLowerCase();
        const statusFilter = filterStatus.value;
        
        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const nameCell = row.cells[1].textContent.toLowerCase();
            const npwpdCell = row.cells[0].textContent.toLowerCase();
            const statusCell = row.cells[3].textContent.toLowerCase();
            
            let showRow = true;
            
            // Name/NPWPD filter
            if (searchTerm && !nameCell.includes(searchTerm) && !npwpdCell.includes(searchTerm)) {
                showRow = false;
            }
            
            // Status filter
            if (statusFilter !== '') {
                const isDisabled = statusCell.includes('non-aktif');
                if ((statusFilter === '1' && !isDisabled) || (statusFilter === '0' && isDisabled)) {
                    showRow = false;
                }
            }
            
            row.style.display = showRow ? '' : 'none';
        }
    }
    
    searchBtn.addEventListener('click', filterTable);
    searchName.addEventListener('input', filterTable);
    filterStatus.addEventListener('change', filterTable);
    
    resetBtn.addEventListener('click', function() {
        searchName.value = '';
        filterStatus.value = '';
        for (let i = 0; i < rows.length; i++) {
            rows[i].style.display = '';
        }
    });
});
</script>
@endsection
