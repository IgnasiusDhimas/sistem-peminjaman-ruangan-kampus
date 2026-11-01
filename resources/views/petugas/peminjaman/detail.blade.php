@extends('layouts.app')

@section('content')
<style>
    .detail-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .detail-header {
        margin-bottom: 30px;
    }
    
    .detail-title {
        font-size: 24px;
        font-weight: 600;
        color: #1e293b;
        margin: 0 0 10px 0;
    }
    
    .detail-subtitle {
        color: #64748b;
        font-size: 14px;
    }
    
    .detail-card {
        background-color: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    
    .detail-section {
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .detail-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .info-item {
        margin-bottom: 15px;
    }
    
    .info-label {
        display: block;
        font-weight: 500;
        color: #4b5563;
        font-size: 13px;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .info-value {
        color: #1e293b;
        font-size: 15px;
        font-weight: 500;
    }
    
    .info-value.email {
        color: #3b82f6;
        word-break: break-all;
    }
    
    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
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
    
    .purpose-box {
        background-color: #f8fafc;
        border-radius: 8px;
        padding: 15px;
        margin-top: 10px;
        border-left: 4px solid #3b82f6;
    }
    
    .purpose-text {
        color: #4b5563;
        font-size: 15px;
        line-height: 1.6;
        white-space: pre-line;
    }
    
    .action-section {
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #e5e7eb;
    }
    
    .action-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .approve-button {
        background-color: #10b981;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .approve-button:hover {
        background-color: #059669;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }
    
    .reject-button {
        background-color: #ef4444;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .reject-button:hover {
        background-color: #dc2626;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
    }
    
    .back-button {
        background-color: white;
        color: #4b5563;
        border: 2px solid #d1d5db;
        padding: 10px 22px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .back-button:hover {
        background-color: #f3f4f6;
        border-color: #9ca3af;
    }
    
    @media (max-width: 768px) {
        .detail-container {
            padding: 15px;
        }
        
        .detail-card {
            padding: 20px;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .approve-button, .reject-button, .back-button {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="detail-container">
    <!-- Header -->
    <div class="detail-header">
        <h1 class="detail-title">Detail Peminjaman</h1>
        <p class="detail-subtitle">Lihat detail peminjaman ruangan</p>
    </div>

    <div class="detail-card">
        <!-- Informasi Peminjam -->
        <div class="detail-section">
            <h3 class="section-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Informasi Peminjam
            </h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Nama Peminjam</span>
                    <div class="info-value">{{ $p->user->name }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">Email</span>
                    <div class="info-value email">{{ $p->user->email }}</div>
                </div>
            </div>
        </div>

        <!-- Informasi Ruangan -->
        <div class="detail-section">
            <h3 class="section-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Informasi Ruangan
            </h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Gedung</span>
                    <div class="info-value">{{ $p->ruang->gedung->nama }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">Ruangan</span>
                    <div class="info-value">{{ $p->ruang->nama }}</div>
                </div>
            </div>
        </div>

        <!-- Waktu Peminjaman -->
        <div class="detail-section">
            <h3 class="section-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Waktu Peminjaman
            </h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Tanggal</span>
                    <div class="info-value">{{ $p->tanggal }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">Waktu</span>
                    <div class="info-value">{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</div>
                </div>
            </div>
        </div>

        <!-- Keperluan -->
        <div class="detail-section">
            <h3 class="section-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Keperluan
            </h3>
            <div class="purpose-box">
                <div class="purpose-text">{{ $p->keperluan }}</div>
            </div>
        </div>

        <!-- Status -->
        <div class="detail-section">
            <h3 class="section-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Status Peminjaman
            </h3>
            <div class="info-item">
                @if ($p->status === 'pending')
                    <span class="status-badge badge-pending">Pending</span>
                @elseif ($p->status === 'approved')
                    <span class="status-badge badge-approved">Approved</span>
                @else
                    <span class="status-badge badge-rejected">Rejected</span>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        @if ($p->status === 'pending')
        <div class="action-section">
            <div class="action-buttons">
                <!-- APPROVE -->
                <form action="{{ route('petugas.peminjaman.approve', $p->id) }}" method="POST" class="action-form">
                    @csrf
                    <button type="submit" class="approve-button" 
                            onclick="return confirm('Setujui peminjaman ini?')">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 6L9 17l-5-5"/>
                        </svg>
                        Setujui Peminjaman
                    </button>
                </form>

                <!-- REJECT -->
                <form action="{{ route('petugas.peminjaman.reject', $p->id) }}" method="POST" class="action-form">
                    @csrf
                    <button type="submit" class="reject-button" 
                            onclick="return confirm('Tolak peminjaman ini?')">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 6L6 18M6 6l12 12"/>
                        </svg>
                        Tolak Peminjaman
                    </button>
                </form>
                
            </div>
        </div>
        @endif

        <!-- Back Button -->
        <div class="action-section">
            <a href="{{ route('petugas.peminjaman.index') }}" class="back-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection