<?php
include '../config/koneksi.php';

if (isset($_POST['update_siswa'])) {
    $nisn           = $_POST['nisn'];
    $nama           = $_POST['nama'];
    $jenis_kelamin  = $_POST['jenis_kelamin'];
    $tanggal_lahir  = $_POST['tanggal_lahir'];
    $nama_ibu       = $_POST['nama_ibu'];
    $nik            = $_POST['nik'];
    $kelas_rombel   = $_POST['kelas_rombel'];
    $telepon        = $_POST['telepon'];

    $stmt = $conn->prepare("UPDATE siswa SET 
        nama = ?, 
        jenis_kelamin = ?, 
        tanggal_lahir = ?, 
        nama_ibu = ?, 
        NIK = ?, 
        kelas_rombel = ?, 
        telepon = ? 
        WHERE NISN = ?");
        
    $stmt->bind_param("ssssssss", $nama, $jenis_kelamin, $tanggal_lahir, $nama_ibu, $nik, $kelas_rombel, $telepon, $nisn);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../dashboard/admin/index.php?edit-data=" . urlencode("Berhasil mengupdate data siswa"));
    } else {
        header("Location: ../dashboard/adminindex.php?edit-data=" . urlencode("Tidak ada perubahan atau gagal update"));
    }
}
?>