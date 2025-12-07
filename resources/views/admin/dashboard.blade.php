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
    
    .stats-section {
        margin-bottom: 40px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
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
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
    }
    
    .stat-card:nth-child(1)::before { background-color: #3b82f6; }
    .stat-card:nth-child(2)::before { background-color: #f59e0b; }
    .stat-card:nth-child(3)::before { background-color: #10b981; }
    .stat-card:nth-child(4)::before { background-color: #8b5cf6; }
    .stat-card:nth-child(5)::before { background-color: #ef4444; }
    
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
    
    .shortcut-section {
        margin-bottom: 40px;
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
    
    .shortcut-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }
    
    .shortcut-card {
        background-color: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        text-decoration: none;
        color: inherit;
        transition: all 0.2s;
        border: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .shortcut-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        border-color: #3b82f6;
        background-color: #f8fafc;
    }
    
    .shortcut-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }
    
    .shortcut-card:nth-child(1) .shortcut-icon { background-color: #dbeafe; color: #1d4ed8; }
    .shortcut-card:nth-child(2) .shortcut-icon { background-color: #fef3c7; color: #92400e; }
    .shortcut-card:nth-child(3) .shortcut-icon { background-color: #d1fae5; color: #065f46; }
    .shortcut-card:nth-child(4) .shortcut-icon { background-color: #ede9fe; color: #5b21b6; }
    
    .shortcut-title {
        font-size: 16px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }
    
    .shortcut-desc {
        font-size: 13px;
        color: #64748b;
        margin: 0;
        line-height: 1.4;
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
    
    .empty-row {
        text-align: center;
        padding: 40px !important;
        color: #64748b;
    }
    
    .empty-icon {
        font-size: 48px;
        margin-bottom: 10px;
        opacity: 0.3;
    }
    
    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .shortcut-grid {
            grid-template-columns: 1fr;
        }
        
        .data-table {
            display: block;
            overflow-x: auto;
        }
        
        .section-title {
            font-size: 16px;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">Dashboard Admin</h1>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $totalGedung }}</div>
                <div class="stat-label">Total Gedung</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">{{ $totalRuang }}</div>
                <div class="stat-label">Total Ruangan</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">{{ $totalPeminjaman }}</div>
                <div class="stat-label">Total Peminjaman</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">{{ $totalUser }}</div>
                <div class="stat-label">Total User</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">{{ $pending }}</div>
                <div class="stat-label">Menunggu Persetujuan</div>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <hr class="section-divider">

    <!-- Shortcut Menu -->
    <div class="shortcut-section">
        <div class="section-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Menu Cepat
        </div>

        <div class="shortcut-grid">
            <a href="{{ route('admin.peminjaman.index') }}" class="shortcut-card">
                <div class="shortcut-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="shortcut-title">Kelola Peminjaman</h3>
                <p class="shortcut-desc">Approve / Reject permohonan peminjaman ruangan</p>
            </a>
            
            <a href="{{ route('admin.gedung.index') }}" class="shortcut-card">
                <div class="shortcut-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="shortcut-title">Kelola Gedung</h3>
                <p class="shortcut-desc">Tambah, edit, dan hapus data gedung kampus</p>
            </a>
            
            <a href="{{ route('admin.ruang.index') }}" class="shortcut-card">
                <div class="shortcut-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <h3 class="shortcut-title">Kelola Ruangan</h3>
                <p class="shortcut-desc">Atur ruangan per gedung dan fasilitasnya</p>
            </a>
            
            <a href="{{ route('admin.user.index') }}" class="shortcut-card">
                <div class="shortcut-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13 0a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/>
                    </svg>
                </div>
                <h3 class="shortcut-title">Kelola User</h3>
                <p class="shortcut-desc">Tambah, hapus, dan edit user sistem</p>
            </a>
        </div>
    </div>

    <!-- Divider -->
    <hr class="section-divider">

    <!-- Latest Bookings -->
    <div class="section-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Peminjaman Terbaru
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>User</th>
                    <th>Ruangan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latest as $item)
                    <tr>
                        <td>{{ $item->user->email }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->gedung->nama }} - {{ $item->ruang->nama }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>
                            @if ($item->status == 'pending')
                                <span class="status-badge badge-pending">Pending</span>
                            @elseif ($item->status == 'approved')
                                <span class="status-badge badge-approved">Approved</span>
                            @else
                                <span class="status-badge badge-rejected">Rejected</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-row">
                            <div class="empty-icon">📭</div>
                            <p>Belum ada data peminjaman</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection