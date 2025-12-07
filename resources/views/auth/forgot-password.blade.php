<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password - Sistem Peminjaman Ruangan</title>
    
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
        
        .forgot-wrapper {
            width: 100%;
            max-width: 400px;
        }
        
        .forgot-header {
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
        
        .forgot-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1e293b;
        }
        
        .forgot-subtitle {
            color: #64748b;
            font-size: 14px;
        }
        
        .forgot-form {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        
        .info-text {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 1.5rem;
            text-align: center;
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
        }
        
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-error {
            margin-top: 0.5rem;
            font-size: 14px;
            color: #dc2626;
        }
        
        .session-status {
            padding: 0.75rem;
            margin-bottom: 1rem;
            background-color: #d1fae5;
            color: #065f46;
            border-radius: 8px;
            font-size: 14px;
            text-align: center;
        }
        
        .forgot-footer {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .back-link {
            color: #4b5563;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
            text-align: center;
            margin-bottom: 0.5rem;
        }
        
        .back-link:hover {
            color: #3b82f6;
            text-decoration: underline;
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
        
        @media (max-width: 640px) {
            .forgot-form {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="forgot-wrapper">
        <div class="forgot-header">
            <div class="logo">
                <div class="logo-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="logo-text">
                    <h1>RoomBook</h1>
                    <p>Sistem Peminjaman Ruangan</p>
                </div>
            </div>
            
            <h2 class="forgot-title">Lupa Password</h2>
            <p class="forgot-subtitle">Atur ulang password akun Anda</p>
        </div>

        <form method="POST" action="{{ route('password.email') }}" class="forgot-form">
            @csrf

            @if (session('status'))
                <div class="session-status">
                    {{ session('status') }}
                </div>
            @endif

            <div class="info-text">
                Lupa password Anda? Tidak masalah. Berikan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang password.
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus />
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="forgot-footer">
                <a class="back-link" href="{{ route('login') }}">
                    ← Kembali ke halaman login
                </a>
                
                <button type="submit" class="reset-button">
                    Kirim Tautan Reset Password
                </button>
            </div>
        </form>
    </div>
</body>
</html>