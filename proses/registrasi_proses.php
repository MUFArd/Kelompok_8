<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['registrasi'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $level = $_POST['level'];

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "sudah Terdaftar ";
    } else {

        $insert_user = mysqli_query($conn, "INSERT INTO users (username, password, level) VALUES ('$username', '$password', '$level')");
        header("Location: ../dashboard/admin/index.php?Tambah-data=" . urlencode("berhasil menambah data"));
    }
}
