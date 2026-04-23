<?php
session_start();
include '../config/koneksi.php';
include 'phpqrcode/qrlib.php'; 

if (isset($_POST['tambah_siswa'])) {
$nama          = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$kelas = $_POST['kelas'];
$telepon       = $_POST['telepon'];
$username      = $_POST['username'];
$password      = $_POST['password'];

    $q_kode_siswa = mysqli_query($conn, "SELECT MAX(id_guru) as last_id FROM guru");
    $row     = mysqli_fetch_assoc($q_kode_siswa);
    $last_id = $row['last_id'] ?? 0;
    $next_id = $last_id + 1;

    $kode_guru = 'GURU' . str_pad($next_id, 3, '0', STR_PAD_LEFT);

    // insert siswa
    $insert = mysqli_query($conn, "INSERT INTO guru 
    ( nama_guru, jenis_kelamin, kelas_rombel, no_telp, kode_guru) 
    VALUES 
    ('$nama', '$jenis_kelamin','$kelas', '$telepon', '$kode_guru')");
    $id_guru = mysqli_insert_id($conn);


    $dir = '../assets/img/qrcode_guru';
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    $file_qr = $dir . '/' . $nama . '.png';
    QRcode::png($kode_guru, $file_qr, QR_ECLEVEL_L, 5);

    $update_qr = mysqli_query($conn, "UPDATE guru SET qr_path='$file_qr' WHERE kode_guru='$kode_guru'");

    $insert_user = mysqli_query($conn, "INSERT INTO users (username, password, level, id_guru) 
                                        VALUES ('$username', '" . password_hash($password, PASSWORD_DEFAULT) . "', 'Guru', '$id_guru')");

    if ($insert && $insert_user && $update_qr) {
        
        header("Location: ../dashboard/admin/tambah_guru.php?Tambah-data=" . urlencode("Berhasil menambahkan data Guru  "));
    } else {
        echo "<script>alert('Gagal menambahkan data siswa!');</script>";
    }
}
?>
