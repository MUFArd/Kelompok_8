<?php
session_start();
include '../config/koneksi.php';
include 'phpqrcode/qrlib.php'; 

if (isset($_POST['tambah_siswa'])) {
$nama          = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$ttd           = $_POST['tanggal_lahir'];
$nama_ibu      = $_POST['nama_ibu'];
$nik           = $_POST['nik'];
$nisn          = $_POST['nisn'];
$kelas         = $_POST['kelas'];
$telepon       = $_POST['telepon'];
$username      = $_POST['nisn'];
$password      = $_POST['nisn'];

echo "DEBUG: kelas_rombel = '$kelas'<br>";

    // cek nis
    $cek_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE NIK='$nik'");
    if (mysqli_num_rows($cek_siswa) > 0) {
        echo "<script>alert('NIS sudah terdaftar!');</script>";
        header("Location: ../dashboard/admin/index.php");
        exit;
    }

    // generate kode siswa
    $q_kode_siswa = mysqli_query($conn, "SELECT MAX(id_siswa) as last_id FROM siswa");
    $row     = mysqli_fetch_assoc($q_kode_siswa);
    $last_id = $row['last_id'] ?? 0;
    $next_id = $last_id + 1;

    $kode_siswa = 'SISWA' . str_pad($next_id, 3, '0', STR_PAD_LEFT);

    // insert siswa
    $insert = mysqli_query($conn, "INSERT INTO siswa 
    ( nama, jenis_kelamin, tanggal_lahir, nama_ibu, NIK, NISN, kelas_rombel, telepon, kode_siswa) 
    VALUES 
    ('$nama', '$jenis_kelamin', '$ttd', '$nama_ibu', '$nik', '$nisn', '$kelas', '$telepon', '$kode_siswa')");
    $id_siswa = mysqli_insert_id($conn);


    $dir = '../assets/img/qrcode_siswa';
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    $file_qr = $dir . '/' . $nama . '.png';
    QRcode::png($kode_siswa, $file_qr, QR_ECLEVEL_L, 5);

    $update_qr = mysqli_query($conn, "UPDATE siswa SET qr_path='$file_qr' WHERE kode_siswa='$kode_siswa'");

    $insert_user = mysqli_query($conn, "INSERT INTO users (username, password, level, id_siswa) 
                                        VALUES ('$username', '" . password_hash($password, PASSWORD_DEFAULT) . "', 'siswa', '$id_siswa')");

    if ($insert && $insert_user && $update_qr) {
        
        header("Location: ../dashboard/admin/tambah_siswa.php?Tambah-data=" . urlencode("Berhasil menambahkan data siswa"));
    } else {
        echo "<script>alert('Gagal menambahkan data siswa!');</script>";
    }
}
?>
