@extends('layouts.app')

@section('content')
<style>
    .detail-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .detail-title {
        font-size: 24px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
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
    
    .detail-card {
        background-color: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        border: 1px solid #e2e8f0;
    }
    
    .detail-section {
        margin-bottom: 30px;
    }
    
    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .detail-item {
        margin-bottom: 15px;
    }
    
    .detail-label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }
    
    .detail-value {
        font-size: 15px;
        color: #1e293b;
        font-weight: 500;
    }
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
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
    
    .text-content {
        background-color: #f8fafc;
        border-radius: 8px;
        padding: 15px;
        margin-top: 5px;
        font-size: 14px;
        color: #4b5563;
        line-height: 1.5;
        border-left: 3px solid #e2e8f0;
    }
    
    .text-empty {
        color: #9ca3af;
        font-style: italic;
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
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        flex: 1;
        min-width: 150px;
        justify-content: center;
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
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        flex: 1;
        min-width: 150px;
        justify-content: center;
    }
    
    .reject-button:hover {
        background-color: #dc2626;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
    }
    
    .delete-button {
        background-color: #1f2937;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        width: 100%;
        justify-content: center;
    }
    
    .delete-button:hover {
        background-color: #111827;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(31, 41, 55, 0.2);
    }
    
    .action-form {
        flex: 1;
        min-width: 150px;
        margin: 0;
    }
    
    .status-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        margin-right: 8px;
    }
    
    .icon-pending {
        background-color: #fef3c7;
        color: #92400e;
    }
    
    .icon-approved {
        background-color: #d1fae5;
        color: #065f46;
    }
    
    .icon-rejected {
        background-color: #fee2e2;
        color: #991b1b;
    }
    
    @media (max-width: 768px) {
        .detail-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .back-button {
            width: 100%;
            justify-content: center;
        }
        
        .detail-grid {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .action-form {
            width: 100%;
        }
        
        .approve-button,
        .reject-button,
        .delete-button {
            width: 100%;
        }
        
        .detail-card {
            padding: 20px;
        }
    }
</style>

<div class="detail-container">
    <!-- Header -->
    <div class="detail-header">
        <h1 class="detail-title">Detail Peminjaman</h1>
        <a href="{{ route('admin.peminjaman.index') }}" class="back-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <!-- Detail Card -->
    <div class="detail-card">
        <!-- Informasi Peminjaman -->
        <div class="detail-section">
            <h3 class="section-title">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Informasi Peminjaman
            </h3>
            
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">ID Peminjaman</span>
                    <div class="detail-value">#{{ $p->id }}</div>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Status</span>
                    <div>
                        @if($p->status === 'pending')
                            <span class="status-badge badge-pending">
                                <span class="status-icon icon-pending">!</span>
                                Pending
                            </span>
                        @elseif($p->status === 'approved')
                            <span class="status-badge badge-approved">
                                <span class="status-icon icon-approved">✓</span>
                                Approved
                            </span>
                        @else
                            <span class="status-badge badge-rejected">
                                <span class="status-icon icon-rejected">✗</span>
                                Rejected
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi User -->
        <div class="detail-section">
            <h3 class="section-title">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Informasi User
            </h3>
            
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Nama User</span>
                    <div class="detail-value">{{ $p->user->name }}</div>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Email</span>
                    <div class="detail-value">{{ $p->user->email }}</div>
                </div>
            </div>
        </div>

        <!-- Informasi Lokasi -->
        <div class="detail-section">
            <h3 class="section-title">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Informasi Lokasi
            </h3>
            
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Gedung</span>
                    <div class="detail-value">{{ $p->ruang->gedung->nama }}</div>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Ruangan</span>
                    <div class="detail-value">{{ $p->ruang->nama }}</div>
                </div>
            </div>
        </div>

        <!-- Waktu Peminjaman -->
        <div class="detail-section">
            <h3 class="section-title">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Waktu Peminjaman
            </h3>
            
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Tanggal</span>
                    <div class="detail-value">{{ $p->tanggal }}</div>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Waktu</span>
                    <div class="detail-value">{{ $p->jam_mulai }} – {{ $p->jam_selesai }}</div>
                </div>
            </div>
        </div>

        <!-- Detail Lainnya -->
        <div class="detail-section">
            <h3 class="section-title">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Detail Lainnya
            </h3>
            
            <div class="detail-item">
                <span class="detail-label">Keperluan</span>
                @if($p->keperluan)
                    <div class="text-content">{{ $p->keperluan }}</div>
                @else
                    <div class="text-content text-empty">Tidak ada informasi keperluan</div>
                @endif
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Catatan</span>
                @if($p->catatan)
                    <div class="text-content">{{ $p->catatan }}</div>
                @else
                    <div class="text-content text-empty">Tidak ada catatan</div>
                @endif
            </div>
        </div>

        <!-- Action Section -->
        <div class="action-section">
            @if ($p->status === 'pending')
            <div class="action-buttons">
                <form method="POST" action="{{ route('admin.peminjaman.approve', $p->id) }}" class="action-form" onsubmit="return confirmApprove()">
                    @csrf
                    <button type="submit" class="approve-button">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>
                        Setujui Peminjaman
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.peminjaman.reject', $p->id) }}" class="action-form" onsubmit="return confirmReject()">
                    @csrf
                    <button type="submit" class="reject-button">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Tolak Peminjaman
                    </button>
                </form>
            </div>
            @endif

            <div style="margin-top: 20px;">
                <form method="POST" action="{{ route('admin.peminjaman.delete', $p->id) }}" class="action-form" onsubmit="return confirmDelete()">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Peminjaman
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmApprove() {
    return confirm('Apakah Anda yakin ingin menyetujui peminjaman ini?\n\nRuangan akan dipesan untuk user tersebut.');
}

function confirmReject() {
    return confirm('Apakah Anda yakin ingin menolak peminjaman ini?\n\nPeminjaman akan ditandai sebagai ditolak dan ruangan akan tersedia kembali.');
}

function confirmDelete() {
    return confirm('Apakah Anda yakin ingin menghapus peminjaman ini secara permanen?\n\nTindakan ini tidak dapat dibatalkan.');
}
</script>
@endsection