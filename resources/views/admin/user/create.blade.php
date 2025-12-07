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
        <h1 class="form-title">Tambah User Baru</h1>
        <a href="{{ route('admin.user.index') }}" class="back-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form method="POST" action="{{ route('admin.user.store') }}" id="userForm">
            @csrf
            
            <!-- Nama Field -->
            <div class="form-group">
                <label for="name" class="form-label required">Nama Lengkap</label>
                <input 
                    type="text" 
                    id="name"
                    name="name" 
                    class="form-control" 
                    placeholder="Masukkan nama lengkap user"
                    required
                    maxlength="100"
                >
                <div class="form-hint">Nama lengkap yang akan digunakan untuk identifikasi</div>
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
                    class="form-control" 
                    placeholder="contoh@email.com"
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
                    <label for="password" class="form-label required">Password</label>
                    <div class="password-container">
                        <input 
                            type="password" 
                            id="password"
                            name="password" 
                            class="form-control" 
                            placeholder="Minimal 8 karakter"
                            required
                            minlength="8"
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    <div class="form-hint">Password minimal 8 karakter</div>
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label required">Konfirmasi Password</label>
                    <div class="password-container">
                        <input 
                            type="password" 
                            id="password_confirmation"
                            name="password_confirmation" 
                            class="form-control" 
                            placeholder="Ulangi password"
                            required
                            minlength="8"
                        >
                        <button type="button" class="toggle-password" onclick="toggleConfirmPassword()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    <div class="form-hint">Masukkan kembali password untuk konfirmasi</div>
                </div>
            </div>
            
            <!-- Role Selection -->
            <div class="form-group">
                <label for="role" class="form-label required">Role / Hak Akses</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="user">User 
                        <span class="role-badge badge-user">User Biasa</span>
                    </option>
                    <option value="petugas">Petugas 
                        <span class="role-badge badge-petugas">Petugas</span>
                    </option>
                    <option value="admin">Admin 
                        <span class="role-badge badge-admin">Administrator</span>
                    </option>
                </select>
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
                    Simpan User
                </button>
                
                <a href="{{ route('admin.user.index') }}" class="cancel-button">
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

document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const roleSelect = document.getElementById('role');
    const form = document.getElementById('userForm');
    
    // Auto-focus on name input
    if (nameInput) {
        nameInput.focus();
    }
    
    // Form validation
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Validate name
        if (!nameInput.value.trim()) {
            isValid = false;
            nameInput.style.borderColor = '#ef4444';
            if (!nameInput.nextElementSibling.classList.contains('form-error')) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'form-error';
                errorDiv.textContent = 'Nama harus diisi';
                nameInput.parentNode.insertBefore(errorDiv, nameInput.nextSibling);
            }
        } else {
            nameInput.style.borderColor = '#10b981';
        }
        
        // Validate email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailInput.value || !emailRegex.test(emailInput.value)) {
            isValid = false;
            emailInput.style.borderColor = '#ef4444';
            if (!emailInput.nextElementSibling.classList.contains('form-error')) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'form-error';
                errorDiv.textContent = 'Email tidak valid';
                emailInput.parentNode.insertBefore(errorDiv, emailInput.nextSibling);
            }
        } else {
            emailInput.style.borderColor = '#10b981';
        }
        
        // Validate password
        if (!passwordInput.value || passwordInput.value.length < 8) {
            isValid = false;
            passwordInput.style.borderColor = '#ef4444';
            if (!passwordInput.parentNode.nextElementSibling.classList.contains('form-error')) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'form-error';
                errorDiv.textContent = 'Password minimal 8 karakter';
                passwordInput.parentNode.parentNode.insertBefore(errorDiv, passwordInput.parentNode.nextSibling);
            }
        } else {
            passwordInput.style.borderColor = '#10b981';
        }
        
        // Validate password confirmation
        if (passwordInput.value !== confirmInput.value) {
            isValid = false;
            confirmInput.style.borderColor = '#ef4444';
            if (!confirmInput.parentNode.nextElementSibling.classList.contains('form-error')) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'form-error';
                errorDiv.textContent = 'Password tidak cocok';
                confirmInput.parentNode.parentNode.insertBefore(errorDiv, confirmInput.parentNode.nextSibling);
            }
        } else {
            confirmInput.style.borderColor = '#10b981';
        }
        
        // Validate role
        if (!roleSelect.value) {
            isValid = false;
            roleSelect.style.borderColor = '#ef4444';
            if (!roleSelect.nextElementSibling.classList.contains('form-error')) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'form-error';
                errorDiv.textContent = 'Pilih role user';
                roleSelect.parentNode.insertBefore(errorDiv, roleSelect.nextSibling);
            }
        } else {
            roleSelect.style.borderColor = '#10b981';
        }
        
        if (!isValid) {
            e.preventDefault();
        }
    });
    
    // Real-time validation for name
    nameInput.addEventListener('input', function() {
        if (this.value.trim()) {
            this.style.borderColor = '#10b981';
            const error = this.parentNode.querySelector('.form-error');
            if (error) error.remove();
        } else {
            this.style.borderColor = '#ef4444';
        }
    });
    
    // Real-time validation for email
    emailInput.addEventListener('input', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (this.value && emailRegex.test(this.value)) {
            this.style.borderColor = '#10b981';
            const error = this.parentNode.querySelector('.form-error');
            if (error) error.remove();
        } else {
            this.style.borderColor = '#ef4444';
        }
    });
    
    // Real-time validation for password
    passwordInput.addEventListener('input', function() {
        if (this.value && this.value.length >= 8) {
            this.style.borderColor = '#10b981';
            const error = this.parentNode.parentNode.querySelector('.form-error');
            if (error) error.remove();
        } else {
            this.style.borderColor = '#ef4444';
        }
        
        // Update confirm password validation
        if (confirmInput.value && this.value !== confirmInput.value) {
            confirmInput.style.borderColor = '#ef4444';
        } else if (confirmInput.value) {
            confirmInput.style.borderColor = '#10b981';
        }
    });
    
    // Real-time validation for confirm password
    confirmInput.addEventListener('input', function() {
        if (this.value && this.value === passwordInput.value) {
            this.style.borderColor = '#10b981';
            const error = this.parentNode.parentNode.querySelector('.form-error');
            if (error) error.remove();
        } else {
            this.style.borderColor = '#ef4444';
        }
    });
    
    // Real-time validation for role
    roleSelect.addEventListener('change', function() {
        if (this.value) {
            this.style.borderColor = '#10b981';
            const error = this.parentNode.querySelector('.form-error');
            if (error) error.remove();
        } else {
            this.style.borderColor = '#ef4444';
        }
    });
});
</script>
@endsection