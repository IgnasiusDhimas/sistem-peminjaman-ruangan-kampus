<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h1 { color: #8e44ad; }
        a { text-decoration: none; color: #c0392b; }
    </style>
</head>
<body>
    <h1>Halo User!</h1>
    <p>Selamat datang di dashboard user.</p>

    <ul>
        <li><a href="#">Buat Peminjaman Ruangan</a></li>
        <li><a href="#">Cek Status Peminjaman</a></li>
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
