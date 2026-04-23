<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Admin</title>
    <style>
        body {
            background: #f4f7fc;
            font-family: Arial;
        }

        .container {
            width: 700px;
            margin: 50px auto;
        }

        .profile-box {
            background: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }

        h2 {
            margin-bottom: 25px;
            color: #111827;
        }

        .item {
            margin-bottom: 18px;
            font-size: 16px;
        }

        .item b {
            display: inline-block;
            width: 180px;
            color: #374151;
        }

        a {
            text-decoration: none;
            background: #2563eb;
            color: white;
            padding: 11px 18px;
            border-radius: 8px;
            display: inline-block;
            margin-top: 20px;
        }

        a:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="profile-box">
        <h2>Profil Administrator</h2>

        <div class="item">
            <b>Username</b>
            <?= $_SESSION['username']; ?>
        </div>

        <div class="item">
            <b>Nama Lengkap</b>
            Administrator Sistem
        </div>

        <div class="item">
            <b>Email</b>
            admin@sekolah.com
        </div>

        <div class="item">
            <b>Role</b>
            Super Admin
        </div>

        <div class="item">
            <b>Status</b>
            Aktif
        </div>

        <div class="item">
            <b>Terakhir Login</b>
            Hari ini, 08:15 WIB
        </div>

        <a href="dashboard.php">Kembali ke Dashboard</a>
    </div>
</div>

</body>
</html>
