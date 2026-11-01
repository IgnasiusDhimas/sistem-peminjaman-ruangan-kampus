<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Peminjaman Ruangan</title>
    
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f8fafc; color: #1e293b; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        
        header { background: white; padding: 20px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .nav { display: flex; justify-content: space-between; align-items: center; }
        .logo { display: flex; align-items: center; gap: 12px; text-decoration: none; color: #1e293b; }
        .logo-icon { width: 40px; height: 40px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; }
        
        .auth-buttons { display: flex; gap: 12px; align-items: center; }
        .btn { padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; transition: all 0.3s; display: inline-block; }
        .btn-primary { background: #3b82f6; color: white; }
        .btn-primary:hover { background: #2563eb; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); }
        .btn-outline { background: white; color: #3b82f6; border: 2px solid #3b82f6; }
        .btn-outline:hover { background: #3b82f6; color: white; }
        
        .hero { padding: 80px 0; text-align: center; background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border-radius: 0 0 40px 40px; margin-bottom: 60px; }
        .hero h2 { font-size: 48px; font-weight: 700; margin-bottom: 20px; color: #1e293b; }
        .hero h2 span { color: #3b82f6; }
        .hero p { font-size: 18px; color: #64748b; max-width: 600px; margin: 0 auto 40px; }
        
        .features { padding: 60px 0; }
        .section-title { text-align: center; margin-bottom: 40px; }
        .section-title h3 { font-size: 32px; font-weight: 700; color: #1e293b; margin-bottom: 16px; }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; }
        .feature-card { background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .feature-icon { width: 60px; height: 60px; background: linear-gradient(135deg, #dbeafe, #93c5fd); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; color: #1d4ed8; }
        .feature-card h4 { font-size: 20px; margin-bottom: 12px; color: #1e293b; }
        
        .steps { padding: 60px 0; background: #f1f5f9; border-radius: 40px; margin: 60px 0; }
        .steps-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; }
        .step { text-align: center; padding: 30px; }
        .step-number { width: 50px; height: 50px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; margin: 0 auto 20px; }
        
        .cta { padding: 80px 0; text-align: center; }
        .cta-box { background: linear-gradient(135deg, #3b82f6, #1d4ed8); padding: 60px; border-radius: 24px; color: white; }
        .cta-box h3 { font-size: 32px; margin-bottom: 16px; }
        .cta-buttons { display: flex; gap: 16px; justify-content: center; margin-top: 30px; }
        
        footer { background: #1e293b; color: white; padding: 60px 0 30px; }
        .footer-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; margin-bottom: 40px; }
        .footer-links { list-style: none; }
        .footer-links a { color: #cbd5e1; text-decoration: none; }
        .copyright { text-align: center; padding-top: 30px; border-top: 1px solid #334155; color: #94a3b8; font-size: 14px; }
        
        @media (max-width: 768px) {
            .hero h2 { font-size: 36px; }
            .auth-buttons, .hero-buttons, .cta-buttons { flex-direction: column; }
            .btn { width: 100%; max-width: 300px; margin: 5px auto; text-align: center; }
            .features-grid, .steps-grid { grid-template-columns: 1fr; }
            .cta-box { padding: 40px 20px; }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="nav">
                <a href="/" class="logo">
                    <div class="logo-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 20px;">RoomBook</h1>
                        <p style="font-size: 12px; color: #64748b;">Sistem Peminjaman Ruangan BY TI SCU</p>
                    </div>
                </a>
                
                @if (Route::has('login'))
                    <div class="auth-buttons">
                        @auth
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Dashboard Admin</a>
                            @elseif (auth()->user()->role === 'petugas')
                                <a href="{{ route('petugas.dashboard') }}" class="btn btn-primary">Dashboard Petugas</a>
                            @else
                                <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Dashboard Saya</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <h2>Pinjam Ruangan Kampus<br><span>Dengan Mudah</span></h2>
                <p>Sistem peminjaman ruangan online untuk kegiatan akademik dan organisasi mahasiswa.</p>
                
                @auth
                    @if (auth()->user()->role === 'user')
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary" style="margin-top: 30px;">Mulai Peminjaman</a>
                    @endif
                @else
                    <div style="display: flex; gap: 16px; justify-content: center; margin-top: 30px;">
                        <a href="{{ route('register') }}" class="btn btn-primary">Daftar Sekarang</a>
                        <a href="{{ route('login') }}" class="btn btn-outline">Masuk ke Akun</a>
                    </div>
                @endauth
            </div>
        </section>

        <section class="features">
            <div class="container">
                <div class="section-title">
                    <h3>Kenapa Memilih Sistem Kami?</h3>
                    <p>Fitur-fitur yang membuat peminjaman ruangan menjadi lebih mudah</p>
                </div>
                
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h4>Booking Online 24/7</h4>
                        <p>Pinjam ruangan kapan saja melalui website, tanpa perlu datang ke kampus.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4>Konfirmasi Cepat</h4>
                        <p>Status peminjaman langsung terupdate dengan notifikasi real-time.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h4>Akses Aman</h4>
                        <p>Sistem dengan hak akses berbeda untuk admin, petugas, dan pengguna.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="steps">
            <div class="container">
                <div class="section-title">
                    <h3>Cara Menggunakan</h3>
                    <p>Hanya 4 langkah mudah untuk meminjam ruangan</p>
                </div>
                
                <div class="steps-grid">
                    <div class="step">
                        <div class="step-number">1</div>
                        <h4>Daftar Akun</h4>
                        <p>Buat akun dengan data diri Anda sebagai mahasiswa atau staff</p>
                    </div>
                    
                    <div class="step">
                        <div class="step-number">2</div>
                        <h4>Pilih Ruangan</h4>
                        <p>Cari ruangan yang tersedia sesuai jadwal yang Anda butuhkan</p>
                    </div>
                    
                    <div class="step">
                        <div class="step-number">3</div>
                        <h4>Isi Formulir</h4>
                        <p>Lengkapi data peminjaman dan tujuan penggunaan</p>
                    </div>
                    
                    <div class="step">
                        <div class="step-number">4</div>
                        <h4>Tunggu Konfirmasi</h4>
                        <p>Petugas akan memverifikasi dan mengkonfirmasi peminjaman</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="container">
                <div class="cta-box">
                    <h3>Siap Meminjam Ruangan?</h3>
                    <p>Bergabunglah dengan sistem kami sekarang untuk pengalaman peminjaman yang lebih baik</p>
                    
                    <div class="cta-buttons">
                        @auth
                            @if (auth()->user()->role === 'user')
                                <a href="{{ route('user.dashboard') }}" class="btn" style="background: white; color: #3b82f6;">Ke Dashboard</a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="btn" style="background: white; color: #3b82f6;">Daftar Gratis</a>
                            <a href="{{ route('login') }}" class="btn btn-outline" style="border-color: white;">Masuk Sekarang</a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h4 style="margin-bottom: 20px;">RoomBook</h4>
                    <p style="color: #cbd5e1; font-size: 14px;">Sistem peminjaman ruangan kampus yang modern dan efisien.</p>
                </div>
                
            </div>
            
            <div class="copyright">
                <p>&copy; 2024 RoomBook - Sistem Peminjaman Ruangan Kampus</p>
            </div>
        </div>
    </footer>
</body>
</html>