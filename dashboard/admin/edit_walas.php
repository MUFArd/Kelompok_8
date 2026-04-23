<?php
session_start();
include '../../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
    $user = mysqli_fetch_array($query);
    $id_siswa = $user['siswa_id'];
    $cek_kelas_jurusan = mysqli_query($conn,"SELECT * FROM walas WHERE id = '$id_siswa'");
    $data = mysqli_fetch_array($cek_kelas_jurusan);
    $kelas = $data['kelas'];
    $jurusan = $data['jurusan'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/edit.css?<?= time() ?>">
    <title>Update Kelas Dan Jurusan</title>
</head>
<body>
<form action="../../proses/update_walas_proses.php" method="POST">
    <input type="hidden" name="id" value="<?= $id_siswa ?>">

    <label>Username:</label><br>
    <input type="text" name="username" value="<?= $user['username']; ?>" readonly><br><br>

    <select name="kelas" id="kelas">
        <option value="<?= $kelas ?>" selected hidden ><?= $kelas ?></option>
        <option value="X">X</option>
        <option value="XI">XI</option>
        <option value="XII">XII</option>
    </select>
    <select name="jurusan" id="jurusan">
        <option value="<?= $jurusan ?>" selected hidden ><?= $jurusan ?></option>
        <option value="RPL">RPL</option>
        <option value="DKV">DKV</option>
        <option value="TKJ">TKJ</option>
        <option value="BIDI">BIDI</option>
    </select> <button name="update">Update Kelas & Jurusan</button>
    <a href="./index.php">Kembali</a>
</form>
</body>
</html>
