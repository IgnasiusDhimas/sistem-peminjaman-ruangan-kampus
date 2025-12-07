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
        vertical-align: top;
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
    
    .gedung-name {
        font-weight: 600;
        color: #1e293b;
    }
    
    .gedung-description {
        color: #64748b;
        font-size: 13px;
        line-height: 1.4;
        max-width: 400px;
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
        border-left: 4px solid #3b82f6;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .stats-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background-color: #dbeafe;
        color: #1d4ed8;
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
        
        .gedung-description {
            max-width: 200px;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">Daftar Gedung</h1>
        <div class="action-buttons">
            <a href="{{ route('admin.gedung.create') }}" class="create-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Tambah Gedung Baru
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
                <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <div class="stats-content">
            <h3>Total Gedung</h3>
            <p>{{ $gedungs->count() }}</p>
        </div>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        @if($gedungs->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 30%;">Nama Gedung</th>
                        <th style="width: 50%;">Deskripsi</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gedungs as $g)
                    <tr>
                        <td>
                            <div class="gedung-name">{{ $g->nama }}</div>
                        </td>
                        <td>
                            <div class="gedung-description">
                                @if($g->deskripsi)
                                    {{ Str::limit($g->deskripsi, 150) }}
                                @else
                                    <span style="color: #9ca3af; font-style: italic;">Tidak ada deskripsi</span>
                                @endif
                            </div>
                        </td>
                        <td class="action-buttons-cell">
                            <a href="{{ route('admin.gedung.edit', $g->id) }}" class="edit-button">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.gedung.destroy', $g->id) }}" class="action-form" onsubmit="return confirmDelete('{{ $g->nama }}')">
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
                <div class="empty-icon">🏢</div>
                <h3 class="empty-title">Belum Ada Gedung</h3>
                <p class="empty-description">Tambahkan gedung baru untuk mulai mengelola ruangan-ruangan di dalamnya.</p>
                <a href="{{ route('admin.gedung.create') }}" class="create-button" style="display: inline-flex;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Tambah Gedung Pertama
                </a>
            </div>
        @endif
    </div>
</div>

<script>
function confirmDelete(gedungName) {
    return confirm(`Apakah Anda yakin ingin menghapus gedung "${gedungName}"?\n\nSemua ruangan di dalam gedung ini juga akan terhapus. Tindakan ini tidak dapat dibatalkan.`);
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