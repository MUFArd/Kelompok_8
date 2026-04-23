<?php
session_start();
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Cari user
    $user = mysqli_query($conn, "SELECT * FROM users WHERE username='" . mysqli_real_escape_string($conn, $username) . "'");
    if (mysqli_num_rows($user) === 1) {
        $u = mysqli_fetch_assoc($user);
        if (password_verify($password, $u['password'])) {
            // Simpan session
            $_SESSION['id_user'] = $u['id_user'];
            $_SESSION['username'] = $u['username'];
            $_SESSION['level'] = $u['level'];
            $_SESSION['id_siswa'] = $u['id_siswa'];
            $_SESSION['id_guru'] = $u['id_guru'];

            // Redirect sesuai level
            switch ($u['level']) {
                case 'Admin':
                    header('Location: ../dashboard/admin/index.php?pesan=' . urlencode('Selamat Datang'));
                    exit;
                case 'Kepsek':
                    header('Location: ../dashboard/kepsek/index.php?pesan=' . urlencode('Selamat Datang'));
                    exit;
                case 'Guru':
                    header('Location: ../dashboard/guru/index.php?pesan=' . urlencode('Selamat Datang'));
                    exit;
                case 'Siswa':
                    header('Location: ../dashboard/siswa/index.php?pesan=' . urlencode('Selamat Datang'));
                    exit;
                default:
                    header('Location: ../index.php?pesan=' . urlencode('Level user tidak dikenali'));
                    exit;
            }
        } else {
            header('Location: ../index.php?pesan=' . urlencode('Password salah'));
            exit;
        }
    } else {
        header('Location: ../index.php?pesan=' . urlencode('Username tidak ditemukan'));
        exit;
    }
} else {
    header('Location: ../index.php');
    exit;
}
