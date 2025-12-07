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
    
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
        font-family: inherit;
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
    
    .gedung-info {
        background-color: #f8fafc;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 25px;
        border-left: 4px solid #3b82f6;
    }
    
    .gedung-info-title {
        font-size: 12px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }
    
    .gedung-info-content {
        font-size: 14px;
        color: #1e293b;
        font-weight: 500;
    }
    
    @media (max-width: 768px) {
        .form-header {
            flex-direction: column;
            align-items: flex-start;
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
        
        .form-card {
            padding: 20px;
        }
    }
</style>

<div class="form-container">
    <!-- Header -->
    <div class="form-header">
        <h1 class="form-title">Edit Gedung</h1>
        <a href="{{ route('admin.gedung.index') }}" class="back-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <!-- Gedung Info -->
        <div class="gedung-info">
            <div class="gedung-info-title">ID Gedung</div>
            <div class="gedung-info-content">#{{ $gedung->id }}</div>
        </div>
        
        <form method="POST" action="{{ route('admin.gedung.update', $gedung->id) }}" id="editForm">
            @csrf
            @method('PUT')
            
            <!-- Nama Gedung Field -->
            <div class="form-group">
                <label for="nama" class="form-label required">Nama Gedung</label>
                <input 
                    type="text" 
                    id="nama"
                    name="nama" 
                    class="form-control" 
                    placeholder="Contoh: Gedung A, Gedung Teknik, dll."
                    value="{{ old('nama', $gedung->nama) }}"
                    required
                    maxlength="100"
                >
                <div class="form-hint">Perbarui nama gedung yang jelas dan mudah dikenali</div>
                @error('nama')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Deskripsi Field -->
            <div class="form-group">
                <label for="deskripsi" class="form-label">Deskripsi Gedung</label>
                <textarea 
                    id="deskripsi"
                    name="deskripsi" 
                    class="form-control" 
                    placeholder="Deskripsi tentang gedung, fasilitas umum, atau informasi lainnya..."
                    rows="4"
                    maxlength="500"
                >{{ old('deskripsi', $gedung->deskripsi) }}</textarea>
                <div class="form-hint">Opsional: Jelaskan ciri khas, lantai, atau informasi penting lainnya (maks. 500 karakter)</div>
                @error('deskripsi')
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
                    Update Gedung
                </button>
                
                <a href="{{ route('admin.gedung.index') }}" class="cancel-button">
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
        <form method="POST" action="{{ route('admin.gedung.destroy', $gedung->id) }}" id="deleteForm" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const namaInput = document.getElementById('nama');
    const deskripsiInput = document.getElementById('deskripsi');
    const form = document.getElementById('editForm');
    
    // Auto-focus on nama input
    if (namaInput) {
        namaInput.focus();
        namaInput.select();
    }
    
    // Character counter for deskripsi
    if (deskripsiInput) {
        const counter = document.createElement('div');
        counter.className = 'form-hint';
        counter.style.textAlign = 'right';
        counter.textContent = `${deskripsiInput.value.length}/500 karakter`;
        deskripsiInput.parentNode.insertBefore(counter, deskripsiInput.nextSibling);
        
        deskripsiInput.addEventListener('input', function() {
            counter.textContent = `${this.value.length}/500 karakter`;
            
            if (this.value.length > 500) {
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
                errorDiv.textContent = 'Nama gedung harus diisi';
                namaInput.parentNode.insertBefore(errorDiv, namaInput.nextSibling);
            }
        } else {
            namaInput.style.borderColor = '#10b981';
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
});

function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus gedung ini?\n\nTindakan ini tidak dapat dibatalkan dan semua ruangan di dalam gedung ini juga akan terhapus.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection