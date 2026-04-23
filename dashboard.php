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
    <title>Dashboard Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial;
        }

        body {
            background: #f3f6fb;
        }

        .header {
            background: #1e3a8a;
            color: white;
            padding: 20px 40px;
        }

        .header h2 {
            margin-bottom: 5px;
        }

        .container {
            width: 90%;
            margin: 30px auto;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }

        .card h3 {
            color: #6b7280;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
            color: #111827;
        }

        .table-box {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }

        .table-box h3 {
            margin-bottom: 20px;
            color: #111827;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #f9fafb;
            text-align: left;
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        table td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        .menu {
            margin-top: 25px;
        }

        .menu a {
            text-decoration: none;
            background: #2563eb;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            margin-right: 10px;
            display: inline-block;
        }

        .menu a:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, <b><?= $_SESSION['username']; ?></b></p>
</div>

<div class="container">

    <div class="cards">
        <div class="card">
            <h3>Total Siswa</h3>
            <p>1,245</p>
        </div>

        <div class="card">
            <h3>Total Guru</h3>
            <p>86</p>
        </div>

        <div class="card">
            <h3>Total Kelas</h3>
            <p>32</p>
        </div>

        <div class="card">
            <h3>Total Nilai</h3>
            <p>8,920</p>
        </div>
    </div>

    <div class="table-box">
        <h3>Data Nilai Terbaru</h3>

        <table>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Mata Pelajaran</th>
                <th>Jenis Nilai</th>
                <th>Nilai</th>
                <th>Status</th>
            </tr>

            <tr>
                <td>1</td>
                <td>Ahmad Fauzi</td>
                <td>Matematika</td>
                <td>UTS</td>
                <td>88</td>
                <td>Lulus</td>
            </tr>

            <tr>
                <td>2</td>
                <td>Siti Nurhaliza</td>
                <td>Bahasa Inggris</td>
                <td>UAS</td>
                <td>92</td>
                <td>Lulus</td>
            </tr>

            <tr>
                <td>3</td>
                <td>Rizky Ramadhan</td>
                <td>Produktif RPL</td>
                <td>UTS</td>
                <td>76</td>
                <td>Lulus</td>
            </tr>

            <tr>
                <td>4</td>
                <td>Dewi Lestari</td>
                <td>Basis Data</td>
                <td>UAS</td>
                <td>95</td>
                <td>Lulus</td>
            </tr>
        </table>

        <div class="menu">
            <a href="profil.php">Profil</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

</div>

</body>
</html>