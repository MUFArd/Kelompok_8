    <?php
    session_start();
    include '../config/koneksi.php';

    if (isset($_GET['username'])) {
        $username = $_GET['username'];
        $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        $user = mysqli_fetch_assoc($query);

        $siswa_id = $user['siswa_id'];
        $guru_id = $user['guru_id'];
        $level = $user['level'];

        if (mysqli_query($conn, "DELETE FROM users WHERE username = '$username'")) {
            if (in_array($level, ['siswa', 'walas', 'kabid','admin','kepsek'])) {
                if ($level == 'Siswa') {
                    $hapus_data_lain = mysqli_query($conn, "DELETE FROM siswa WHERE id = '$siswa_id'");
                    header('Location: ../dashboard/admin/index.php?pesan-hapus=' . urlencode('Berhasil Hapus siswa'));
                } elseif ($level == 'Guru') {
                    $hapus_data_lain = mysqli_query($conn, "DELETE FROM guru WHERE id = '$guru_id'");
                    header('Location: ../dashboard/admin/index.php?pesan-hapus=' . urlencode('Berhasil Hapus walas'));
                } 
            }
            header('Location: ../dashboard/admin/index.php?pesan-hapus=' . urlencode('Berhasil Hapus data'));

        }
    }
    ?>