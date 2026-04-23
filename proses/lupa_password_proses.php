<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include '../config/koneksi.php';

$nomor   = $_POST['telepon'];
$tanggal = date('Y-m-d');
$jam     = date('H:i:s');

$siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE telepon='$nomor'");
$guru  = mysqli_query($conn, "SELECT * FROM guru WHERE no_telp='$nomor'");

if (mysqli_num_rows($siswa) > 0) {
    $s = mysqli_fetch_array($siswa);
    $id_user_siswa = $s['id_siswa'];
    $nama          = $s['nama'];
    $nomor_telp    = $s['telepon'];

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE id_siswa='$id_user_siswa'");
    if (mysqli_num_rows($cek) > 0) {
        $ck       = mysqli_fetch_array($cek);
        $username = $ck['username'];

        $new_password    = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update = mysqli_query($conn, "UPDATE users SET password='$hashed_password' WHERE id_siswa='$id_user_siswa'");
        if ($update) {
            $pesan = "Halo $nama,\nUsername kamu: $username\nPassword baru kamu: $new_password\nHubungi admin (085776649749) jika ingin mengganti password sesuai keinginan kamu.";

            // kirim via WA
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => array(
                    'target' => $nomor_telp,
                    'message' => $pesan,
                    'countryCode' => '62',
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: m2AVpZiddB78ZKmb5uzr'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            header("Location: ../login.php?pesan-berhasil=" . urlencode("Password baru sudah dikirim ke WhatsApp siswa!"));
        } else {
            header("Location: ../index.php?pesan-gagal=" . urlencode("Gagal memperbarui password siswa."));
        }
    } else {
        header("Location: ../index.php?pesan-gagal=" . urlencode("Akun siswa tidak ditemukan."));
    }

} elseif (mysqli_num_rows($guru) > 0) {
    $g = mysqli_fetch_array($guru);
    $id_user_guru = $g['id_guru'];
    $nama         = $g['nama'];
    $nomor_telp   = $g['no_telp'];

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE id_guru='$id_user_guru'");
    if (mysqli_num_rows($cek) > 0) {
        $ck       = mysqli_fetch_array($cek);
        $username = $ck['username'];

        $new_password    = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update = mysqli_query($conn, "UPDATE users SET password='$hashed_password' WHERE id_guru='$id_user_guru'");
        if ($update) {
            $pesan = "Halo Bapak/Ibu $nama,\nUsername Anda: $username\nPassword baru Anda: $new_password\nHubungi admin (085776649749) jika ingin mengganti password sesuai keinginan.";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => array(
                    'target' => $nomor_telp,
                    'message' => $pesan,
                    'countryCode' => '62',
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: m2AVpZiddB78ZKmb5uzr'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            header("Location: ../index.php?pesan-berhasil=" . urlencode("Password baru sudah dikirim ke WhatsApp guru!"));
        } else {
            header("Location: ../index.php?pesan-gagal=" . urlencode("Gagal memperbarui password guru."));
        }
    } else {
        header("Location: ../index.php?pesan-gagal=" . urlencode("Akun guru tidak ditemukan."));
    }

} else {
    header("Location: ../index.php?pesan-gagal=" . urlencode("Nomor tidak ditemukan di sistem."));
}
?>
