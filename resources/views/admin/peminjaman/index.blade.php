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
    
    .alert-message {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .alert-success {
        background-color: #d1fae5;
        border: 1px solid #a7f3d0;
        color: #065f46;
    }
    
    .alert-danger {
        background-color: #fee2e2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }
    
    .alert-success::before,
    .alert-danger::before {
        font-weight: bold;
    }
    
    .alert-success::before {
        content: "✓";
    }
    
    .alert-danger::before {
        content: "⚠";
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
    
    .detail-button {
        background-color: #3b82f6;
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
    
    .detail-button:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2);
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
    
    .user-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    
    .user-email {
        font-size: 12px;
        color: #6b7280;
    }
    
    .location-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    
    .gedung-name {
        font-weight: 500;
        color: #374151;
    }
    
    .ruang-name {
        font-size: 12px;
        color: #6b7280;
    }
    
    .time-info {
        font-family: 'SF Mono', Monaco, Consolas, monospace;
        font-size: 13px;
        color: #4b5563;
    }
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge-pending {
        background-color: #fef3c7;
        color: #92400e;
    }
    
    .badge-approved {
        background-color: #d1fae5;
        color: #065f46;
    }
    
    .badge-rejected {
        background-color: #fee2e2;
        color: #991b1b;
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
    
    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 25px;
    }
    
    .stat-card {
        background-color: white;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        gap: 12px;
        border: 1px solid #e2e8f0;
    }
    
    .stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .stat-pending .stat-icon {
        background-color: #fef3c7;
        color: #92400e;
    }
    
    .stat-approved .stat-icon {
        background-color: #d1fae5;
        color: #065f46;
    }
    
    .stat-rejected .stat-icon {
        background-color: #fee2e2;
        color: #991b1b;
    }
    
    .stat-total .stat-icon {
        background-color: #dbeafe;
        color: #1d4ed8;
    }
    
    .stat-content h3 {
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        margin: 0 0 2px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-content p {
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    
    /* Pagination Styles */
    .pagination-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding: 20px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .pagination-info {
        color: #6b7280;
        font-size: 14px;
        font-weight: 500;
    }
    
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 8px;
    }
    
    .pagination-item {
        margin: 0;
    }
    
    .pagination-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 15px;
        background-color: white;
        color: #4b5563;
        text-decoration: none;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .pagination-link:hover {
        background-color: #f3f4f6;
        border-color: #9ca3af;
    }
    
    .pagination-link.active {
        background-color: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }
    
    .pagination-link.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background-color: #f9fafb;
    }
    
    .pagination-arrow {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .page-input-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .page-input {
        width: 60px;
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        text-align: center;
        font-size: 14px;
    }
    
    .page-go-button {
        background-color: #3b82f6;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .page-go-button:hover {
        background-color: #2563eb;
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
        
        .stats-cards {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .action-buttons-cell {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .detail-button,
        .edit-button,
        .delete-button {
            width: 100%;
            justify-content: center;
        }
        
        .pagination-container {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }
        
        .pagination-info {
            order: -1;
        }
        
        .pagination {
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .page-input-container {
            justify-content: center;
        }
    }
    
    @media (max-width: 480px) {
        .stats-cards {
            grid-template-columns: 1fr;
        }
        
        .pagination-link {
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">Manajemen Peminjaman Ruangan</h1>
        <div class="action-buttons">
            <a href="{{ route('admin.peminjaman.create') }}" class="create-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Tambah Peminjaman
            </a>
            <a href="{{ route('admin.dashboard') }}" class="back-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert-message alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-message alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <!-- PERBAIKAN: Sekarang menggunakan variabel dari controller -->
    <div class="stats-cards">
        <div class="stat-card stat-total">
            <div class="stat-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="stat-content">
                <h3>Total</h3>
                <p>{{ $total }}</p>
            </div>
        </div>
        
        <div class="stat-card stat-pending">
            <div class="stat-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="stat-content">
                <h3>Pending</h3>
                <p>{{ $pending }}</p>
            </div>
        </div>
        
        <div class="stat-card stat-approved">
            <div class="stat-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="stat-content">
                <h3>Disetujui</h3>
                <p>{{ $approved }}</p>
            </div>
        </div>
        
        <div class="stat-card stat-rejected">
            <div class="stat-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <div class="stat-content">
                <h3>Ditolak</h3>
                <p>{{ $rejected }}</p>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        @if($data->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 20%;">User</th>
                        <th style="width: 20%;">Lokasi</th>
                        <th style="width: 15%;">Tanggal</th>
                        <th style="width: 15%;">Waktu</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $p)
                    <tr>
                        <td>
                            <div class="user-info">
                                <div>{{ $p->user->name }}</div>
                                <div class="user-email">{{ $p->user->email }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="location-info">
                                <!-- PERHATIAN: Sesuaikan dengan eager loading di controller -->
                                @if(isset($p->gedung))
                                    <div class="gedung-name">{{ $p->gedung->nama }}</div>
                                @elseif(isset($p->ruang) && isset($p->ruang->gedung))
                                    <div class="gedung-name">{{ $p->ruang->gedung->nama }}</div>
                                @else
                                    <div class="gedung-name">-</div>
                                @endif
                                <div class="ruang-name">{{ $p->ruang->nama ?? '-' }}</div>
                            </div>
                        </td>
                        <td>{{ $p->tanggal }}</td>
                        <td class="time-info">{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</td>
                        <td>
                            @if($p->status === 'pending')
                                <span class="status-badge badge-pending">Pending</span>
                            @elseif($p->status === 'approved')
                                <span class="status-badge badge-approved">Approved</span>
                            @else
                                <span class="status-badge badge-rejected">Rejected</span>
                            @endif
                        </td>
                        <td class="action-buttons-cell">
                            <a href="{{ route('admin.peminjaman.detail', $p->id) }}" class="detail-button">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                Detail
                            </a>
                            <a href="{{ route('admin.peminjaman.edit', $p->id) }}" class="edit-button">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.peminjaman.delete', $p->id) }}" class="action-form" onsubmit="return confirmDelete('{{ $p->user->name }}', '{{ $p->tanggal }}', '{{ $p->ruang->nama ?? '' }}')">
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
                <div class="empty-icon">📅</div>
                <h3 class="empty-title">Belum Ada Peminjaman</h3>
                <p class="empty-description">Mulai dengan menambahkan peminjaman ruangan baru untuk user.</p>
                <a href="{{ route('admin.peminjaman.create') }}" class="create-button" style="display: inline-flex;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Tambah Peminjaman Pertama
                </a>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($data->hasPages())
        <div class="pagination-container">
            <div class="pagination-info">
                Menampilkan {{ $data->firstItem() ?? 0 }} - {{ $data->lastItem() ?? 0 }} dari {{ $data->total() }} data
            </div>
            
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <!-- Previous Page Link -->
                    @if($data->onFirstPage())
                        <li class="pagination-item">
                            <span class="pagination-link disabled">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M15 18l-6-6 6-6"/>
                                </svg>
                            </span>
                        </li>
                    @else
                        <li class="pagination-item">
                            <a href="{{ $data->previousPageUrl() }}" class="pagination-link">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M15 18l-6-6 6-6"/>
                                </svg>
                            </a>
                        </li>
                    @endif

                    <!-- Page Numbers -->
                    @php
                        $start = max(1, $data->currentPage() - 2);
                        $end = min($data->lastPage(), $data->currentPage() + 2);
                    @endphp
                    
                    @for($page = $start; $page <= $end; $page++)
                        @if($page == $data->currentPage())
                            <li class="pagination-item">
                                <span class="pagination-link active">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination-item">
                                <a href="{{ $data->url($page) }}" class="pagination-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endfor

                    <!-- Next Page Link -->
                    @if($data->hasMorePages())
                        <li class="pagination-item">
                            <a href="{{ $data->nextPageUrl() }}" class="pagination-link">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 18l6-6-6-6"/>
                                </svg>
                            </a>
                        </li>
                    @else
                        <li class="pagination-item">
                            <span class="pagination-link disabled">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 18l6-6-6-6"/>
                                </svg>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>

            <!-- Page Jump Input -->
            <div class="page-input-container">
                <input type="number" id="pageInput" class="page-input" min="1" max="{{ $data->lastPage() }}" placeholder="Halaman">
                <button type="button" id="pageGoButton" class="page-go-button">Go</button>
            </div>
        </div>
    @endif
</div>

<script>
function confirmDelete(userName, tanggal, ruangNama) {
    return confirm(`Apakah Anda yakin ingin menghapus peminjaman ini?\n\nUser: ${userName}\nTanggal: ${tanggal}\nRuangan: ${ruangNama}\n\nTindakan ini tidak dapat dibatalkan.`);
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

    // Page jump functionality
    const pageInput = document.getElementById('pageInput');
    const pageGoButton = document.getElementById('pageGoButton');
    
    if (pageInput && pageGoButton) {
        pageGoButton.addEventListener('click', function() {
            const page = parseInt(pageInput.value);
            const totalPages = {{ $data->lastPage() ?? 1 }};
            
            if (page && page >= 1 && page <= totalPages) {
                // Build URL with page parameter
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('page', page);
                window.location.href = currentUrl.toString();
            } else {
                alert(`Masukkan nomor halaman antara 1 dan ${totalPages}`);
            }
        });
        
        pageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                pageGoButton.click();
            }
        });
    }
});
</script>
@endsection