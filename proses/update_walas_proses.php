<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['update'])) {
    $id = $_POST['id_guru'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];

    $update = mysqli_query($conn, "UPDATE walas SET kelas='$kelas',jurusan='$jurusan'  WHERE id='$id'");

    if ($update) {
        header("Location: ../dashboard/admin/index.php?edit-data=" . urlencode("Berhasil mengupdate data walas"));
    }   
}
?>
