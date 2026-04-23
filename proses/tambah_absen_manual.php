<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include '../config/koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $siswa_id = intval($_POST['id_siswa']);
    $hari_ini = date('Y-m-d');
    $waktu_ini = date('H:i:s');

    if (isset($_POST['absen'])) {
        $status = $_POST['absen']; 
        $stmt = $conn->prepare("INSERT INTO absensi (id_siswa, tanggal, jam_masuk, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $siswa_id, $hari_ini,$waktu_ini , $status);
        $stmt->execute();
    }

    if (isset($_POST['hapus_absen'])) {
        $stmt = $conn->prepare("DELETE FROM absensi WHERE id_siswa = ? AND tanggal = ?");
        $stmt->bind_param("is", $siswa_id, $hari_ini);
        $stmt->execute();
    }

    header("Location: ../dashboard/guru/index.php"); 
    exit;
}
