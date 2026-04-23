<?php
include './koneksi.php';

$username = 'FarelAdmin';
$password = 'FarelAdmin1234';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$level = 'Admin';

$sql = "INSERT INTO users (username, password, level) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPassword, $level);

if (mysqli_stmt_execute($stmt)) {
    echo "User berhasil ditambahkan.";
} else {
    echo "Gagal menambahkan user: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
