<?php
session_start();
include '../../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id'");
    $user = mysqli_fetch_array($query);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/edit.css?<?= time() ?>">
    <title>Update Password</title>
</head>
<body>
<form action="../../proses/update_user_proses.php" method="POST">
    <input type="hidden" name="id" value="<?= $user['id_user']; ?>">

    <label>Username:</label><br>
    <input type="text" name="username" value="<?= $user['username']; ?>" readonly><br><br>

    <label>Password Baru:</label><br>
    <input type="password" name="password" required><br><br>

    <button name="update">Update Password</button>
    <a href="./index.php">Kembali</a>
</form>
</body>
</html>
