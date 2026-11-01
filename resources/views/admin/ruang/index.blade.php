@extends('layouts.app')

@section('content')
<style>
    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .dashboard-title {
        font-size: 24px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }
    
    .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .create-button {
        background-color: #10b981;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .create-button:hover {
        background-color: #059669;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }
    
    .back-button {
        background-color: #64748b;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .back-button:hover {
        background-color: #475569;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(100, 116, 139, 0.2);
    }
    
    .table-container {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .data-table thead {
        background-color: #f1f5f9;
    }
    
    .data-table th {
        padding: 15px 20px;
        text-align: left;
        font-weight: 600;
        color: #374151;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .data-table td {
        padding: 15px 20px;
        border-bottom: 1px solid #f1f5f9;
        color: #4b5563;
        font-size: 14px;
        vertical-align: middle;
    }
    
    .data-table tbody tr:hover {
        background-color: #f8fafc;
    }
    
    .data-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .action-buttons-cell {
        white-space: nowrap;
        width: 1%;
    }
    
    .edit-button {
        background-color: #f59e0b;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    .edit-button:hover {
        background-color: #d97706;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.2);
    }
    
    .delete-button {
        background-color: #ef4444;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    .delete-button:hover {
        background-color: #dc2626;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.2);
    }
    
    .action-form {
        display: inline-block;
        margin: 0;
    }
    
    .ruang-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    
    .ruang-name {
        font-weight: 600;
        color: #1e293b;
    }
    
    .ruang-id {
        font-size: 11px;
        color: #6b7280;
        font-family: 'SF Mono', Monaco, Consolas, monospace;
    }
    
    .gedung-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    
    .gedung-name {
        font-weight: 500;
        color: #374151;
    }
    
    .gedung-id {
        font-size: 11px;
        color: #6b7280;
        font-family: 'SF Mono', Monaco, Consolas, monospace;
    }
    
    .capacity-info {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .capacity-number {
        font-size: 16px;
        font-weight: 600;
        color: #1e293b;
    }
    
    .capacity-unit {
        font-size: 12px;
        color: #6b7280;
        background-color: #f3f4f6;
        padding: 2px 6px;
        border-radius: 4px;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }
    
    .empty-icon {
        font-size: 48px;
        margin-bottom: 15px;
        opacity: 0.3;
    }
    
    .empty-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #6b7280;
    }
    
    .empty-description {
        font-size: 14px;
        max-width: 400px;
        margin: 0 auto 20px;
        line-height: 1.5;
    }
    
    .stats-card {
        background-color: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        border-left: 4px solid #10b981;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .stats-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background-color: #d1fae5;
        color: #065f46;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .stats-content h3 {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin: 0 0 5px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stats-content p {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    
    .filters-container {
        background-color: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        border: 1px solid #e2e8f0;
    }
    
    .filters-title {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }
    
    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .filter-label {
        font-size: 12px;
        font-weight: 500;
        color: #6b7280;
    }
    
    .filter-select {
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 14px;
        background-color: white;
    }
    
    .filter-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .filter-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }
    
    .apply-button {
        background-color: #3b82f6;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .apply-button:hover {
        background-color: #2563eb;
    }
    
    .reset-button {
        background-color: white;
        color: #374151;
        border: 1px solid #d1d5db;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .reset-button:hover {
        background-color: #f9fafb;
        border-color: #9ca3af;
    }
    
    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .action-buttons {
            width: 100%;
        }
        
        .create-button,
        .back-button {
            flex: 1;
            justify-content: center;
            min-width: 140px;
        }
        
        .data-table {
            display: block;
            overflow-x: auto;
        }
        
        .action-buttons-cell {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .edit-button,
        .delete-button {
            width: 100%;
            justify-content: center;
        }
        
        .filter-grid {
            grid-template-columns: 1fr;
        }
        
        .filter-actions {
            flex-direction: column;
        }
        
        .apply-button,
        .reset-button {
            width: 100%;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">Daftar Ruangan</h1>
        <div class="action-buttons">
            <a href="{{ route('admin.ruang.create') }}" class="create-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Tambah Ruangan
            </a>
            <a href="{{ route('admin.dashboard') }}" class="back-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Stats Card -->
    <div class="stats-card">
        <div class="stats-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
        </div>
        <div class="stats-content">
            <h3>Total Ruangan</h3>
            <p>{{ $ruangs->count() }}</p>
        </div>
    </div>

    <!-- Filters (Optional) -->
    @if($gedungs->count() > 0)
    <div class="filters-container">
        <h3 class="filters-title">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 3H2l8 9.46V19l4 2v-8.54L22 3z"/>
            </svg>
            Filter Ruangan
        </h3>
        
        <form method="GET" action="{{ route('admin.ruang.index') }}" id="filterForm">
            <div class="filter-grid">
                <div class="filter-group">
                    <label class="filter-label">Filter Berdasarkan Gedung</label>
                    <select name="gedung_id" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Semua Gedung</option>
                        @foreach($gedungs as $g)
                            <option value="{{ $g->id }}" {{ request('gedung_id') == $g->id ? 'selected' : '' }}>
                                {{ $g->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Urutkan Berdasarkan</label>
                    <select name="sort" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                        <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Nama Z-A</option>
                        <option value="kapasitas_asc" {{ request('sort') == 'kapasitas_asc' ? 'selected' : '' }}>Kapasitas Terkecil</option>
                        <option value="kapasitas_desc" {{ request('sort') == 'kapasitas_desc' ? 'selected' : '' }}>Kapasitas Terbesar</option>
                    </select>
                </div>
            </div>
            
            <div class="filter-actions">
                <button type="submit" class="apply-button">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Terapkan Filter
                </button>
                
                @if(request()->has('gedung_id') || request()->has('sort'))
                <a href="{{ route('admin.ruang.index') }}" class="reset-button">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset Filter
                </a>
                @endif
            </div>
        </form>
    </div>
    @endif

    <!-- Table Container -->
    <div class="table-container">
        @if($ruangs->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 30%;">Ruangan</th>
                        <th style="width: 30%;">Gedung</th>
                        <th style="width: 20%;">Kapasitas</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ruangs as $r)
                    <tr>
                        <td>
                            <div class="ruang-info">
                                <div class="ruang-name">{{ $r->nama }}</div>
                                <div class="ruang-id">#{{ $r->id }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="gedung-info">
                                <div class="gedung-name">{{ $r->gedung->nama }}</div>
                                <div class="gedung-id">Gedung #{{ $r->gedung->id }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="capacity-info">
                                <span class="capacity-number">{{ $r->kapasitas }}</span>
                                <span class="capacity-unit">orang</span>
                            </div>
                        </td>
                        <td class="action-buttons-cell">
                            <a href="{{ route('admin.ruang.edit', $r->id) }}" class="edit-button">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.ruang.destroy', $r->id) }}" class="action-form" onsubmit="return confirmDelete('{{ $r->nama }}', '{{ $r->gedung->nama }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <div class="empty-icon">🚪</div>
                <h3 class="empty-title">
                    @if(request()->has('gedung_id'))
                        Tidak Ada Ruangan di Gedung Ini
                    @else
                        Belum Ada Ruangan
                    @endif
                </h3>
                <p class="empty-description">
                    @if(request()->has('gedung_id'))
                        Tidak ditemukan ruangan untuk gedung yang dipilih.
                    @else
                        Tambahkan ruangan baru untuk mulai mengelola peminjaman.
                    @endif
                </p>
                <a href="{{ route('admin.ruang.create') }}" class="create-button" style="display: inline-flex;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Tambah Ruangan Pertama
                </a>
            </div>
        @endif
    </div>
</div>

<script>
function confirmDelete(ruangNama, gedungNama) {
    return confirm(`Apakah Anda yakin ingin menghapus ruangan "${ruangNama}" di gedung "${gedungNama}"?\n\nSemua peminjaman yang terkait dengan ruangan ini juga akan terhapus. Tindakan ini tidak dapat dibatalkan.`);
}

document.addEventListener('DOMContentLoaded', function() {
    // Add row hover effect
    const rows = document.querySelectorAll('.data-table tbody tr');
    rows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8fafc';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
});
</script>
@endsection