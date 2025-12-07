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
    
    .user-info {
        background-color: #f8fafc;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 25px;
        border-left: 4px solid #3b82f6;
    }
    
    .user-info-title {
        font-size: 12px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }
    
    .user-info-content {
        font-size: 14px;
        color: #1e293b;
        font-weight: 500;
    }
    
    .password-container {
        position: relative;
    }
    
    .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6b7280;
        cursor: pointer;
        padding: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .role-badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
        margin-left: 8px;
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
    
    .current-role {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 5px;
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
    }
</style>

<div class="form-container">
    <!-- Header -->
    <div class="form-header">
        <h1 class="form-title">Edit User</h1>
        <a href="{{ route('admin.user.index') }}" class="back-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <!-- Error Messages -->
        @if($errors->any())
        <div style="background: #fee2e2; padding: 15px; margin-bottom: 20px; border-radius: 8px; border-left: 4px solid #ef4444;">
            <strong style="color: #991b1b;">Perbaiki error berikut:</strong>
            <ul style="margin: 10px 0 0 20px; color: #991b1b;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Success Message -->
        @if(session('success'))
        <div style="background: #d1fae5; padding: 15px; margin-bottom: 20px; border-radius: 8px; border-left: 4px solid #10b981;">
            <strong style="color: #065f46;">✓ {{ session('success') }}</strong>
        </div>
        @endif

        <!-- User Info -->
        <div class="user-info">
            <div class="user-info-title">ID User</div>
            <div class="user-info-content">#{{ $user->id }}</div>
            <div class="user-info-title" style="margin-top: 10px;">Role Saat Ini</div>
            <div class="user-info-content">
                @if($user->role == 'user')
                    <span class="role-badge badge-user">User</span>
                @elseif($user->role == 'petugas')
                    <span class="role-badge badge-petugas">Petugas</span>
                @else
                    <span class="role-badge badge-admin">Admin</span>
                @endif
            </div>
        </div>
        
        <form method="POST" action="{{ route('admin.user.update', $user->id) }}" id="editUserForm" novalidate>
            @csrf 
            @method('PUT')
            
            <!-- Nama Field -->
            <div class="form-group">
                <label for="name" class="form-label required">Nama Lengkap</label>
                <input 
                    type="text" 
                    id="name"
                    name="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Masukkan nama lengkap user"
                    value="{{ old('name', $user->name) }}"
                    required
                    maxlength="100"
                >
                <div class="form-hint">Perbarui nama lengkap user</div>
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Email Field -->
            <div class="form-group">
                <label for="email" class="form-label required">Email</label>
                <input 
                    type="email" 
                    id="email"
                    name="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="contoh@email.com"
                    value="{{ old('email', $user->email) }}"
                    required
                    maxlength="100"
                >
                <div class="form-hint">Email yang valid dan belum terdaftar di sistem</div>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Password Grid -->
            <div class="form-grid">
                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password Baru (Opsional)</label>
                    <div class="password-container">
                        <input 
                            type="password" 
                            id="password"
                            name="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            placeholder="Kosongkan jika tidak ingin mengubah"
                            minlength="5"
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    <div class="form-hint">Minimal 5 karakter. Kosongkan jika tidak ingin mengubah password</div>
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <div class="password-container">
                        <input 
                            type="password" 
                            id="password_confirmation"
                            name="password_confirmation" 
                            class="form-control" 
                            placeholder="Konfirmasi password baru"
                            minlength="5"
                        >
                        <button type="button" class="toggle-password" onclick="toggleConfirmPassword()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    <div class="form-hint">Masukkan kembali password baru untuk konfirmasi</div>
                </div>
            </div>
            
            <!-- Role Selection -->
            <div class="form-group">
                <label for="role" class="form-label required">Role / Hak Akses</label>
                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                        User Biasa
                    </option>
                    <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>
                        Petugas
                    </option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                        Administrator
                    </option>
                </select>
                
                <div class="current-role">
                    <span class="form-hint">Role saat ini:</span>
                    @if($user->role == 'user')
                        <span class="role-badge badge-user">User</span>
                    @elseif($user->role == 'petugas')
                        <span class="role-badge badge-petugas">Petugas</span>
                    @else
                        <span class="role-badge badge-admin">Admin</span>
                    @endif
                </div>
                
                <div class="form-hint">
                    <span style="display: inline-block; margin-right: 10px;">
                        <span class="role-badge badge-user">User</span>: Hanya bisa meminjam
                    </span>
                    <span style="display: inline-block; margin-right: 10px;">
                        <span class="role-badge badge-petugas">Petugas</span>: Bisa memverifikasi
                    </span>
                    <span style="display: inline-block;">
                        <span class="role-badge badge-admin">Admin</span>: Akses penuh
                    </span>
                </div>
                
                @error('role')
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
                    Update User
                </button>
                
                <a href="{{ route('admin.user.index') }}" class="cancel-button">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                
                <button type="button" class="delete-button" onclick="confirmDelete()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus User
                </button>
            </div>
        </form>
        
        <!-- Delete Form -->
        <form method="POST" action="{{ route('admin.user.destroy', $user->id) }}" id="deleteForm" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
}

