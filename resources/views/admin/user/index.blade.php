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
    
    .user-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    
    .user-name {
        font-weight: 600;
        color: #1e293b;
    }
    
    .user-id {
        font-size: 11px;
        color: #6b7280;
        font-family: 'SF Mono', Monaco, Consolas, monospace;
    }
    
    .user-email {
        color: #4b5563;
        font-size: 13px;
    }
    
    .role-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge-user {
        background-color: #dbeafe;
        color: #1d4ed8;
    }
    
    .badge-petugas {
        background-color: #fef3c7;
        color: #92400e;
    }
    
    .badge-admin {
        background-color: #d1fae5;
        color: #065f46;
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
    
    .stat-users .stat-icon {
        background-color: #dbeafe;
        color: #1d4ed8;
    }
    
    .stat-petugas .stat-icon {
        background-color: #fef3c7;
        color: #92400e;
    }
    
    .stat-admin .stat-icon {
        background-color: #d1fae5;
        color: #065f46;
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
        <h1 class="dashboard-title">Kelola User</h1>
        <div class="action-buttons">
            <a href="{{ route('admin.user.create') }}" class="create-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Tambah User
            </a>
            <a href="{{ route('admin.dashboard') }}" class="back-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-cards">
        <div class="stat-card stat-users">
            <div class="stat-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13 0a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/>
                </svg>
            </div>
            <div class="stat-content">
                <h3>Total User</h3>
                <p>{{ $totalUsers }}</p>
            </div>
        </div>
        
        <div class="stat-card stat-users">
            <div class="stat-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div class="stat-content">
                <h3>User Biasa</h3>
                <p>{{ $userCount }}</p>
            </div>
        </div>
        
        <div class="stat-card stat-petugas">
            <div class="stat-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <div class="stat-content">
                <h3>Petugas</h3>
                <p>{{ $petugasCount }}</p>
            </div>
        </div>
        
        <div class="stat-card stat-admin">
            <div class="stat-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5.121 17.804A7 7 0 0115 3a7 7 0 011.865 13.804M15 19c-3.314 0-6-2.686-6-6m9.75 1.043a7 7 0 00-7.5 0"/>
                </svg>
            </div>
            <div class="stat-content">
                <h3>Admin</h3>
                <p>{{ $adminCount }}</p>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        @if($users->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 30%;">User</th>
                        <th style="width: 30%;">Email</th>
                        <th style="width: 20%;">Role</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="user-name">{{ $user->name }}</div>
                                <div class="user-id">#{{ $user->id }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="user-email">{{ $user->email }}</div>
                        </td>
                        <td>
                            @if($user->role === 'user')
                                <span class="role-badge badge-user">User</span>
                            @elseif($user->role === 'petugas')
                                <span class="role-badge badge-petugas">Petugas</span>
                            @else
                                <span class="role-badge badge-admin">Admin</span>
                            @endif
                        </td>
                        <td class="action-buttons-cell">
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="edit-button">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.user.destroy', $user->id) }}" class="action-form" onsubmit="return confirmDelete('{{ $user->name }}', '{{ $user->email }}')">
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
                <div class="empty-icon">👤</div>
                <h3 class="empty-title">Belum Ada User</h3>
                <p class="empty-description">Tambahkan user baru untuk mulai mengelola akses sistem.</p>
                <a href="{{ route('admin.user.create') }}" class="create-button" style="display: inline-flex;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Tambah User Pertama
                </a>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="pagination-container">
            <div class="pagination-info">
                Menampilkan {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} user
            </div>
            
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <!-- Previous Page Link -->
                    @if($users->onFirstPage())
                        <li class="pagination-item">
                            <span class="pagination-link disabled">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M15 18l-6-6 6-6"/>
                                </svg>
                            </span>
                        </li>
                    @else
                        <li class="pagination-item">
                            <a href="{{ $users->previousPageUrl() }}" class="pagination-link">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M15 18l-6-6 6-6"/>
                                </svg>
                            </a>
                        </li>
                    @endif

                    <!-- Page Numbers -->
                    @php
                        $start = max(1, $users->currentPage() - 2);
                        $end = min($users->lastPage(), $users->currentPage() + 2);
                    @endphp
                    
                    @for($page = $start; $page <= $end; $page++)
                        @if($page == $users->currentPage())
                            <li class="pagination-item">
                                <span class="pagination-link active">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination-item">
                                <a href="{{ $users->url($page) }}" class="pagination-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endfor

                    <!-- Next Page Link -->
                    @if($users->hasMorePages())
                        <li class="pagination-item">
                            <a href="{{ $users->nextPageUrl() }}" class="pagination-link">
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
                <input type="number" id="pageInput" class="page-input" min="1" max="{{ $users->lastPage() }}" placeholder="Halaman">
                <button type="button" id="pageGoButton" class="page-go-button">Go</button>
            </div>
        </div>
    @endif
</div>

<script>
function confirmDelete(userName, userEmail) {
    return confirm(`Apakah Anda yakin ingin menghapus user "${userName}" (${userEmail})?\n\nSemua data peminjaman yang terkait dengan user ini juga akan terhapus. Tindakan ini tidak dapat dibatalkan.`);
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
            const totalPages = {{ $users->lastPage() ?? 1 }};
            
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