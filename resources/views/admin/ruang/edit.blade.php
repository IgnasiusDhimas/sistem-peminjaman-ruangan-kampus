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
        background-color: #3b82f6;
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
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
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
    
    .delete-button {
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
        margin-left: auto;
    }
    
    .delete-button:hover {
        background-color: #dc2626;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
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
    
    .ruang-info {
        background-color: #f8fafc;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 25px;
        border-left: 4px solid #3b82f6;
    }
    
    .ruang-info-title {
        font-size: 12px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }
    
    .ruang-info-content {
        font-size: 14px;
        color: #1e293b;
        font-weight: 500;
    }
    
    .capacity-input-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .capacity-input {
        flex: 1;
    }
    
    .capacity-unit {
        color: #6b7280;
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
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
        .cancel-button,
        .delete-button {
            width: 100%;
            justify-content: center;
        }
        
        .delete-button {
            margin-left: 0;
            margin-top: 10px;
        }
        
        .form-card {
            padding: 20px;
        }
        
        .capacity-input-container {
            flex-direction: column;
            align-items: stretch;
        }
        
        .capacity-unit {
            text-align: center;
            margin-top: 5px;
        }
    }
</style>

<div class="form-container">
    <!-- Header -->
    <div class="form-header">
        <h1 class="form-title">Edit Ruangan</h1>
        <a href="{{ route('admin.ruang.index') }}" class="back-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <!-- Ruang Info -->
        <div class="ruang-info">
            <div class="ruang-info-title">ID Ruangan</div>
            <div class="ruang-info-content">#{{ $ruang->id }}</div>
        </div>
        
        <form method="POST" action="{{ route('admin.ruang.update', $ruang->id) }}" id="editRuangForm">
            @csrf
            @method('PUT')
            
            <!-- Nama Ruangan Field -->
            <div class="form-group">
                <label for="nama" class="form-label required">Nama Ruangan</label>
                <input 
                    type="text" 
                    id="nama"
                    name="nama" 
                    class="form-control" 
                    placeholder="Contoh: Ruang Meeting, Laboratorium Komputer, Aula, dll."
                    value="{{ old('nama', $ruang->nama) }}"
                    required
                    maxlength="100"
                >
                <div class="form-hint">Perbarui nama ruangan yang jelas dan mudah dikenali</div>
                @error('nama')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Gedung Selection -->
            <div class="form-group">
                <label for="gedung_id" class="form-label required">Pilih Gedung</label>
                <select name="gedung_id" id="gedung_id" class="form-control" required>
                    <option value="">-- Pilih Gedung --</option>
                    @foreach($gedungs as $g)
                        <option value="{{ $g->id }}" {{ $ruang->gedung_id == $g->id ? 'selected' : '' }}>
                            {{ $g->nama }}
                        </option>
                    @endforeach
                </select>
                <div class="form-hint">Pilih gedung tempat ruangan ini berada</div>
                @error('gedung_id')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Kapasitas Field -->
            <div class="form-group">
                <label for="kapasitas" class="form-label required">Kapasitas Ruangan</label>
                <div class="capacity-input-container">
                    <input 
                        type="number" 
                        id="kapasitas"
                        name="kapasitas" 
                        class="form-control capacity-input"
                        placeholder="50"
                        value="{{ old('kapasitas', $ruang->kapasitas) }}"
                        required
                        min="1"
                        max="1000"
                        step="1"
                    >
                    <span class="capacity-unit">orang</span>
                </div>
                <div class="form-hint">Perbarui jumlah maksimal orang yang dapat menempati ruangan ini</div>
                @error('kapasitas')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Optional Fields Grid -->
            <!-- CATATAN: Jika database memiliki field fasilitas dan keterangan -->
            @php
                $hasFasilitas = isset($ruang->fasilitas);
                $hasKeterangan = isset($ruang->keterangan);
            @endphp
            
            @if($hasFasilitas || $hasKeterangan)
            <div class="form-grid">
                <!-- Fasilitas (jika ada) -->
                @if($hasFasilitas)
                <div class="form-group">
                    <label for="fasilitas" class="form-label">Fasilitas (Opsional)</label>
                    <textarea 
                        id="fasilitas"
                        name="fasilitas" 
                        class="form-control" 
                        placeholder="Contoh: AC, Proyektor, Papan Tulis, Sound System, dll."
                        rows="3"
                        maxlength="255"
                    >{{ old('fasilitas', $ruang->fasilitas) }}</textarea>
                    <div class="form-hint">Daftar fasilitas yang tersedia di ruangan ini</div>
                    @error('fasilitas')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                @endif
                
                <!-- Keterangan (jika ada) -->
                @if($hasKeterangan)
                <div class="form-group">
                    <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                    <textarea 
                        id="keterangan"
                        name="keterangan" 
                        class="form-control" 
                        placeholder="Informasi tambahan tentang ruangan"
                        rows="3"
                        maxlength="255"
                    >{{ old('keterangan', $ruang->keterangan) }}</textarea>
                    <div class="form-hint">Catatan atau informasi penting lainnya</div>
                    @error('keterangan')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                @endif
            </div>
            @endif
            
            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="submit-button">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                        <path d="M17 21v-8H7v8M7 3v5h8"/>
                    </svg>
                    Update Ruangan
                </button>
                
                <a href="{{ route('admin.ruang.index') }}" class="cancel-button">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                
                <button type="button" class="delete-button" onclick="confirmDelete()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </div>
        </form>
        
        <!-- Delete Form -->
        <form method="POST" action="{{ route('admin.ruang.destroy', $ruang->id) }}" id="deleteForm" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const namaInput = document.getElementById('nama');
    const gedungSelect = document.getElementById('gedung_id');
    const kapasitasInput = document.getElementById('kapasitas');
    const form = document.getElementById('editRuangForm');
    
    // Auto-focus on nama input
    if (namaInput) {
        namaInput.focus();
        namaInput.select();
    }
    
    // Character counter for fasilitas (if exists)
    const fasilitasInput = document.getElementById('fasilitas');
    if (fasilitasInput) {
        const counter = document.createElement('div');
        counter.className = 'form-hint';
        counter.style.textAlign = 'right';
        counter.textContent = `${fasilitasInput.value.length}/255 karakter`;
        fasilitasInput.parentNode.insertBefore(counter, fasilitasInput.nextSibling);
        
        fasilitasInput.addEventListener('input', function() {
            counter.textContent = `${this.value.length}/255 karakter`;
            
            if (this.value.length > 255) {
                counter.style.color = '#ef4444';
            } else {
                counter.style.color = '#6b7280';
            }
        });
    }
    
    // Character counter for keterangan (if exists)
    const keteranganInput = document.getElementById('keterangan');
    if (keteranganInput) {
        const counter = document.createElement('div');
        counter.className = 'form-hint';
        counter.style.textAlign = 'right';
        counter.textContent = `${keteranganInput.value.length}/255 karakter`;
        keteranganInput.parentNode.insertBefore(counter, keteranganInput.nextSibling);
        
        keteranganInput.addEventListener('input', function() {
            counter.textContent = `${this.value.length}/255 karakter`;
            
            if (this.value.length > 255) {
                counter.style.color = '#ef4444';
            } else {
                counter.style.color = '#6b7280';
            }
        });
    }
    
    // Form validation
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Validate nama
        if (!namaInput.value.trim()) {
            isValid = false;
            namaInput.style.borderColor = '#ef4444';
            if (!namaInput.nextElementSibling.classList.contains('form-error')) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'form-error';
                errorDiv.textContent = 'Nama ruangan harus diisi';
                namaInput.parentNode.insertBefore(errorDiv, namaInput.nextSibling);
            }
        } else {
            namaInput.style.borderColor = '#10b981';
        }
        
        // Validate gedung
        if (!gedungSelect.value) {
            isValid = false;
            gedungSelect.style.borderColor = '#ef4444';
            if (!gedungSelect.nextElementSibling.classList.contains('form-error')) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'form-error';
                errorDiv.textContent = 'Pilih gedung terlebih dahulu';
                gedungSelect.parentNode.insertBefore(errorDiv, gedungSelect.nextSibling);
            }
        } else {
            gedungSelect.style.borderColor = '#10b981';
        }
        
        // Validate kapasitas
        if (!kapasitasInput.value || parseInt(kapasitasInput.value) < 1) {
            isValid = false;
            kapasitasInput.style.borderColor = '#ef4444';
            if (!kapasitasInput.parentNode.nextElementSibling.classList.contains('form-error')) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'form-error';
                errorDiv.textContent = 'Kapasitas minimal 1 orang';
                kapasitasInput.parentNode.parentNode.insertBefore(errorDiv, kapasitasInput.parentNode.nextSibling);
            }
        } else {
            kapasitasInput.style.borderColor = '#10b981';
        }
        
        if (!isValid) {
            e.preventDefault();
        }
    });
    
    // Real-time validation for nama
    namaInput.addEventListener('input', function() {
        if (this.value.trim()) {
            this.style.borderColor = '#10b981';
            const error = this.parentNode.querySelector('.form-error');
            if (error) error.remove();
        } else {
            this.style.borderColor = '#ef4444';
        }
    });
    
    // Real-time validation for gedung
    gedungSelect.addEventListener('change', function() {
        if (this.value) {
            this.style.borderColor = '#10b981';
            const error = this.parentNode.querySelector('.form-error');
            if (error) error.remove();
        } else {
            this.style.borderColor = '#ef4444';
        }
    });
    
    // Real-time validation for kapasitas
    kapasitasInput.addEventListener('input', function() {
        if (this.value && parseInt(this.value) >= 1) {
            this.style.borderColor = '#10b981';
            const error = this.parentNode.parentNode.querySelector('.form-error');
            if (error) error.remove();
        } else {
            this.style.borderColor = '#ef4444';
        }
    });
});

function confirmDelete() {
    const ruangNama = document.getElementById('nama').value;
    if (confirm(`Apakah Anda yakin ingin menghapus ruangan "${ruangNama}"?\n\nSemua peminjaman yang terkait dengan ruangan ini juga akan terhapus. Tindakan ini tidak dapat dibatalkan.`)) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection