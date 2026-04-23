<?php 
include '../../config/koneksi.php';
session_start();
if(!isset($_SESSION['id_user']) || $_SESSION['level'] != 'Siswa') {
    header('Location: ../../index.php');
    
    exit;
}
    date_default_timezone_set('Asia/Jakarta');

    $hari_ini= date('Y-m-d');
    $id_users = $_SESSION['id_user'];
    $username = $_SESSION['username'];
    $level = $_SESSION['level'];

    $cek_users = mysqli_query($conn, "SELECT * FROM users WHERE id_user = '$id_users'");
    $id_siswa = mysqli_fetch_assoc($cek_users)['id_siswa'];
    
    $data_siswa = mysqli_query($conn, "SELECT s.* ,r.* FROM siswa s JOIN rombel r ON r.kelas_rombel = s.kelas_rombel WHERE id_siswa = '$id_siswa'");
    $data = mysqli_fetch_assoc($data_siswa);

    $cek_absen = mysqli_query($conn,"SELECT * FROM absensi WHERE id_siswa = '$id_siswa'
    AND tanggal = '$hari_ini'
    ");
    $status_absen = mysqli_fetch_assoc($cek_absen);
    if ($status_absen > 0) {
        $status = 'Sudah Absen';
    }else {
        $status = 'Belum Absen';
    }

    $total_kehadiran = mysqli_query($conn, "SELECT COUNT(*) as total,
    SUM(CASE WHEN status IN ('Hadir', 'Terlambat') THEN 1 ELSE 0 END) as hadir,
    SUM(CASE WHEN status = 'Izin' THEN 1 ELSE 0 END) as izin,
    SUM(CASE WHEN status = 'Sakit' THEN 1 ELSE 0 END) as sakit,
    SUM(CASE WHEN status = 'Alpha' THEN 1 ELSE 0 END) as alpha
    FROM absensi WHERE id_siswa = '$id_siswa'
    ");
    $total = mysqli_fetch_array($total_kehadiran);
    $hadir = $total['hadir'];
    $izin = $total['izin'];
    $sakit = $total['sakit'];
    $alpha = $total['alpha'];

    $nis = $data['NISN'];
    $nama = $data['nama'];
    $tdd = $data['tanggal_lahir'];
    $gender = $data['jenis_kelamin'];
    $kelas = $data['kelas_rombel'] .' || '.  $data['nama_rombel'];
    $nomer = $data['telepon'];

    if (isset($_GET['pesan'])) {}

    //ambil data buat tabel jir
    $no = 1;
    $tanggal = date('d-m-Y');
    $tabel = mysqli_query($conn ,"SELECT * FROM absensi WHERE id_siswa = '$id_siswa'
    ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Dashboard <?php htmlspecialchars($nama) ?></title>
</head>
<style>
  nav.active {
    transform: translateX(0); 
  }
</style>
<body class="bg-gradient-to-tl from-purple-200 to-white grid place-items-start min-h-screen pt-14 select-none">
    <header class="w-full h-14 fixed top-0 bg-purple-600 text-white flex items-center justify-between" style="z-index: 1000;">
        
        <div class="logo flex items-center">
            <img src="../../assets/img/Element_sekolah/PAUD-AL-UNAYAH.png" alt="Logo Sekolah" class="w-14 h-14">
            <h1 class="text-xl font-bold text-white-500">PAUD AL-UNAYAH</h1>
        </div>
        <i class="fa-solid fa-bars text-3xl mr-4" onclick="document.querySelector('nav').classList.toggle('active')"></i>
        <nav class="bg-purple-500 text-white w-64 h-screen fixed top-14 right-0 z-10 transform translate-x-full transition-transform duration-300 ease-in-out flex justify-center p-4">
            <button class="bttn-logout justify-center gap-5 bg-orange-500 w-80 h-14  rounded-xl shadow-lg text-white font-bold text-xl" onclick="window.location.href='../../logout.php'">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Log out</span>
            </button>
        </nav>
    </header>
  
    <div class="container mx-auto mt-4 p-6 max-w-lg">
        <section class="content-profil active bg-white shadow-lg rounded-lg p-6">
            <div class="profil-user mt-3 flex justify-center items-center">
                <h2 class="w-80 h-14 flex justify-center items-center bg-red-400 rounded-xl shadow-lg text-xl font-bold text-white cursor-pointer select-none">Dashboard Murid</h2>
            </div>
            <div class="profil-siswa">
                <h1 class="text-center mt-8 bg-purple-400 text-white font-bold text-xl rounded-xl py-2 shadow-lg cursor-pointer select-none" onclick="document.querySelector('.profil-siswa .wrapper').classList.toggle('hidden') ">Data Siswa</h1>
                <div class="wrapper hidden grid grid-rows-4 gap-2 mt-4">
                    <div class="wrap">
                        <span class="text-red-500 text-lg"> <i class="fa-solid fa-chalkboard-user "></i><b> NISN</b></span>
                        <h2 class="text-xl"><?php echo htmlspecialchars($nis) ?></h2>
                    </div>
                    <div class="wrap">
                        <span class="text-green-500 text-lg"> <i class="fa-solid fa-user "></i><b> Nama Lengkap</b></span>
                        <h2 class="text-xl"><?php echo htmlspecialchars($nama) ?></h2>
                    </div>
                    <div class="wrap">
                        <span class="text-orange-300 text-lg"> <i class="fa-solid fa-school"></i><b> Kelas</b></span>
                        <h2 class="text-xl"><?php echo htmlspecialchars($kelas) ?></h2>
                    </div>
                    <div class="wrap">
                        <span class="text-blue-500 text-lg"> <i class="fa-solid fa-mobile"></i><b> No Telp</b></span>
                        <h2 class="text-xl"><?php echo htmlspecialchars($nomer) ?></h2>
                    </div>
                </div>
            </div>
            <div class="detail-user">
                <h1 class="text-center mt-4 bg-green-400 text-white font-bold text-xl rounded-xl py-2 shadow-lg cursor-pointer select-none" onclick="document.querySelector('.detail-user .wrap').classList.toggle('hidden') ">Data User</h1>
                <div class="wrap hidden mt-4">
                    <span class="text-red-500 text-lg"><i class="fa-solid fa-user"></i><b> Username</b></span>
                    <h2 class="text-xl"><?php echo htmlspecialchars($username) ?></h2>
                </div>
            </div>
            <div class="total-kehadiran">
                <h1 class="text-center mt-4 bg-blue-400 text-white font-bold text-xl rounded-xl py-2 shadow-lg cursor-pointer select-none" onclick="document.querySelector('.total-kehadiran .wrapper').classList.toggle('hidden') ">Kehadiran</h1>
                <div class="wrapper hidden grid grid-rows-4 gap-2 mt-4">
                    <div class="wrap">
                        <span class="text-orange-400 text-lg"><i class="fa-solid fa-school mr-2"></i><b>Hadir</b></span>
                        <h2 class="text-xl"><?php echo htmlspecialchars($hadir ?? 0) ?> Hari</h2>
                    </div>
                    <div class="wrap">
                        <span class="text-green-300 text-lg"><i class="fa-solid fa-house mr-2"></i><b>Izin</b></span>
                        <h2 class="text-xl"><?php echo htmlspecialchars($izin ?? 0) ?> Hari</h2>
                    </div>
                    <div class="wrap">
                        <span class="text-blue-500 text-lg"><i class="fa-solid fa-house-medical mr-2"></i><b>Sakit</b></span>
                        <h2 class="text-xl"><?php echo htmlspecialchars($sakit ?? 0) ?> Hari</h2>
                    </div>
                    <div class="wrap">
                        <span class="text-red-500 text-lg"><i class="fa-solid fa-question mr-2"></i><b>Tanpa Keterangan</b></span>
                        <h2 class="text-xl"><?php echo htmlspecialchars($alpha ?? 0) ?> Hari</h2>
                    </div>
                </div>
            </div>
            <div class="status">
                <h1 class="text-center mt-4 bg-orange-400 text-white font-bold text-xl rounded-xl py-2 shadow-lg cursor-pointer select-none" onclick="document.querySelector('.status .wrap').classList.toggle('hidden') ">Status Absen</h1>
                <div class="wrap hidden mt-4">
                    <span class="text-purple-500 text-lg"><i class="fa-solid fa-hand mr-4"></i><b>Absen Hari ini</b></span>
                    <h2 class="text-xl"><?php echo htmlspecialchars($status) ?></h2>
                </div>
            </div>
            <div class="tabel-absensi">
                <h1 class="text-center mt-4 bg-pink-400 text-white font-bold text-xl rounded-xl py-2 shadow-lg" 
                onclick="document.querySelector('.content-absensi').classList.toggle('hidden') 
                document.querySelector('.profil-siswa').classList.toggle('hidden')
                document.querySelector('.detail-user').classList.toggle('hidden')
                document.querySelector('.total-kehadiran').classList.toggle('hidden')
                document.querySelector('.status').classList.toggle('hidden')
                ">Keseluruhan Absen</h1>
            </div>
        </section>
        <section class="content-absensi mt-4 hidden">
         <table class="w-full border-collapse">
            <tr class="header_row bg-purple-500 text-white border-purple-300 border-2">
                <th class="border-purple-300 border-2 text-center">NO</th>
                <th class="border-purple-300 border-2 text-center">TANGGAL ABSEN</th>
                <th class="border-purple-300 border-2 text-center">JAM ABSEN</th>
                <th class="border-purple-300 border-2 text-center">STATUS</th>
            </tr>
            <?php while ($dt = mysqli_fetch_assoc($tabel)) { ?>
                <tr class="bg-white">
                    <td class="border-purple-300 border-2 text-center"><?= $no++ ?></td>
                    <td class="border-purple-300 border-2 text-center"><?= $dt['tanggal'] ?? '-' ?></td>
                    <td class="border-purple-300 border-2 text-center"><?= $dt['jam_masuk'] ?? '-' ?></td>
                    <td class="border-purple-300 border-2 text-center"><?= $dt['status'] ?? '-' ?> </td>
                </tr>
            <?php } ?>
        </table>
        </section>
    </div>
</body>
<?php if (isset($_GET['pesan'])): ?>
    <script>
        Swal.fire({
        icon: 'good',
        title: 'Welcome',
        text: "<?= htmlspecialchars($_GET['pesan']) ?> <?php echo htmlspecialchars($nama) ?>",
        confirmButtonColor: 'red',
        confirmButtonText: 'OKAY',
        }).then(() => {
            const url = new URL(window.location.href);
            url.searchParams.delete('pesan');
            window.history.replaceState({}, '', url);
        });
    </script>
<?php endif; ?>
<script src="../../assets/js/index_siswa.js?<?= time ()?>"></script>
</html>