<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Petugas</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h1 { color: #27ae60; }
        a { text-decoration: none; color: #2980b9; }
    </style>
</head>
<body>
    <h1>Halo Petugas!</h1>
    <p>Selamat datang di dashboard petugas.</p>

    <ul>
        <li><a href="#">Lihat Peminjaman</a></li>
        <li><a href="#">Update Status Peminjaman</a></li>
        <li><a href="{{ route('profile.edit') }}">Profil Saya</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </li>
    </ul>
</body>
</html>