function toggleConfirmPassword() {
    const confirmInput = document.getElementById('password_confirmation');
    const type = confirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmInput.setAttribute('type', type);
}

function confirmDelete() {
    const userName = document.getElementById('name').value;
    const userEmail = document.getElementById('email').value;
    
    if (confirm(`Apakah Anda yakin ingin menghapus user "${userName}" (${userEmail})?\n\nSemua data peminjaman yang terkait dengan user ini juga akan terhapus. Tindakan ini tidak dapat dibatalkan.`)) {
        document.getElementById('deleteForm').submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const roleSelect = document.getElementById('role');
    const form = document.getElementById('editUserForm');
    
    // Auto-focus on name input
    if (nameInput) {
        nameInput.focus();
    }
    
    // Simple validation - hanya untuk role agar tidak kosong
    form.addEventListener('submit', function(e) {
        if (!roleSelect.value) {
            alert('Harap pilih role user!');
            e.preventDefault();
            roleSelect.focus();
            return false;
        }
        
        // Jika password diisi, pastikan konfirmasi password juga diisi
        if (passwordInput.value && !confirmInput.value) {
            alert('Harap konfirmasi password baru!');
            e.preventDefault();
            confirmInput.focus();
            return false;
        }
        
        // Jika password diisi, pastikan minimal 5 karakter
        if (passwordInput.value && passwordInput.value.length < 5) {
            alert('Password minimal 5 karakter!');
            e.preventDefault();
            passwordInput.focus();
            return false;
        }
        
        // Jika password diisi, pastikan sama dengan konfirmasi
        if (passwordInput.value && passwordInput.value !== confirmInput.value) {
            alert('Password dan konfirmasi password tidak cocok!');
            e.preventDefault();
            confirmInput.focus();
            return false;
        }
    });
    
    // Real-time visual feedback (optional)
    nameInput.addEventListener('input', function() {
        if (this.value.trim()) {
            this.style.borderColor = '#10b981';
        } else {
            this.style.borderColor = '#ef4444';
        }
    });
    
    emailInput.addEventListener('input', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (this.value && emailRegex.test(this.value)) {
            this.style.borderColor = '#10b981';
        } else {
            this.style.borderColor = '#ef4444';
        }
    });
    
    roleSelect.addEventListener('change', function() {
        if (this.value) {
            this.style.borderColor = '#10b981';
        } else {
            this.style.borderColor = '#ef4444';
        }
    });
    
    // Clear error border on focus
    const inputs = [nameInput, emailInput, passwordInput, confirmInput, roleSelect];
    inputs.forEach(input => {
        if (input) {
            input.addEventListener('focus', function() {
                this.style.borderColor = '#3b82f6';
            });
            
            input.addEventListener('blur', function() {
                if (this.value.trim() || this.type === 'select-one' || this.type === 'password') {
                    this.style.borderColor = '#d1d5db';
                }
            });
        }
    });
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl + S untuk save
    if ((e.ctrlKey || e.metaKey) && e.key === 's') {
        e.preventDefault();
        document.getElementById('editUserForm').submit();
    }
    
    // Escape untuk cancel
    if (e.key === 'Escape') {
        window.location.href = "{{ route('admin.user.index') }}";
    }
});
</script>
@endsection