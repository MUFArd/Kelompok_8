<?php
session_start();
if (!isset($_SESSION['id_guru']) || $_SESSION['level'] != 'Guru') {
    header('Location: ../../index.php');
    exit;
}
date_default_timezone_set("Asia/Jakarta");
include '../../config/koneksi.php';
$hari_ini = date('Y-m-d');
$id_users = $_SESSION['id_guru'];

$cek_data = mysqli_query($conn, "SELECT id_guru FROM users WHERE id_guru = '$id_users'");
$guru_id = mysqli_fetch_assoc($cek_data)['id_guru'];
$cek_kelas = mysqli_query($conn, "SELECT * FROM guru WHERE id_guru = '$guru_id'");
$wi = mysqli_fetch_assoc($cek_kelas);
$kelas = $wi['kelas_rombel'];




if (isset($_GET['pesan'])) {
}
if (isset($_GET['pesan_tambah_absensi_manual-berhasil'])) {
}
if (isset($_GET['pesan_tambah_absensi_manual-gagal'])) {
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <title>Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body class="w-full h-screen bg-gradient-to-tl from-blue-300 to-white p-4 justify-center">
    <header class="grid sm:grid-rows-4 lg:grid-cols-4 lg:grid-rows-none gap-4 m-auto">
        <?php
        $siswa_absen = mysqli_query($conn, "
            SELECT 
                COUNT(*) AS total,
                SUM(CASE WHEN a.status IN ('Hadir','Terlambat') THEN 1 ELSE 0 END) AS hadir,
                SUM(CASE WHEN a.status = 'Izin' THEN 1 ELSE 0 END) AS izin,
                SUM(CASE WHEN a.status = 'Sakit' THEN 1 ELSE 0 END) AS sakit
            FROM absensi a
            JOIN siswa s ON a.id_siswa = s.id_siswa
            WHERE s.kelas_rombel = '$kelas' 
              AND a.tanggal = '$hari_ini'
        ");

        $data_absen = mysqli_fetch_assoc($siswa_absen);
        ?>
        <div class="max-w-sm bg-green-300 flex items-center p-4 rounded-xl shadow-xl gap-4 relative">
            <h1 class="text-6xl font-bold text-green-700">
                <?= htmlspecialchars($data_absen['total']) ?>
            </h1>
            <h2 class="text-3xl font-bold text-green-700">Total Absen</h2>
            <i class="fa-solid fa-hand text-6xl text-green-700 opacity-40 absolute bottom-4 right-4"></i>
        </div>
        <div class="max-w-sm bg-blue-300 flex items-center p-4 rounded-xl shadow-xl gap-4 relative">
            <h1 class="text-6xl font-bold text-blue-700">
                <?= htmlspecialchars($data_absen['hadir'] ?? '0') ?>
            </h1>
            <h2 class="text-3xl font-bold text-blue-700">Hadir</h2>
            <i class="fa-solid fa-school text-6xl text-blue-700 opacity-40 absolute bottom-4 right-4"></i>
        </div>
        <div class="max-w-sm bg-yellow-300 flex items-center p-4 rounded-xl shadow-xl gap-4 relative">
            <h1 class="text-6xl font-bold text-yellow-700">
                <?= htmlspecialchars($data_absen['izin'] ?? '0') ?>
            </h1>
            <h2 class="text-3xl font-bold text-yellow-700">Izin</h2>
            <i class="fa-solid fa-house text-6xl text-yellow-700 opacity-40 absolute bottom-4 right-4"></i>
        </div>
        <div class="max-w-sm bg-red-300 flex items-center p-4 rounded-xl shadow-xl gap-4 relative">
            <h1 class="text-6xl font-bold text-red-700">
                <?= htmlspecialchars($data_absen['sakit'] ?? '0') ?>
            </h1>
            <h2 class="text-3xl font-bold text-red-700">Sakit</h2>
            <i class="fa-solid fa-house-medical text-6xl text-red-700 opacity-40 absolute bottom-4 right-4"></i>
        </div>
    </header>

    <main>
        <div class="my-4">
            <input 
                type="text"
                id="searchSiswa"
                placeholder="Cari siswa..."
                class="w-full p-2 border border-gray-300 rounded-lg"
                onkeyup="filterSiswa('searchSiswa','tabel-siswa')"
            >
        </div>
     <section id="tabel-siswa">
    <?php
    $no = 1;
    $siswa_tabel = mysqli_query($conn, "
        SELECT  s.id_siswa,
                s.NISN,
                s.nama,
                s.kelas_rombel,
                r.kelas_rombel,
                r.nama_rombel,
                a.id_absen,
                a.tanggal,
                a.jam_masuk,
                a.status
        FROM siswa s
        LEFT JOIN absensi a ON s.id_siswa = a.id_siswa  AND a.tanggal = '$hari_ini'
        LEFT JOIN rombel r ON r.kelas_rombel = s.kelas_rombel
        WHERE s.kelas_rombel = '$kelas' 
        ORDER BY a.jam_masuk DESC
    ");
    ?>

    <div class="overflow-x-auto mt-10">
        <table class="min-w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-purple-500 text-white">
                    <th class="min-w-14 text-center sm:p-1 lg:p-4 text-left">NO</th>
                    <th class="min-w-14 text-center hidden lg:table-cell sm:p-1 lg:p-4 text-left">NIS</th>
                    <th class="min-w-60 sm:p-1 lg:p-4 text-left">NAMA</th>
                    <th class="min-w-14 text-center hidden lg:table-cell sm:p-1 lg:p-4 text-left">KELAS</th>
                    <th class="min-w-40 text-center sm:p-1 hidden lg:table-cell lg:p-4 text-left">JAM ABSEN</th>
                    <th class="min-w-14 text-center hidden lg:table-cell sm:p-1 lg:p-4 text-left">STATUS</th>
                    <th class="min-w-14 text-center sm:p-1 lg:p-4 text-left">DETAIL</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($st = mysqli_fetch_assoc($siswa_tabel)) {
                    $siswa_id = $st['id_siswa'];
                    $rekap = mysqli_query($conn, "
                        SELECT
                            COUNT(*) as total,
                            SUM(CASE WHEN status IN ('Hadir','Terlambat') THEN 1 ELSE 0 END) as hadir,
                            SUM(CASE WHEN status = 'Izin' THEN 1 ELSE 0 END) as izin,
                            SUM(CASE WHEN status = 'Sakit' THEN 1 ELSE 0 END) as sakit,
                            SUM(CASE WHEN status = 'Alfa' THEN 1 ELSE 0 END) as alpha
                        FROM absensi
                        WHERE id_siswa = '$siswa_id'
                    ");
                    $r = mysqli_fetch_assoc($rekap);
                ?>
                    <tr class="even:bg-gray-100 odd:bg-white ">
                        <td class="text-center py-4 sm:p-1 lg:p-8"><?= $no++ ?></td>
                        <td class="text-center hidden lg:table-cell sm:p-1 lg:p-8"><?= htmlspecialchars($st['NISN']) ?></td>
                        <td class="sm:p-1 lg:p-8"><?= htmlspecialchars($st['nama']) ?></td>
                        <td class="text-center hidden lg:table-cell sm:p-1 lg:p-8"><?= htmlspecialchars($st['kelas_rombel']) ?></td>
                        <td class="text-center hidden lg:table-cell sm:p-1 lg:p-8"><?= $st['jam_masuk'] ?? '-' ?></td>
                        <td class="text-center hidden lg:table-cell sm:p-1 lg:p-8"><?= htmlspecialchars($st['status'] ?? 'Belum Absen')  ?></td>
                        <td class="px-1 lg:p-8">
                            <button class="bttn-detail bg-purple-500 hover:bg-purple-600 text-white px-2 py-1 rounded">
                                Detail
                            </button>
                        </td>
                    </tr>
                    <tr class="total_kehadiran hidden ">
                        <td colspan="8" class="p-2 bg-gray-50">
                            <div class="Detail-siswa">
                                <h2>
                                    Absen Hari Ini <br>
                                    JAM Absen : <?= $st['jam_masuk'] ?? '-' ?> <br>
                                    STATUS : <?= htmlspecialchars($st['status'] ?? 'Belum Absen')  ?> <br>
                                </h2>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-xs text-center">
                                <div class="flex flex-col justify-center items-center bg-purple-100 text-purple-700 p-2 rounded-md">
                                    <i class="fa-solid fa-list text-sm mb-1"></i>
                                    <span>Total</span>
                                    <span class="font-bold text-sm"><?= $r['total'] ?></span>
                                </div>
                                <div class="flex flex-col justify-center items-center bg-green-100 text-green-700 p-2 rounded-md">
                                    <i class="fa-solid fa-hand text-sm mb-1"></i>
                                    <span>Hadir</span>
                                    <span class="font-bold text-sm"><?= $r['hadir'] ?? 0 ?></span>
                                </div>
                                <div class="flex flex-col justify-center items-center bg-yellow-100 text-yellow-700 p-2 rounded-md">
                                    <i class="fa-solid fa-house text-sm mb-1"></i>
                                    <span>Izin</span>
                                    <span class="font-bold text-sm"><?= $r['izin'] ?? 0 ?></span>
                                </div>
                                <div class="flex flex-col justify-center items-center bg-red-100 text-red-700 p-2 rounded-md">
                                    <i class="fa-solid fa-house-medical text-sm mb-1"></i>
                                    <span>Sakit</span>
                                    <span class="font-bold text-sm"><?= $r['sakit'] ?? 0 ?></span>
                                </div>
                            </div>
                            <div class="mt-2 text-center">
                                <?php if (empty($st['status'])): ?>
                                    <form method="POST" action="../../proses/tambah_absen_manual.php" class="flex flex-wrap justify-center gap-2">
                                        <input type="hidden" name="id_siswa" value="<?= $st['id_siswa'] ?>">
                                        <button name="absen" value="Hadir" class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded-md text-xs">Hadir</button>
                                        <button name="absen" value="Terlambat" class="px-3 py-1 bg-yellow-300 hover:bg-yellow-600 text-white rounded-md text-xs">Terlambat</button>
                                        <button name="absen" value="Izin" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md text-xs">Izin</button>
                                        <button name="absen" value="Sakit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md text-xs">Sakit</button>
                                        <button name="absen" value="Alfa" class="px-3 py-1 bg-gray-500 hover:bg-gray-600 text-white rounded-md text-xs">Alpha</button>
                                    </form>
                                <?php else: ?>
                                   <div class="form-simpan grid grid-cols-2 gap-2 justify-center">
                                     <form method="POST" action="../../proses/tambah_absen_manual.php" class="grid">
                                        <input type="hidden" name="id_siswa" value="<?= $st['id_siswa'] ?>">
                                        <button name="hapus_absen" type="submit" value="1" class="px-4 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md text-xs">Hapus Absen</button>
                                    </form>
                                    <form method="POST" action="../../proses/simpan_to_googlesheet.php" class="grid">
                                        <input type="hidden" name="id_absen" value="<?= $st['id_absen'] ?>">
                                        <button type="submit" value="1" class="px-3 py-1 bg-indigo-500 text-white rounded-md text-xs">Simpan</button>
                                    </form>
                                   </div>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

        <script>
            function filterSiswa(inputId,tableID) {
                let input = document.getElementById(inputId);
                let filter = input.value.toLowerCase();
                let table = document.getElementById(tableID);
                let tr = table.getElementsByTagName("tr");
                for (let i = 1; i < tr.length; i++) {
                    let tds = tr[i].getElementsByTagName("td");
                    let found = false;
                    for (let j = 0; j < tds.length; j++) {
                        if (tds[j] && tds[j].innerText.toLowerCase().indexOf(filter) > -1   ) {
                            found = true;
                            break;
                            
                        }
                        
                    }
                    tr[i].style.display = found ? "" : "none";
                }
            }
        </script>

        <?php if (isset($_GET['pesan'])): ?>
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: "<?= htmlspecialchars($_GET['pesan']) ?>",
                    confirmButtonColor: 'red',
                    confirmButtonText: 'OKAY',


                }).then(() => {
                    const url = new URL(window.location.href);
                    url.searchParams.delete('pesan');
                    window.history.replaceState({}, '', url);
                });
            </script>
        <?php endif; ?>
        <?php if (isset($_GET['pesan_tambah_absensi_manual-berhasil'])): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Info',
                    text: "<?= htmlspecialchars($_GET['pesan_tambah_absensi_manual-berhasil']) ?>",
                    confirmButtonColor: 'red',
                    confirmButtonText: 'OKAY',


                }).then(() => {
                    const url = new URL(window.location.href);
                    url.searchParams.delete('pesan_tambah_absensi_manual-berhasil');
                    window.history.replaceState({}, '', url);
                });
            </script>
        <?php endif; ?>
        <?php if (isset($_GET['pesan_tambah_absensi_manual-gagal'])): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Info',
                    text: "<?= htmlspecialchars($_GET['pesan_tambah_absensi_manual-gagal']) ?>",
                    confirmButtonColor: 'red',
                    confirmButtonText: 'OKAY',


                }).then(() => {
                    const url = new URL(window.location.href);
                    url.searchParams.delete('pesan_tambah_absensi_manual-gagal');
                    window.history.replaceState({}, '', url);
                });
            </script>
        <?php endif; ?>

        <script>
            const buttons = document.querySelectorAll('.bttn-detail');
            const details = document.querySelectorAll('.total_kehadiran');

            buttons.forEach((btn, i) => {
                btn.addEventListener('click', () => {
                    const detail = details[i];
                    if (detail.style.display === 'table-row') {
                        detail.style.display = 'none';
                    } else {
                        detail.style.display = 'table-row';
                    }
                });
            });
        </script>
        <button class="fixed left-8 bottom-8 bg-purple-500 py-2 px-3 rounded-xl text-md font-bold text-white"
        onclick="location.href='../../logout.php'">
            <i class="fa-solid fa-right-from-bracket"></i>
            Log Out
        </button>
</body>
<script src="../../assets/js/index_admin.js?<?php echo time(); ?>"></script>

</html>