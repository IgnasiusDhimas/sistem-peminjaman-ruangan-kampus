<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { 
            background: #f5f7fb; 
            font-family: Arial, sans-serif; 
            padding: 40px;
        }
        .email-container {
            max-width: 480px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        .title {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }
        .text {
            color: #555;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 18px;
            background: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }
        .footer {
            margin-top: 35px;
            font-size: 12px;
            color: #888;
            text-align: center;
        }
        .link {
            word-break: break-all;
            color: #4f46e5;
        }
    </style>
</head>
<body>

<div class="email-container">
    
    <div class="title">🔒 Reset Password Anda</div>

    <p class="text">
        Anda menerima email ini karena kami menerima permintaan reset password 
        untuk akun Anda.
    </p>

    <a href="{{ $actionUrl }}" class="btn">
        Reset Password
    </a>

    <p class="text" style="margin-top: 25px;">
        Jika Anda tidak merasa meminta reset password, abaikan email ini.
        Link akan berlaku selama <b>60 menit</b>.
    </p>

    <div class="footer">
        Jika tombol tidak bisa diklik, gunakan link berikut:<br><br>
        <a href="{{ $actionUrl }}" class="link">{{ $actionUrl }}</a>
    </div>

</div>

</body>
</html>
