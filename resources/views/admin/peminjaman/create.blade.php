@extends('layouts.app')

@section('content')
<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .form-title {
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
    
    .form-card {
        background-color: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        border: 1px solid #e2e8f0;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .form-label.required::after {
        content: " *";
        color: #ef4444;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        color: #374151;
        transition: all 0.2s;
        background-color: white;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .form-control::placeholder {
        color: #9ca3af;
    }
    
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }
    
    textarea.form-control {
        min-height: 100px;
        resize: vertical;
        font-family: inherit;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #e5e7eb;
    }
    
    .submit-button {
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
    }
    
    .submit-button:hover {
        background-color: #059669;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }
    
    .submit-button:active {
        transform: translateY(0);
    }
    
    .cancel-button {
        background-color: white;
        color: #374151;
        border: 1px solid #d1d5db;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .cancel-button:hover {
        background-color: #f9fafb;
        border-color: #9ca3af;
    }
    
    .form-hint {
        font-size: 12px;
        color: #6b7280;
        margin-top: 6px;
        font-style: italic;
    }
    
    .form-error {
        color: #ef4444;
        font-size: 12px;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .form-error::before {
        content: "⚠";
        font-size: 10px;
    }
    
    .alert-message {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .alert-danger {
        background-color: #fee2e2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }
    
    .alert-danger::before {
        content: "⚠";
        font-weight: bold;
    }
    
    .loading-indicator {
        display: none;
        text-align: center;
        padding: 10px;
        color: #6b7280;
        font-size: 12px;
    }
    
    .loading-indicator.active {
        display: block;
    }
    
    .loading-spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid #e5e7eb;
        border-top: 2px solid #3b82f6;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-right: 8px;
        vertical-align: middle;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .ruangan-info {
        background-color: #f8fafc;
        border-radius: 8px;
        padding: 12px 15px;
        margin-top: 10px;
        border-left: 3px solid #3b82f6;
        font-size: 13px;
        color: #4b5563;
    }
    
    @media (max-width: 768px) {
        .form-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .submit-button,
        .cancel-button {
            width: 100%;
            justify-content: center;
        }
        
        .form-card {
            padding: 20px;
        }
    }
</style>

<div class="form-container">
    <!-- Header -->
    <div class="form-header">
        <h1 class="form-title">Tambah Peminjaman Baru</h1>
        <a href="{{ route('admin.peminjaman.index') }}" class="back-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert-message alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form Card -->
    <div class="form-card">
        <form method="POST" action="{{ route('admin.peminjaman.store') }}" id="peminjamanForm">
            @csrf
            
            <!-- User Selection -->
            <div class="form-group">
                <label for="user_id" class="form-label required">Pilih User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }} - {{ $u->email }}</option>
                    @endforeach
                </select>
                <div class="form-hint">Pilih user yang akan melakukan peminjaman</div>
                @error('user_id')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Location Selection Grid -->
            <div class="form-grid">
                <!-- Gedung Selection -->
                <div class="form-group">
                    <label for="gedung_id" class="form-label required">Pilih Gedung</label>
                    <select name="gedung_id" id="gedung" class="form-control" required>
                        <option value="">-- Pilih Gedung --</option>
                        @foreach($gedung as $g)
                            <option value="{{ $g->id }}">{{ $g->nama }}</option>
                        @endforeach
                    </select>
                    @error('gedung_id')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Ruangan Selection -->
                <div class="form-group">
                    <label for="ruang_id" class="form-label required">Pilih Ruangan</label>
                    <select name="ruang_id" id="ruang" class="form-control" required disabled>
                        <option value="">-- Pilih Gedung Terlebih Dahulu --</option>
                    </select>
                    <div class="loading-indicator" id="ruangLoading">
                        <span class="loading-spinner"></span> Memuat ruangan...
                    </div>
                    <div id="ruanganInfo" class="ruangan-info" style="display: none;">
                        Pilih ruangan untuk melihat informasi kapasitas
                    </div>
                    @error('ruang_id')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <!-- Date and Time Grid -->
            <div class="form-grid">
                <!-- Tanggal -->
                <div class="form-group">
                    <label for="tanggal" class="form-label required">Tanggal Peminjaman</label>
                    <input 
                        type="date" 
                        id="tanggal"
                        name="tanggal" 
                        class="form-control"
                        required
                        min="{{ date('Y-m-d') }}"
                    >
                    @error('tanggal')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Waktu Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <!-- Jam Mulai -->
                    <div class="form-group">
                        <label for="jam_mulai" class="form-label required">Jam Mulai</label>
                        <input 
                            type="time" 
                            id="jam_mulai"
                            name="jam_mulai" 
                            class="form-control"
                            required
                        >
                        @error('jam_mulai')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Jam Selesai -->
                    <div class="form-group">
                        <label for="jam_selesai" class="form-label required">Jam Selesai</label>
                        <input 
                            type="time" 
                            id="jam_selesai"
                            name="jam_selesai" 
                            class="form-control"
                            required
                        >
                        @error('jam_selesai')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Keperluan -->
            <div class="form-group">
                <label for="keperluan" class="form-label required">Keperluan Peminjaman</label>
                <textarea 
                    id="keperluan"
                    name="keperluan" 
                    class="form-control" 
                    placeholder="Jelaskan keperluan peminjaman ruangan..."
                    rows="3"
                    required
                ></textarea>
                <div class="form-hint">Deskripsikan kegiatan yang akan dilaksanakan</div>
                @error('keperluan')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Catatan -->
            <div class="form-group">
                <label for="catatan" class="form-label">Catatan (Opsional)</label>
                <textarea 
                    id="catatan"
                    name="catatan" 
                    class="form-control" 
                    placeholder="Tambahkan catatan atau informasi tambahan jika diperlukan..."
                    rows="2"
                ></textarea>
                <div class="form-hint">Catatan internal untuk admin</div>
                @error('catatan')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="submit-button">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                        <path d="M17 21v-8H7v8M7 3v5h8"/>
                    </svg>
                    Simpan Peminjaman
                </button>
                
                <a href="{{ route('admin.peminjaman.index') }}" class="cancel-button">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const gedungSelect = document.getElementById('gedung');
    const ruangSelect = document.getElementById('ruang');
    const ruangLoading = document.getElementById('ruangLoading');
    const ruanganInfo = document.getElementById('ruanganInfo');
    const tanggalInput = document.getElementById('tanggal');
    
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    if (tanggalInput) {
        tanggalInput.min = today;
        if (!tanggalInput.value) {
            tanggalInput.value = today;
        }
    }
    
    // Set default time values
    const jamMulai = document.getElementById('jam_mulai');
    const jamSelesai = document.getElementById('jam_selesai');
    
    if (jamMulai && !jamMulai.value) {
        jamMulai.value = '08:00';
    }
    if (jamSelesai && !jamSelesai.value) {
        jamSelesai.value = '10:00';
    }
    
    // Auto-focus on user select
    const userSelect = document.getElementById('user_id');
    if (userSelect) {
        userSelect.focus();
    }
    
    // Gedung change event
    gedungSelect.addEventListener('change', function () {
        const gedungId = this.value;
        ruangSelect.innerHTML = '<option value="">-- Memuat ruangan... --</option>';
        ruangSelect.disabled = true;
        ruangLoading.classList.add('active');
        ruanganInfo.style.display = 'none';
        
        if (gedungId) {
            fetch('{{ route("admin.ajax.ruangan") }}?gedung_id=' + gedungId)
                .then(response => response.json())
                .then(data => {
                    ruangSelect.innerHTML = '<option value="">-- Pilih Ruangan --</option>';
                    
                    if (data.length > 0) {
                        data.forEach(r => {
                            const option = document.createElement('option');
                            option.value = r.id;
                            option.textContent = `${r.nama} — Kapasitas: ${r.kapasitas} orang`;
                            option.setAttribute('data-kapasitas', r.kapasitas);
                            ruangSelect.appendChild(option);
                        });
                        ruangSelect.disabled = false;
                    } else {
                        ruangSelect.innerHTML = '<option value="">-- Tidak ada ruangan tersedia --</option>';
                    }
                    
                    ruangLoading.classList.remove('active');
                })
                .catch(error => {
                    console.error('Error:', error);
                    ruangSelect.innerHTML = '<option value="">-- Error memuat ruangan --</option>';
                    ruangLoading.classList.remove('active');
                });
        } else {
            ruangSelect.innerHTML = '<option value="">-- Pilih Gedung Terlebih Dahulu --</option>';
            ruangSelect.disabled = true;
            ruangLoading.classList.remove('active');
        }
    });
    
    // Ruangan change event
    ruangSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const kapasitas = selectedOption.getAttribute('data-kapasitas');
        
        if (kapasitas) {
            ruanganInfo.textContent = `Kapasitas ruangan: ${kapasitas} orang`;
            ruanganInfo.style.display = 'block';
        } else {
            ruanganInfo.style.display = 'none';
        }
    });
    
    // Form validation
    const form = document.getElementById('peminjamanForm');
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Validate time
        if (jamMulai && jamSelesai) {
            if (jamMulai.value >= jamSelesai.value) {
                isValid = false;
                alert('Jam selesai harus setelah jam mulai');
                e.preventDefault();
            }
        }
        
        // Validate date
        if (tanggalInput) {
            const selectedDate = new Date(tanggalInput.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            if (selectedDate < today) {
                isValid = false;
                alert('Tanggal peminjaman tidak boleh di masa lalu');
                e.preventDefault();
            }
        }
        
        if (!isValid) {
            e.preventDefault();
        }
    });
});
</script>
@endsection