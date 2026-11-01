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
    
    .stats-section {
        margin-bottom: 40px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .stat-card {
        background-color: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: all 0.2s;
        border: 1px solid transparent;
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }
    
    .stat-number {
        font-size: 36px;
        font-weight: 700;
        margin: 10px 0;
        color: #1e293b;
    }
    
    .stat-label {
        color: #64748b;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .section-divider {
        height: 2px;
        background: linear-gradient(to right, #3b82f6, transparent);
        border: none;
        margin: 40px 0;
    }
    
    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .table-container {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
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
    }
    
    .data-table tbody tr:hover {
        background-color: #f8fafc;
    }
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        display: inline-block;
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
    
    .action-button {
        background-color: #3b82f6;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-block;
    }
    
    .action-button:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2);
    }
    
    .empty-row {
        text-align: center;
        padding: 40px !important;
        color: #64748b;
    }
    
    /* Pagination Styles */
    .pagination-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
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
    
    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .create-button {
            width: 100%;
            justify-content: center;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .data-table {
            display: block;
            overflow-x: auto;
        }
        
        .section-title {
            font-size: 16px;
        }
        
        .pagination-container {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }
        
        .pagination-info {
            order: -1;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">Dashboard Petugas</h1>
        <a href="{{ route('petugas.peminjaman.create') }}" class="create-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Buat Peminjaman Baru
        </a>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-card" style="border-left: 4px solid #f59e0b;">
                <div class="stat-number">{{ $pending }}</div>
                <div class="stat-label">Menunggu Verifikasi</div>
            </div>
            
            <div class="stat-card" style="border-left: 4px solid #10b981;">
                <div class="stat-number">{{ $approved }}</div>
                <div class="stat-label">Disetujui</div>
            </div>
            
            <div class="stat-card" style="border-left: 4px solid #ef4444;">
                <div class="stat-number">{{ $rejected }}</div>
                <div class="stat-label">Ditolak</div>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <hr class="section-divider">

    <!-- Pending Verifications -->
    <div class="section-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Pengajuan Menunggu Verifikasi
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>User</th>
                    <th>Gedung</th>
                    <th>Ruangan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Keperluan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menungguVerifikasi as $p)
                    <tr>
                        <td>{{ $p->user->email }}</td>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->gedung->nama }}</td>
                        <td>{{ $p->ruang->nama }}</td>
                        <td>{{ $p->tanggal }}</td>
                        <td>{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</td>
                        <td>{{ $p->keperluan }}</td>
                        <td>
                            <a href="{{ route('petugas.peminjaman.detail', $p->id) }}" class="action-button">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty-row">
                            Tidak ada pengajuan yang menunggu verifikasi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Divider -->
    <hr class="section-divider">

    <!-- All Bookings -->
    <div class="section-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
        Semua Peminjaman
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>User</th>
                    <th>Gedung</th>
                    <th>Ruangan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semuaPeminjaman as $p)
                    <tr>
                        <td>{{ $p->user->email }}</td>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->gedung->nama }}</td>
                        <td>{{ $p->ruang->nama }}</td>
                        <td>{{ $p->tanggal }}</td>
                        <td>{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</td>
                        <td>
                            @if ($p->status == 'pending')
                                <span class="status-badge badge-pending">Pending</span>
                            @elseif ($p->status == 'approved')
                                <span class="status-badge badge-approved">Approved</span>
                            @else
                                <span class="status-badge badge-rejected">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('petugas.peminjaman.detail', $p->id) }}" class="action-button">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty-row">
                            Belum ada data peminjaman
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($semuaPeminjaman->hasPages())
        <div class="pagination-container">
            <div class="pagination-info">
                Menampilkan {{ $semuaPeminjaman->firstItem() ?? 0 }} - {{ $semuaPeminjaman->lastItem() ?? 0 }} dari {{ $semuaPeminjaman->total() }} data
            </div>
            
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <!-- Previous Page Link -->
                    @if($semuaPeminjaman->onFirstPage())
                        <li class="pagination-item">
                            <span class="pagination-link disabled">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M15 18l-6-6 6-6"/>
                                </svg>
                            </span>
                        </li>
                    @else
                        <li class="pagination-item">
                            <a href="{{ $semuaPeminjaman->previousPageUrl() }}" class="pagination-link">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M15 18l-6-6 6-6"/>
                                </svg>
                            </a>
                        </li>
                    @endif

                    <!-- Page Numbers -->
                    @php
                        $start = max(1, $semuaPeminjaman->currentPage() - 2);
                        $end = min($semuaPeminjaman->lastPage(), $semuaPeminjaman->currentPage() + 2);
                    @endphp
                    
                    @for($page = $start; $page <= $end; $page++)
                        @if($page == $semuaPeminjaman->currentPage())
                            <li class="pagination-item">
                                <span class="pagination-link active">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination-item">
                                <a href="{{ $semuaPeminjaman->url($page) }}" class="pagination-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endfor

                    <!-- Next Page Link -->
                    @if($semuaPeminjaman->hasMorePages())
                        <li class="pagination-item">
                            <a href="{{ $semuaPeminjaman->nextPageUrl() }}" class="pagination-link">
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
        </div>
    @endif
</div>
@endsection