<?php
session_start();
include '../../config/koneksi.php';
$kelas = $conn->prepare("SELECT * FROM rombel ORDER BY kelas_rombel ASC");
$kelas->execute();
$result = $kelas->get_result();
if (isset($_GET['Tambah-data']))

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Tambah Siswa</title>
</head>

<body class="w-full h-screen flex items-center justify-center bg-gradient-to-tl from-blue-200 to-white">
    <div class="container w-full max-w-sm bg-white shadow-xl rounded-xl p-4 relative">
        <form id="form1" action="../../proses/tambah_guru_proses.php" method="POST" class="block">
            <h1 class="text-xl text-purple-500 font-bold text-center mb-8">Tambah Data Guru</h1>

            <div class="label-input mb-2">
                <input class="w-full h-8 p-2 border-2 border-purple-300 rounded-xl"
                    type="text" id="nama_input" name="nama" placeholder="Nama" required>
            </div>
            <div class="label-input mb-2">
                <select id="jenis_kelamin_input" name="jenis_kelamin" required class="w-full p-2 bg-white">
                    <option value="" disabled selected hidden>Jenis Kelamin</option>
                    <option value="L">Laki Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="label-input mb-2 h-8">
                <select id="kelas_input" name="kelas" required class="w-full p-2 bg-white">
                    <option value="" disabled selected hidden>Pilih Kelas</option>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($row['kelas_rombel']); ?>"><?php echo htmlspecialchars($row['kelas_rombel']) ?> <?php echo htmlspecialchars($row['nama_rombel']) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="label-input mb-2">
                <input class="w-full h-8 p-2 border-2 border-purple-300 rounded-xl"
                    type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="label-input mb-2">
                <input class="w-full h-8 p-2 border-2 border-purple-300 rounded-xl"
                    type="password" id="password" name="password" placeholder="Password" required>
            </div>

            <div class="label-input mb-4">
                <input class="w-full h-8 p-2 border-2 border-purple-300 rounded-xl"
                    type="number" id="telepon_input" name="telepon" placeholder="Telepon" >
            </div>
            <button type="Submit" name="tambah_siswa"
                class="w-full bg-orange-500 h-10 rounded-lg shadow-lg text-white text-lg font-bold my-2"
                >
                Simpan
            </button>
            <button type="button"
                class="w-full bg-red-500 h-8 rounded-lg shadow-lg text-white text-lg font-bold my-2"
                onclick="location.href='./index.php'">
                Kembali
            </button>
        </form>
    </div>
</body>
<?php if (isset($_GET['Tambah-data'])): ?>
        <script>
            Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "<?= htmlspecialchars($_GET['Tambah-data']) ?> ",
            confirmButtonColor: 'red',
            confirmButtonText: 'OKAY',
            }).then(() => {
                const url = new URL(window.location.href);
                url.searchParams.delete('Tambah-data');
                window.history.replaceState({}, '', url);
            });
        </script>
    <?php endif; ?>

</html>