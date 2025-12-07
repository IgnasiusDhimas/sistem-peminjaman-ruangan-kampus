<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Sistem Peminjaman Ruangan Kampus</title>
    <style>
        /* Reset Styles - Email Safe */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: #f8fafc;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
            -webkit-font-smoothing: antialiased;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        
        /* Email Client Fixes */
        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }
        
        /* Container */
        .email-wrapper {
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
        }
        
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        /* Header - Email Safe */
        .header {
            background-color: #3b82f6;
            padding: 30px 20px;
            text-align: center;
            color: #ffffff;
        }
        
        .header-content {
            max-width: 500px;
            margin: 0 auto;
        }
        
        .logo {
            margin-bottom: 20px;
        }
        
        .logo-icon {
            display: inline-block;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        
        .logo-text {
            font-size: 18px;
            font-weight: bold;
            color: #ffffff;
            margin: 0;
        }
        
        .logo-subtext {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
            margin: 5px 0 0 0;
        }
        
        .title {
            font-size: 22px;
            font-weight: bold;
            color: #ffffff;
            margin: 15px 0 10px 0;
            line-height: 1.3;
        }
        
        .subtitle {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.4;
            margin: 0;
        }
        
        /* Content */
        .content {
            padding: 30px 25px;
        }
        
        .message {
            color: #4b5563;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: center;
        }
        
        /* Timer Badge */
        .timer-container {
            text-align: center;
            margin: 20px 0;
        }
        
        .timer-badge {
            display: inline-block;
            background-color: #fef3c7;
            color: #92400e;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            border: 1px solid #fde68a;
        }
        
        /* Button - Email Safe */
        .button-container {
            text-align: center;
            margin: 25px 0;
        }
        
        .btn {
            display: inline-block;
            background-color: #3b82f6;
            color: #ffffff;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 15px;
            text-align: center;
            min-width: 180px;
            mso-padding-alt: 0;
            mso-style-priority: 100 !important;
            -webkit-text-size-adjust: none;
        }
        
        /* Warning Box */
        .warning-box {
            background-color: #fef3c7;
            border: 1px solid #fde68a;
            border-radius: 6px;
            padding: 18px;
            margin: 20px 0;
            text-align: center;
        }
        
        .warning-title {
            color: #92400e;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .warning-text {
            color: #92400e;
            font-size: 13px;
            line-height: 1.4;
            margin: 0;
        }
        
        /* Footer */
        .footer {
            padding: 25px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            background-color: #f8fafc;
        }
        
        .link-section {
            margin: 20px 0;
        }
        
        .link-title {
            font-size: 12px;
            color: #6b7280;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }
        
        .link-box {
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            padding: 12px;
            font-family: monospace;
            font-size: 12px;
            color: #4b5563;
            line-height: 1.4;
            word-break: break-all;
            margin: 12px 0;
            text-align: left;
        }
        
        .text-link {
            color: #3b82f6;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }
        
        .security-note {
            color: #6b7280;
            font-size: 12px;
            margin-top: 20px;
            padding: 10px;
            background-color: #ffffff;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
        }
        
        .copyright {
            color: #9ca3af;
            font-size: 11px;
            margin-top: 15px;
            line-height: 1.4;
        }
        
        /* Outlook Specific Styling */
        .button-outlook {
            background-color: #3b82f6 !important;
            color: #ffffff !important;
            text-decoration: none !important;
            padding: 14px 32px !important;
            border-radius: 6px !important;
            display: inline-block !important;
        }
        
        /* Mobile Responsive */
        @media only screen and (max-width: 600px) {
            body {
                padding: 10px !important;
            }
            
            .email-wrapper {
                width: 100% !important;
            }
            
            .header {
                padding: 25px 15px !important;
            }
            
            .content {
                padding: 20px 15px !important;
            }
            
            .footer {
                padding: 20px 15px !important;
            }
            
            .btn {
                display: block !important;
                width: 100% !important;
                min-width: 0 !important;
                padding: 16px 10px !important;
            }
        }
    </style>
</head>
<body style="background-color: #f8fafc; margin: 0; padding: 20px; font-family: Arial, Helvetica, sans-serif;">

<!--[if mso]>
<style type="text/css">
    body {
        font-family: Arial, Helvetica, sans-serif !important;
    }
    
    .header {
        background-color: #3b82f6 !important;
    }
    
    .btn {
        background-color: #3b82f6 !important;
        color: #ffffff !important;
        text-decoration: none !important;
        display: inline-block !important;
    }
</style>
<![endif]-->

<div class="email-wrapper">
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="logo">
                    <div class="logo-icon">🔐</div>
                    <div style="text-align: center;">
                        <h1 class="logo-text">RoomBook</h1>
                    </div>
                </div>
                <h1 class="title">Reset Password Anda</h1>
            </div>
        </div>
        
        <!-- Content -->
        <div class="content">
            <p class="message">
                Anda menerima email ini karena kami menerima permintaan reset password 
                untuk akun Anda di Sistem Peminjaman Ruangan Kampus.
            </p>
            
            <div class="timer-container">
                <span class="timer-badge">⏰ Link berlaku selama 60 menit</span>
            </div>
            
            <!-- Button -->
            <div class="button-container">
                <!--[if mso]>
                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" 
                             href="{{ $actionUrl }}" style="height:42px;v-text-anchor:middle;width:200px;" 
                             arcsize="10%" strokecolor="#3b82f6" fillcolor="#3b82f6">
                    <w:anchorlock/>
                    <center style="color:#ffffff;font-family:Arial, sans-serif;font-size:15px;font-weight:bold;">
                        🔑 Reset Password
                    </center>
                </v:roundrect>
                <![endif]-->
                <a href="{{ $actionUrl }}" class="btn" style="color: #ffffff; text-decoration: none;">
                    🔑 Reset Password Saya
                </a>
            </div>
            
            <!-- Warning -->
            <div class="warning-box">
                <div class="warning-title">⚠ Peringatan Keamanan</div>
                <p class="warning-text">
                    Jika Anda tidak merasa meminta reset password, abaikan email ini.
                    Jangan berikan link ini kepada siapa pun.
                </p>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="link-section">
                <div class="link-title">Alternatif Akses</div>
                <p style="color: #6b7280; font-size: 13px; margin-bottom: 12px; text-align: center;">
                    Jika tombol di atas tidak berfungsi, salin dan tempel link berikut di browser Anda:
                </p>
                
                <div class="link-box">
                    {{ $actionUrl }}
                </div>
                
                <div style="text-align: center; margin-top: 15px;">
                    <a href="{{ $actionUrl }}" class="text-link" style="color: #3b82f6; text-decoration: none;">
                        Klik di sini untuk membuka langsung
                    </a>
                </div>
            </div>
            
            <div class="security-note" style="text-align: center; padding: 10px;">
                🔒 Email ini dikirim secara otomatis untuk keamanan akun Anda
            </div>
            
            <div class="copyright" style="text-align: center;">
                &copy; {{ date('Y') }} Sistem Peminjaman Ruangan Kampus.<br>
                Email ini dikirim oleh sistem secara otomatis.
            </div>
        </div>
    </div>
</div>

</body>
</html>