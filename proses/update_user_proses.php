<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $update = mysqli_query($conn, "UPDATE users SET password='$hashed_password' WHERE id_user='$id'");

    if ($update) {
        header("Location: ../dashboard/admin/index.php?edit-data=" . urlencode("Berhasil mengupdate data user"));
    }   
}
?>
