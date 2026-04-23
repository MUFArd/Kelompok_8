<?php
session_start();
include '../config/koneksi.php';

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    $hapus_siswa = mysqli_query($conn, "DELETE FROM siswa WHERE id_siswa = '$nis'");

    if ($hapus_siswa) {
        echo "Data siswa berhasil dihapus.";
        $hapus_usiswa = mysqli_query($conn, "DELETE FROM users WHERE id_siswa = '$nis'");
        header("Location: ../dashboard/admin/index.php#tabel-siswa");
        exit();
    }
}
?>