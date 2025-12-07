<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - Sistem Peminjaman Ruangan</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .reset-wrapper {
            width: 100%;
            max-width: 400px;
        }
        
        .reset-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 1rem;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background: #3b82f6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .logo-text h1 {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
        }
        
        .logo-text p {
            font-size: 12px;
            color: #64748b;
        }
        
        .reset-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1e293b;
        }
        
        .reset-subtitle {
            color: #64748b;
            font-size: 14px;
            line-height: 1.5;
            max-width: 320px;
            margin: 0 auto;
        }
        
        .reset-form {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #374151;
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.2s;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-input.is-invalid {
            border-color: #dc2626;
        }
        
        .form-error {
            margin-top: 0.5rem;
            font-size: 14px;
            color: #dc2626;
        }
        
        .password-requirements {
            margin-top: 0.75rem;
            padding: 0.75rem;
            background-color: #f3f4f6;
            border-radius: 6px;
            font-size: 13px;
            color: #4b5563;
        }
        
        .password-strength {
            margin-top: 8px;
            height: 4px;
            border-radius: 2px;
            background-color: #e5e7eb;
            overflow: hidden;
        }
        
        .strength-meter {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
        }
        
        .strength-weak { background-color: #dc2626; width: 25%; }
        .strength-medium { background-color: #f59e0b; width: 50%; }
        .strength-good { background-color: #10b981; width: 75%; }
        .strength-strong { background-color: #10b981; width: 100%; }
        
        .strength-text {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
            text-align: right;
        }
        
        .reset-footer {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .reset-button {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .reset-button:hover {
            background-color: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }
        
        .reset-button:active {
            transform: translateY(0);
        }
        
        .reset-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .reset-link {
            color: #4b5563;
            text-decoration: none;
            font-size: 14px;
        }
        
        .reset-link:hover {
            color: #3b82f6;
            text-decoration: underline;
        }
        
        .back-to-login {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .status-message {
            padding: 0.75rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            font-size: 14px;
            text-align: center;
        }
        
        .status-success {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .status-error {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        /* Password toggle button */
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
        
        @media (max-width: 640px) {
            .reset-form {
                padding: 1.5rem;
            }
            
            .reset-links {
                flex-direction: column;
                align-items: center;
                gap: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="reset-wrapper">
        <!-- Status Messages -->
        @if (session('status'))
            <div class="status-message status-success">
                {{ session('status') }}
            </div>
        @endif
        
        @if ($errors->any())
            <div class="status-message status-error">
                Terdapat kesalahan dalam pengisian form
            </div>
        @endif

        <div class="reset-header">
            <div class="logo">
                <div class="logo-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <div class="logo-text">
                    <h1>RoomBook</h1>
                    <p>Sistem Peminjaman Ruangan</p>
                </div>
            </div>
            
            <h2 class="reset-title">Reset Password</h2>
            <p class="reset-subtitle">Masukkan email dan password baru Anda untuk mengatur ulang kata sandi akun</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="reset-form">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input 
                    id="email" 
                    class="form-input @error('email') is-invalid @enderror" 
                    type="email" 
                    name="email" 
                    value="{{ old('email', $request->email) }}" 
                    required 
                    autofocus 
                    autocomplete="username"
                    placeholder="email@contoh.com"
                />
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password Baru</label>
                <div class="password-container">
                    <input 
                        id="password" 
                        class="form-input @error('password') is-invalid @enderror" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="new-password"
                        placeholder="Masukkan password baru"
                        minlength="8"
                    />
                    <button type="button" class="toggle-password" onclick="togglePassword('password')">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                
                <!-- Password Strength Indicator -->
                <div class="password-strength">
                    <div id="strengthMeter" class="strength-meter"></div>
                </div>
                <div id="strengthText" class="strength-text"></div>
                
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
                
                <div class="password-requirements">
                    Password minimal 8 karakter dan kombinasi huruf dan angka
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                <div class="password-container">
                    <input 
                        id="password_confirmation" 
                        class="form-input @error('password_confirmation') is-invalid @enderror" 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        placeholder="Ketik ulang password baru"
                        minlength="8"
                    />
                    <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                @error('password_confirmation')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Footer -->
            <div class="reset-footer">
                <button type="submit" class="reset-button">
                    Reset Password
                </button>
                
                <div class="reset-links">
                    @if (Route::has('login'))
                        <a class="reset-link" href="{{ route('login') }}">
                            ← Kembali ke Login
                        </a>
                    @endif
                </div>
            </div>
        </form>
        
        <div class="back-to-login">
            <p style="color: #6b7280; font-size: 13px;">
                Ingat password Anda? 
                <a href="{{ route('login') }}" style="color: #3b82f6; text-decoration: none;">
                    Login di sini
                </a>
            </p>
        </div>
    </div>

    <script>
    // Toggle password visibility
    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
    }
    
    // Password strength checker
    function checkPasswordStrength(password) {
        let strength = 0;
        const meter = document.getElementById('strengthMeter');
        const text = document.getElementById('strengthText');
        
        // Reset
        meter.className = 'strength-meter';
        text.textContent = '';
        
        if (!password) return;
        
        // Length check
        if (password.length >= 8) strength += 25;
        if (password.length >= 12) strength += 25;
        
        // Character variety checks
        if (/[a-z]/.test(password)) strength += 15;
        if (/[A-Z]/.test(password)) strength += 15;
        if (/[0-9]/.test(password)) strength += 10;
        if (/[^A-Za-z0-9]/.test(password)) strength += 10;
        
        // Update meter
        let strengthClass = '';
        let strengthLabel = '';
        
        if (strength >= 75) {
            strengthClass = 'strength-strong';
            strengthLabel = 'Sangat Kuat';
        } else if (strength >= 50) {
            strengthClass = 'strength-good';
            strengthLabel = 'Kuat';
        } else if (strength >= 25) {
            strengthClass = 'strength-medium';
            strengthLabel = 'Cukup';
        } else {
            strengthClass = 'strength-weak';
            strengthLabel = 'Lemah';
        }
        
        meter.className = 'strength-meter ' + strengthClass;
        text.textContent = strengthLabel;
    }
    
    // Real-time password validation
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        
        // Check password strength on input
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                checkPasswordStrength(this.value);
                
                // Check password match
                if (confirmInput && confirmInput.value && this.value !== confirmInput.value) {
                    confirmInput.style.borderColor = '#dc2626';
                } else if (confirmInput && confirmInput.value) {
                    confirmInput.style.borderColor = '#10b981';
                }
            });
        }
        
        // Check confirmation match
        if (confirmInput) {
            confirmInput.addEventListener('input', function() {
                if (passwordInput && passwordInput.value && this.value !== passwordInput.value) {
                    this.style.borderColor = '#dc2626';
                } else if (passwordInput && passwordInput.value) {
                    this.style.borderColor = '#10b981';
                }
            });
        }
        
        // Auto-focus on email if empty
        const emailInput = document.getElementById('email');
        if (emailInput && !emailInput.value) {
            emailInput.focus();
        }
    });
    </script>
</body>
</html>