@extends('layouts.app')

@section('content')
<style>
    .dashboard-container {
        max-width: 1200px;
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
    }
    
    .btn-primary {
        background-color: #3b82f6;
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
    
    .btn-primary:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }
    
    .btn-outline {
        background-color: white;
        color: #3b82f6;
        border: 2px solid #3b82f6;
        padding: 8px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .btn-outline:hover {
        background-color: #3b82f6;
        color: white;
    }
    
    .section-divider {
        height: 2px;
        background: linear-gradient(to right, #3b82f6, transparent);
        border: none;
        margin: 30px 0;
    }
    
    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .empty-state {
        background-color: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 40px 20px;
        text-align: center;
        color: #64748b;
    }
    
    .booking-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .booking-card {
        background-color: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        transition: all 0.2s;
    }
    
    .booking-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }
    
    .booking-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 10px;
    }
    
    .booking-title {
        font-size: 16px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }
    
    .booking-details {
        display: flex;
        flex-direction: column;
        gap: 6px;
        color: #64748b;
        font-size: 14px;
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
    
    .notes {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #f1f5f9;
        color: #64748b;
        font-size: 13px;
    }
    
    .notes strong {
        color: #4b5563;
    }
    
    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .action-buttons {
            width: 100%;
            flex-direction: column;
        }
        
        .btn-primary, .btn-outline {
            width: 100%;
            justify-content: center;
        }
        
        .booking-header {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">Dashboard User</h1>
        <div class="action-buttons">
            <a href="{{ route('user.peminjaman.create') }}" class="btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Ajukan Peminjaman
            </a>
            <a href="{{ route('user.peminjaman.index') }}" class="btn-outline">
                Lihat Semua
            </a>
        </div>
    </div>

    <!-- Divider -->
    <hr class="section-divider">

    <!-- PEMINJAMAN AKTIF -->
    <div class="section-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        Peminjaman Aktif
    </div>

    @if ($active->count() == 0)
        <div class="empty-state">
            Tidak ada peminjaman aktif saat ini
        </div>
    @else
        <div class="booking-list">
            @foreach ($active as $a)
                <div class="booking-card">
                    <div class="booking-header">
                        <h3 class="booking-title">{{ $a->gedung->nama }} - {{ $a->ruang->nama }}</h3>
                        <span class="status-badge badge-pending">Pending</span>
                    </div>
                    <div class="booking-details">
                        <div>📅 Tanggal: {{ $a->tanggal }}</div>
                        <div>⏰ Waktu: {{ $a->jam_mulai }} - {{ $a->jam_selesai }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Divider -->
    <hr class="section-divider">

    <!-- RIWAYAT -->
    <div class="section-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Riwayat Peminjaman
    </div>

    @if ($riwayat->count() == 0)
        <div class="empty-state">
            Belum ada riwayat peminjaman
        </div>
    @else
        <div class="booking-list">
            @foreach ($riwayat as $r)
                <div class="booking-card">
                    <div class="booking-header">
                        <h3 class="booking-title">{{ $r->gedung->nama }} - {{ $r->ruang->nama }}</h3>
                        @if ($r->status == 'approved')
                            <span class="status-badge badge-approved">Disetujui</span>
                        @elseif ($r->status == 'rejected')
                            <span class="status-badge badge-rejected">Ditolak</span>
                        @else
                            <span class="status-badge badge-pending">Pending</span>
                        @endif
                    </div>
                    <div class="booking-details">
                        <div>📅 {{ $r->tanggal }}</div>
                        <div>⏰ {{ $r->jam_mulai }} → {{ $r->jam_selesai }}</div>
                    </div>
                    @if ($r->catatan)
                        <div class="notes">
                            <strong>Catatan:</strong> {{ $r->catatan }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection