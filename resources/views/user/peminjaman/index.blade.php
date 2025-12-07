@extends('layouts.app')

@section('content')
<style>
    .list-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .list-title {
        font-size: 24px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }
    
    .add-button {
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
    
    .add-button:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }
    
    .success-alert {
        background-color: #d1fae5;
        color: #065f46;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 25px;
        border-left: 4px solid #10b981;
        font-size: 14px;
    }
    
    .empty-state {
        background-color: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 50px 20px;
        text-align: center;
        color: #64748b;
        margin: 40px 0;
    }
    
    .booking-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 30px;
    }
    
    .booking-card {
        background-color: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        transition: all 0.2s;
        position: relative;
    }
    
    .booking-card:hover {
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
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
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 10px;
    }
    
    .booking-details strong {
        color: #4b5563;
    }
    
    .status-badge {
        padding: 6px 14px;
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
    
    .notes-section {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #f1f5f9;
    }
    
    .notes-label {
        font-weight: 500;
        color: #4b5563;
        font-size: 13px;
        margin-bottom: 5px;
        display: block;
    }
    
    .notes-text {
        color: #64748b;
        font-size: 13px;
        line-height: 1.4;
    }
    
    .back-button {
        background-color: white;
        color: #3b82f6;
        border: 2px solid #3b82f6;
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
        background-color: #3b82f6;
        color: white;
    }
    
    @media (max-width: 768px) {
        .list-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .add-button, .back-button {
            width: 100%;
            justify-content: center;
        }
        
        .booking-header {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>

<div class="list-container">
    <!-- Header -->
    <div class="list-header">
        <h1 class="list-title">Daftar Peminjaman</h1>
        <a href="{{ route('user.peminjaman.create') }}" class="add-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Ajukan Peminjaman
        </a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Empty State -->
    @if ($data->count() == 0)
        <div class="empty-state">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 15px; color: #cbd5e1;">
                <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <h4 style="color: #475569; margin-bottom: 8px;">Belum Ada Peminjaman</h4>
            <p style="margin: 0;">Mulai dengan mengajukan peminjaman ruangan pertama Anda</p>
        </div>
    @else
        <!-- Booking List -->
        <div class="booking-list">
            @foreach ($data as $p)
                <div class="booking-card">
                    <div class="booking-header">
                        <h3 class="booking-title">{{ $p->gedung->nama }} - {{ $p->ruang->nama }}</h3>
                        @if ($p->status == 'approved')
                            <span class="status-badge badge-approved">Disetujui</span>
                        @elseif ($p->status == 'rejected')
                            <span class="status-badge badge-rejected">Ditolak</span>
                        @else
                            <span class="status-badge badge-pending">Pending</span>
                        @endif
                    </div>
                    
                    <div class="booking-details">
                        <div>📅 <strong>Tanggal:</strong> {{ $p->tanggal }}</div>
                        <div>⏰ <strong>Waktu:</strong> {{ $p->jam_mulai }} → {{ $p->jam_selesai }}</div>
                    </div>

                    @if ($p->catatan)
                        <div class="notes-section">
                            <span class="notes-label">📝 Catatan:</span>
                            <div class="notes-text">{{ $p->catatan }}</div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- Back Button -->
    <a href="{{ route('user.dashboard') }}" class="back-button">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali ke Dashboard
    </a>
</div>
@endsection