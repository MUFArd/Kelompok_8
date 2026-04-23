<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['level'] != 'Kepsek') {
    header('Location: ../../login.php');
    exit;
}
date_default_timezone_set("Asia/Jakarta");

include '../../config/koneksi.php';
$hari_ini = date('Y-m-d');

// Ambil data rombel untuk filter
$rombel_query = mysqli_query($conn, "SELECT * FROM rombel ORDER BY kelas_rombel ASC, nama_rombel ASC");

// Filter kelas
$where = [];
if (!empty($_POST['kelas'])) {
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $where[] = "s.kelas_rombel = '$kelas'";
}
$where_sql = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";
$where_sql_absen = count($where) > 0 ? implode(" AND ", $where) : "1=1";

// Ambil data siswa + absensi hari ini
$siswa_tabel = mysqli_query($conn, "
    SELECT s.id_siswa, s.NISN, s.nama, s.kelas_rombel, a.jam_masuk, a.status
    FROM siswa s 
    LEFT JOIN absensi a 
        ON s.id_siswa=a.id_siswa AND a.tanggal='$hari_ini'
    $where_sql
    ORDER BY s.kelas_rombel ASC,
             CASE 
                 WHEN a.status IS NULL THEN 1
                 ELSE 0
             END ASC

");

// Rekap absensi
$siswa_absen = mysqli_query($conn, "    
    SELECT COUNT(*) AS total,
        SUM(CASE WHEN a.status IN ('hadir','terlambat') THEN 1 ELSE 0 END) AS hadir,
        SUM(CASE WHEN a.status = 'izin' THEN 1 ELSE 0 END) AS izin,
        SUM(CASE WHEN a.status = 'sakit' THEN 1 ELSE 0 END) AS sakit
    FROM absensi a
    JOIN siswa s ON a.id_siswa = s.id_siswa
    WHERE $where_sql_absen AND a.tanggal = '$hari_ini'
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kepsek</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body class="w-full h-screen bg-gradient-to-tl from-blue-300 to-white p-4">
    <header class="grid sm:grid-rows-4 lg:grid-cols-4 lg:grid-rows-none gap-4 mb-6">
        <?php $data_absen = mysqli_fetch_assoc($siswa_absen); ?>
        <div class="max-w-sm bg-green-300 flex items-center p-4 rounded-xl shadow-xl gap-4 relative">
            <h1 class="text-6xl font-bold text-green-700"><?= $data_absen['total'] ?></h1>
            <h2 class="text-3xl font-bold text-green-700">Total Absen</h2>
            <i class="fa-solid fa-hand text-6xl text-green-700 opacity-40 absolute bottom-4 right-4"></i>
        </div>
        <div class="max-w-sm bg-blue-300 flex items-center p-4 rounded-xl shadow-xl gap-4 relative">
            <h1 class="text-6xl font-bold text-blue-700"><?= $data_absen['hadir'] ?? 0 ?></h1>
            <h2 class="text-3xl font-bold text-blue-700">Hadir</h2>
            <i class="fa-solid fa-school text-6xl text-blue-700 opacity-40 absolute bottom-4 right-4"></i>
        </div>
        <div class="max-w-sm bg-yellow-300 flex items-center p-4 rounded-xl shadow-xl gap-4 relative">
            <h1 class="text-6xl font-bold text-yellow-700"><?= $data_absen['izin'] ?? 0 ?></h1>
            <h2 class="text-3xl font-bold text-yellow-700">Izin</h2>
            <i class="fa-solid fa-house text-6xl text-yellow-700 opacity-40 absolute bottom-4 right-4"></i>
        </div>
        <div class="max-w-sm bg-red-300 flex items-center p-4 rounded-xl shadow-xl gap-4 relative">
            <h1 class="text-6xl font-bold text-red-700"><?= $data_absen['sakit'] ?? 0 ?></h1>
            <h2 class="text-3xl font-bold text-red-700">Sakit</h2>
            <i class="fa-solid fa-house-medical text-6xl text-red-700 opacity-40 absolute bottom-4 right-4"></i>
        </div>
    </header>

    <main>
        <!-- Filter Kelas -->
        <div class="mb-4 flex gap-2">
            <form method="POST" class="flex gap-2">
                <select name="kelas" class="border rounded px-2 py-1">
                    <option value="">Semua</option>
                    <?php while ($r = mysqli_fetch_assoc($rombel_query)) { ?>
                        <option value="<?= $r['kelas_rombel'] ?>"
                            <?= isset($_POST['kelas']) && $_POST['kelas'] == $r['kelas_rombel'] ? 'selected' : '' ?>>
                            <?= $r['kelas_rombel'] ?> || <?= $r['nama_rombel'] ?>
                        </option>
                    <?php } ?>
                </select>
                <button type="submit" class="bg-purple-500 text-white px-3 py-1 rounded hover:bg-purple-600">Filter</button>
            </form>
        </div>

        <!-- Tabel Siswa -->
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-purple-500 text-white">
                        <th class="p-2">No</th>
                        <th class="p-2">NISN</th>
                        <th class="p-2">Nama</th>
                        <th class="p-2">Kelas Rombel</th>
                        <th class="p-2">Jam Absen</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($st = mysqli_fetch_assoc($siswa_tabel)) {
                        $siswa_id = $st['id_siswa'];
                        $rekap = mysqli_query($conn, "SELECT COUNT(*) total,
                            SUM(CASE WHEN status IN('Hadir','Terlambat') THEN 1 ELSE 0 END) hadir,
                            SUM(CASE WHEN status='Izin' THEN 1 ELSE 0 END) izin,
                            SUM(CASE WHEN status='Sakit' THEN 1 ELSE 0 END) sakit,
                            SUM(CASE WHEN status='Alpha' THEN 1 ELSE 0 END) alpha
                            FROM absensi WHERE id_siswa='$siswa_id'");
                        $r = mysqli_fetch_assoc($rekap);
                    ?>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="p-2 text-center"><?= $no++ ?></td>
                            <td class="p-2 text-center"><?= $st['NISN'] ?></td>
                            <td class="p-2"><?= $st['nama'] ?></td>
                            <td class="p-2 text-center"><?= $st['kelas_rombel'] ?></td>
                            <td class="p-2 text-center"><?= $st['jam_masuk'] ?? '-' ?></td>
                            <td class="p-2 text-center"><?= $st['status'] ?? 'Belum Absen' ?></td>
                            <td class="p-2 text-center">
                                <button class="bttn-detail bg-purple-500 hover:bg-purple-600 text-white px-2 py-1 rounded">Detail</button>
                            </td>
                        </tr>
                        <tr class="total_kehadiran hidden">
                            <td colspan="7" class="p-2 bg-gray-50">
                                <div class="grid grid-cols-2 md:grid-cols-5 gap-2 text-xs text-center">
                                    <div class="bg-purple-100 text-purple-700 p-2 rounded-md">Total: <?= $r['total'] ?? 0 ?></div>
                                    <div class="bg-green-100 text-green-700 p-2 rounded-md">Hadir: <?= $r['hadir'] ?? 0 ?></div>
                                    <div class="bg-yellow-100 text-yellow-700 p-2 rounded-md">Izin: <?= $r['izin'] ?? 0 ?></div>
                                    <div class="bg-red-100 text-red-700 p-2 rounded-md">Sakit: <?= $r['sakit'] ?? 0 ?></div>
                                    <div class="bg-gray-200 text-gray-700 p-2 rounded-md">Alpha: <?= $r['alpha'] ?? 0 ?></div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

    <button class="fixed right-8 bottom-8 bg-purple-500 py-2 px-3 rounded-xl text-md font-bold text-white"
        onclick="location.href='../../logout.php'">
        <i class="fa-solid fa-right-from-bracket"></i> Log Out
    </button>

    <script>
        const buttons = document.querySelectorAll('.bttn-detail');
        const details = document.querySelectorAll('.total_kehadiran');
        buttons.forEach((btn, i) => {
            btn.addEventListener('click', () => {
                details[i].style.display = details[i].style.display === 'table-row' ? 'none' : 'table-row';
            });
        });
    </script>
</body>

</html>