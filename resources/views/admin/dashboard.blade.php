<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h1 { color: #2c3e50; }
        a { text-decoration: none; color: #3498db; }
    </style>
</head>
<body>
    <h1>Halo Admin!</h1>
    <p>Selamat datang di dashboard admin.</p>

    <ul>
        <li><a href="#">Kelola Ruangan</a></li>
        <li><a href="#">Kelola Peminjaman</a></li>
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
