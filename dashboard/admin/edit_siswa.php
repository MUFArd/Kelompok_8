    <?php
    session_start();
    include '../../config/koneksi.php';

    if (isset($_GET['nis'])) {
        $nisn = $_GET['nis'];
        $query = $conn->prepare("SELECT * FROM siswa WHERE NISN = ?");
        $query->bind_param("s", $nisn);
        $query->execute();
        $result = $query->get_result();
        $siswa = $result->fetch_assoc();
    }

    $kelas = $conn->prepare("SELECT * FROM rombel ORDER BY kelas_rombel ASC");
    $kelas->execute();
    $kelas_result = $kelas->get_result();
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Edit Data Siswa</title>
    </head>
    <body class="w-full h-screen flex items-center justify-center bg-gradient-to-tl from-blue-200 to-white">
        <div class="container w-full max-w-sm bg-white shadow-xl rounded-xl p-4">
            <form action="../../proses/update_siswa_proses.php" method="POST">
                <h1 class="text-xl text-purple-500 font-bold text-center mb-6">Edit Data Siswa</h1>

                <input type="hidden" name="nisn" value="<?= htmlspecialchars($siswa['NISN']) ?>">

                <div class="mb-2">
                    <input type="text" name="nama" value="<?= htmlspecialchars($siswa['nama']) ?>" placeholder="Nama"
                        class="w-full h-8 p-2 border-2 border-purple-300 rounded-xl" required>
                </div>

                <div class="mb-2">
                    <select name="jenis_kelamin" required class="w-full p-2 bg-white border-2 border-purple-300 rounded-xl">
                        <option value="L" <?= $siswa['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-Laki</option>
                        <option value="P" <?= $siswa['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>

                <div class="mb-2">
                    <input type="inpur" name="tanggal_lahir" value="<?= $siswa['tanggal_lahir'] ?>"
                        class="w-full h-8 p-2 border-2 border-purple-300 rounded-xl" required>
                </div>

                <div class="mb-2">
                    <input type="text" name="nama_ibu" value="<?= htmlspecialchars($siswa['nama_ibu']) ?>" placeholder="Nama Ibu"
                        class="w-full h-8 p-2 border-2 border-purple-300 rounded-xl" required>
                </div>

                <div class="mb-2">
                    <input type="number" name="nik" value="<?= $siswa['NIK'] ?>" placeholder="NIK"
                        class="w-full h-8 p-2 border-2 border-purple-300 rounded-xl" required>
                </div>

                <div class="mb-2">
                    <select name="kelas_rombel" required class="w-full p-2 bg-white border-2 border-purple-300 rounded-xl">
                        <?php while ($row = $kelas_result->fetch_assoc()) { ?>
                            <option value="<?= $row['kelas_rombel'] ?>" <?= $row['kelas_rombel'] == $siswa['kelas_rombel'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($row['kelas_rombel']) ?> <?= htmlspecialchars($row['nama_rombel']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-4">
                    <input type="number" name="telepon" value="<?= $siswa['telepon'] ?>" placeholder="Telepon"
                        class="w-full h-8 p-2 border-2 border-purple-300 rounded-xl" >
                </div>

                <button type="submit" name="update_siswa"
                    class="w-full bg-green-500 h-10 rounded-lg shadow-lg text-white font-bold mb-2">
                    Simpan Perubahan
                </button>

                <a href="./index.php" class="block w-full text-center bg-red-500 h-8 rounded-lg shadow-lg text-white font-bold">
                    Kembali
                </a>
            </form>
        </div>
    </body>
    </html>