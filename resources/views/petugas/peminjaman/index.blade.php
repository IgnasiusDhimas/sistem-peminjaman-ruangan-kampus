@extends('layouts.app')

@section('content')
<style>
    .list-container {
        max-width: 1400px;
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
    
    .table-container {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }
    
    .table-header {
        background-color: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 15px 20px;
    }
    
    .table-title {
        font-size: 16px;
        font-weight: 600;
        color: #374151;
        margin: 0;
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
    
    .user-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .user-name {
        font-weight: 500;
        color: #1e293b;
    }
    
    .user-email {
        font-size: 12px;
        color: #6b7280;
    }
    
    .room-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .building-name {
        font-size: 12px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .room-name {
        font-weight: 500;
        color: #1e293b;
    }
    
    .time-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .date {
        font-weight: 500;
        color: #1e293b;
    }
    
    .time {
        font-size: 13px;
        color: #6b7280;
    }
    
    .purpose-text {
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #4b5563;
    }
    
    .action-button {
        background-color: #3b82f6;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
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
    
    .empty-state {
        background-color: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 50px 20px;
        text-align: center;
        color: #64748b;
        margin: 40px 0;
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
        
        .create-button {
            width: 100%;
            justify-content: center;
        }
        
        .data-table {
            display: block;
            overflow-x: auto;
        }
        
        .purpose-text {
            max-width: 150px;
        }
        
        .back-button {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="list-container">
    <!-- Header -->
    <div class="list-header">
        <h1 class="list-title">Daftar Peminjaman Pending</h1>
        <a href="{{ route('petugas.peminjaman.create') }}" class="create-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Buat Peminjaman Baru
        </a>
    </div>

    @if($peminjaman->count() > 0)
        <!-- Table Container -->
        <div class="table-container">
            <div class="table-header">
                <h3 class="table-title">Menunggu Verifikasi ({{ $peminjaman->count() }})</h3>
            </div>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Lokasi</th>
                        <th>Tanggal & Waktu</th>
                        <th>Keperluan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $item)
                        <tr>
                            <!-- User Column -->
                            <td>
                                <div class="user-info">
                                    <span class="user-name">{{ $item->user->name }}</span>
                                    <span class="user-email">{{ $item->user->email }}</span>
                                </div>
                            </td>
                            
                            <!-- Location Column -->
                            <td>
                                <div class="room-info">
                                    <span class="building-name">{{ $item->ruang->gedung->nama }}</span>
                                    <span class="room-name">{{ $item->ruang->nama }}</span>
                                </div>
                            </td>
                            
                            <!-- Date & Time Column -->
                            <td>
                                <div class="time-info">
                                    <span class="date">{{ $item->tanggal }}</span>
                                    <span class="time">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</span>
                                </div>
                            </td>
                            
                            <!-- Purpose Column -->
                            <td>
                                <div class="purpose-text" title="{{ $item->keperluan }}">
                                    {{ $item->keperluan }}
                                </div>
                            </td>
                            
                            <!-- Action Column -->
                            <td>
                                <a href="{{ route('petugas.peminjaman.detail', $item->id) }}" class="action-button">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    Detail
                                </a>
                                 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 15px; color: #cbd5e1;">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h4 style="color: #475569; margin-bottom: 8px;">Tidak Ada Peminjaman Pending</h4>
            <p style="margin: 0; margin-bottom: 20px;">Semua peminjaman sudah diproses</p>
            <a href="{{ route('petugas.peminjaman.create') }}" class="create-button" style="display: inline-flex;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Buat Peminjaman Baru
            </a>
        </div>
    @endif

    <!-- Back Button -->
    <a href="{{ route('petugas.dashboard') }}" class="back-button">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali ke Dashboard
    </a>
</div>
@endsection