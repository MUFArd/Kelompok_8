    <?php
    include '../../config/koneksi.php';
    session_start();

    if (!isset($_SESSION['id_user']) || $_SESSION['level'] != 'Admin') {
        header('Location: ../../index.php');

        exit;
    }

    $data_user = mysqli_query($conn, "
        SELECT 
            COUNT(*) AS total,
            SUM(CASE WHEN level = 'Admin' THEN 1 ELSE 0 END) AS Operator,
            SUM(CASE WHEN level = 'Kepsek' THEN 1 ELSE 0 END) AS Kepsek,
            SUM(CASE WHEN level = 'Guru' THEN 1 ELSE 0 END) AS Guru,
            SUM(CASE WHEN level = 'Siswa' THEN 1 ELSE 0 END) AS Siswa
        FROM users
    ");
    $total =  mysqli_fetch_assoc($data_user);

    if (isset($_GET['pesan']))
        if (isset($_GET['edit-data']))
            if (isset($_GET['Tambah-data']))
                if (isset($_GET['pesan-hapus']))

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <title>Admin Dashboard</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    </head>

    <body class="select-none">
        <header class="w-full h-14 bg-purple-500 text-white flex items-center justify-between fixed top-0 z-[9999]">
            <div class="logo relative flex items-center gap-1 bg-purple-500 text-white p-2 fixed top-0 w-full h-14">
                <img src="../../assets/img/Element_sekolah/PAUD-AL-UNAYAH.png" alt="" class="w-14">
                <h1 class="text-xl font-bold text-white">PAUD AL-UNAYAH</h1>
            </div>
            <i class="fa-solid fa-bars text-2xl text-white relative mr-4 cursor-pointer" id="menu-toggle" onclick="document.querySelector('aside').classList.toggle('translate-x-0')"></i>
        </header>
        <aside class="max-w-sm w-1/2 h-screen bg-purple-400 text-white p-4 fixed top-14 right-0 transition-transform duration-300 ease-in-out transform translate-x-full z-[9999]">
            <h1 class="bg-orange-400 w-full h-10 flex justify-center items-center text-xl font-bold rounded-lg shadow-lg select-none">Menu</h1>
            <div class="wrapper">
                <div class="bttn-wrapper">
                    <button class="bttn-dashboard bg-red-400 w-full h-8 flex items-center gap-2 text-sm font-bold rounded-lg shadow-lg select-none mt-10 pl-4 "
                        onclick="showContent('.content-dashboard')">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Dashboard</span>
                    </button>
                </div>
                <div class="bttn-wrapper ">
                    <button class="bttn-tabel_user bg-green-400 w-full h-8 flex items-center gap-2 text-sm font-bold rounded-lg shadow-lg select-none mt-4 pl-4"
                        onclick="showContent('.content-tabel_user')">
                        <i class="fa-solid fa-user"></i>
                        <span>User</span>
                    </button>
                </div>
                <div class="bttn-wrapper">
                    <button class="bttn-tabel_siswa bg-blue-400 w-full h-8 flex items-center gap-2 text-sm font-bold rounded-lg shadow-lg select-none mt-4 pl-4"
                        onclick="showContent('.content-tabel_siswa')">
                        <i class="fa-solid fa-user-graduate"></i>
                        <span>Siswa</span>
                    </button>
                </div>
                <div class="bttn-wrapper">
                    <button class="bttn-tabel_walas bg-pink-400 w-full h-8 flex items-center gap-2 text-sm font-bold rounded-lg shadow-lg select-none mt-4 pl-4"
                        onclick="showContent('.content-tabel_walas')">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <span>Guru</span>
                    </button>
                </div>
            </div>
            <div class="bttn-wrapper">
                <button class="bttn-tabel_walas bg-red-400 w-full h-8 flex items-center gap-2 text-sm font-bold rounded-lg shadow-lg select-none mt-20 pl-4"
                    onclick="location.href='registrasi.php'">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Data</span>
                </button>
            </div>
            <div class="bttn-wrapper">
                <button class="bttn-tabel_walas bg-green-400 w-full h-8 flex items-center gap-2 text-sm font-bold rounded-lg shadow-lg select-none mt-4 pl-4"
                    onclick="location.href='tambah_siswa.php'">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Tambah Siswa</span>
                </button>
            </div>
            <div class="bttn-wrapper">
                <button class="bttn-tabel_walas bg-blue-400 w-full h-8 flex items-center gap-2 text-sm font-bold rounded-lg shadow-lg select-none mt-4 pl-4"
                    onclick="location.href='tambah_guru.php'">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Tambah Guru</span>
                </button>
            </div>
            <div class="bttn-wrapper">
                <button class="bttn-logout bg-yellow-400 w-full h-8 flex items-center gap-2 text-sm font-bold rounded-lg shadow-lg select-none mt-20 pl-4 " onclick="location.href='../../logout.php'">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </div>

        </aside>

        <div class="container mt-14 p-4">
            <section class="content-dashboard max-w-md ">
                <div class="data_user bg-white p-4 py-4 rounded-lg shadow-lg">
                    <h2 class="w-full h-10 bg-red-400 text-white font-bold flex items-center justify-center rounded-lg shadow-lg flex gap-2"><i class="fa-solid fa-chart-column "></i>Data User</h2>
                    <div class="chart_user mt-8">
                        <div class="total shadow-lg p-2 rounded-lg">
                            <div class="border-b-2 border-pink-500 flex items-center gap-2">
                                <i class="fa-solid fa-user text-lg text-pink-500"></i>
                                <span class="text-lg text-pink-500">Total User</span>
                            </div>
                            <h2 class=" flex items-center text-pink-500 text-3xl font-bold mt-2"><?= htmlspecialchars($total['total']) ?></h2>
                        </div>
                        <div class="bagian">
                            <div class="wrapper shadow-lg p-2 rounded-lg mt-4 ">
                                <span class="text-lg text-red-400 border-b-2 border-red-400">Admin</span>
                                <h2 class=" flex items-center text-red-500 text-2xl font-bold mt-1"><?= htmlspecialchars($total['Operator']) ?></h2>
                            </div>
                            <div class="wrapper shadow-lg p-2 rounded-lg mt-1">
                                <span class="text-lg text-green-400 border-b-2 border-green-400">Kepala Sekolah</span>
                                <h2 class=" flex items-center text-green-500 text-2xl font-bold mt-1"><?= htmlspecialchars($total['Kepsek']) ?></h2>
                            </div>
                            <div class="wrapper shadow-lg p-2 rounded-lg mt-1">
                                <span class="text-lg text-blue-400 border-b-2 border-blue-400">Guru</span>
                                <h2 class=" flex items-center text-blue-500 text-2xl font-bold mt-1"><?= htmlspecialchars($total['Guru']) ?></h2>
                            </div>
                            <div class="wrapper shadow-lg p-2 rounded-lg mt-1">
                                <span class="text-lg text-purple-400 border-b-2 border-purple-400">Siswa</span>
                                <h2 class=" flex items-center text-purple-500 text-2xl font-bold mt-1"><?= htmlspecialchars($total['Siswa']) ?></h2>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="show-section mt-4 p-4 bg-gray-100 rounded-lg shadow-lg flex gap-2 justify-evenly">
                    <button onclick="document.querySelector('.content-tabel_user').classList.toggle('hidden')" class="px-4 py-2 bg-purple-400 text-white rounded-lg shadow hover:bg-purple-500 transition">
                        Tabel User
                    </button>

                    <button onclick="document.querySelector('.content-tabel_siswa').classList.toggle('hidden')" class="px-4 py-2 bg-purple-400 text-white rounded-lg shadow hover:bg-purple-500 transition">
                        Tabel Siswa
                    </button>

                    <button onclick="document.querySelector('.content-tabel_walas').classList.toggle('hidden')" class="px-4 py-2 bg-purple-400 text-white rounded-lg shadow hover:bg-purple-500 transition">
                        Tabel Walas
                    </button>
                </div>


            </section>
            <section class="content-tabel_siswa p-4 hidden">
                <h1 class="bg-blue-400 h-10 flex items-center justify-center text-white text-lg font-bold rounded-lg shadow-lg">
                    Tabel Siswa
                </h1>

                <!-- Search bar -->
                <div class="my-4">
                    <input
                        type="text"
                        id="searchSiswa"
                        placeholder="Cari siswa (nama, NISN, kelas, dll...)"
                        class="w-full p-2 border-2 border-blue-400 rounded-lg shadow-sm"
                        onkeyup="filterTable('searchSiswa','tableSiswa')">
                </div>

                <?php
                $no = 1;
                $siswa_tabel = mysqli_query($conn, "
        SELECT a.*, r.* 
        FROM siswa a 
        LEFT JOIN rombel r ON a.kelas_rombel = r.kelas_rombel
        ORDER BY a.kelas_rombel ASC, LEFT(nama,1) ASC, nama ASC
    ");
                ?>

                <table id="tableSiswa" class="w-full mt-4 border-collapse shadow-lg" cellpadding="5">
                    <tr class="header_row border-purple-300 border-b-2 text-purple-500">
                        <th class="border-purple-300">NO</th>
                        <th class="border-purple-300">NAMA</th>
                        <th class="border-purple-300">L/P</th>
                        <th class="border-purple-300">Tgl Lahir</th>
                        <th class="border-purple-300">NISN</th>
                        <th class="border-purple-300">NIK</th>
                        <th class="border-purple-300">NAMA IBU</th>
                        <th class="border-purple-300">NO. Telp</th>
                        <th class="border-purple-300">KELAS</th>
                        <th class="border-purple-300">AKSI</th>
                    </tr>

                    <?php while ($st = mysqli_fetch_array($siswa_tabel)) { ?>
                        <tr class="odd:bg-white even:bg-gray-100 border-purple-300 relative">
                            <td class="border-purple-300 text-center"><?= $no++ ?></td>
                            <td class="border-purple-300"><?= htmlspecialchars($st['nama']) ?></td>
                            <td class="border-purple-300 text-center"><?= htmlspecialchars($st['jenis_kelamin']) ?></td>
                            <td class="border-purple-300 text-center"><?= htmlspecialchars($st['tanggal_lahir']) ?></td>
                            <td class="border-purple-300"><?= htmlspecialchars($st['NISN']) ?></td>
                            <td class="border-purple-300"><?= htmlspecialchars($st['NIK']) ?></td>
                            <td class="border-purple-300"><?= htmlspecialchars($st['nama_ibu']) ?></td>
                            <td class="border-purple-300"><?= htmlspecialchars($st['telepon']) ?></td>
                            <td class="border-purple-300"><?= htmlspecialchars($st['kelas_rombel']) ?> || <?= htmlspecialchars($st['nama_rombel']) ?></td>

                            <!-- Aksi mobile -->
                            <td class="lg:hidden text-center">
                                <button
                                    onclick="this.nextElementSibling.classList.toggle('hidden')"
                                    class="bg-blue-400 text-white px-3 py-1 rounded-lg">
                                    Cek
                                </button>
                                <div class="hidden absolute flex flex-col mt-2 bg-white shadow-md rounded-lg z-[1000] right-10">
                                    <a class="px-10 py-2 hover:bg-gray-100 text-green-600 font-semibold" href="edit_siswa.php?nis=<?= $st['NISN'] ?>">Edit</a>
                                    <a class="px-10 py-2 hover:bg-gray-100 text-red-600 font-semibold" href="../../proses/hapus_siswa_proses.php?nis=<?= $st['id_siswa'] ?>" onclick="return confirm('Yakin Mau Di Hapus?')">Hapus</a>
                                </div>
                            </td>

                            <!-- Aksi Desktop -->
                            <td class="border-purple-300 text-center lg:gap-2 hidden lg:flex items-center justify-center">
                                <a class="px-2 py-1 bg-green-400 text-white font-semibold rounded-lg" href="edit_siswa.php?nis=<?= $st['NISN'] ?>">Edit</a>
                                <a class="px-2 py-1 bg-red-400 text-white font-semibold rounded-lg" href="../../proses/hapus_siswa_proses.php?nis=<?= $st['id_siswa'] ?>" onclick="return confirm('Yakin Mau Di Hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </section>
            <script>
                function filterTable(inputId, tableId) {
                    let input = document.getElementById(inputId);
                    let filter = input.value.toLowerCase();
                    let table = document.getElementById(tableId);
                    let tr = table.getElementsByTagName("tr");

                    for (let i = 1; i < tr.length; i++) { // skip header
                        let tds = tr[i].getElementsByTagName("td");
                        let show = false;
                        for (let j = 0; j < tds.length; j++) {
                            if (tds[j] && tds[j].innerText.toLowerCase().indexOf(filter) > -1) {
                                show = true;
                                break;
                            }
                        }
                        tr[i].style.display = show ? "" : "none";
                    }
                }
            </script>
            <section class="content-tabel_user mt-4 hidden">
                <h1 class="bg-green-400 h-10 flex items-center justify-center text-white text-lg font-bold rounded-lg shadow-lg">Tabel User</h1>
                <?php
                $no = 1;
                $user_tabel = mysqli_query($conn, "SELECT * FROM users ORDER BY case level when 'Admin' then 1 when 'Kepsek' then 2 when 'Guru' then 3 ELSE 5 END; ");

                ?>

                <table class="w-full mt-4 border-collapse shadow-lg" cellpadding="5">
                    <tr class="header_row border-purple-300 border-b-2 text-purple-500">
                        <th class="no_row border-purple-300 text-center">NO</th>
                        <th class="nama_row border-purple-300">USERNAME</th>
                        <th class="kelas_row border-purple-300 text-center">SEBAGAI</th>
                        <th class="action_row border-purple-300 text-center">AKSI</th>
                    </tr>
                    <?php while ($ut = mysqli_fetch_array($user_tabel)) { ?>
                        <tr class="odd:bg-white even:bg-gray-100 border-purple-300">
                            <td class="border-purple-300 text-center py-4"><?= $no++ ?></td>
                            <td class="border-purple-300"><?= $ut['username'] ?></td>
                            <td class="border-purple-300 text-center"><?= $ut['level'] ?></td>
                            <!-- Aksi mobile -->
                            <td class="lg:hidden text-center">
                                <button
                                    onclick="this.nextElementSibling.classList.toggle('hidden')"
                                    class="bg-green-500 text-white px-3 py-1 rounded-lg">
                                    Cek
                                </button>
                                <div class="hidden absolute flex flex-col mt-2 bg-white shadow-md rounded-lg z-[1000] right-10">
                                    <a class="px-10 py-2 hover:bg-gray-100 text-green-600 font-semibold" href="edit_user.php?id=<?= $ut['id_user'] ?>">Edit</a>
                                    <a class="px-10 py-2 hover:bg-gray-100 text-red-600 font-semibold" href="../../proses/hapus_user_proses.php?username=<?= $ut['username'] ?>" onclick="return confirm('Yakin Mau Di Hapus?')">Hapus</a>
                                </div>
                            </td>
                            <!-- Aksi desktop -->
                            <td class="border-purple-300 text-center lg:gap-2 hidden lg:flex items-center justify-center">
                                <a class="px-2 py-1 bg-green-400 text-white font-semibold rounded-lg" href="edit_user.php?id=<?= $ut['id_user'] ?>">Edit</a>
                                <a class="px-2 py-1 bg-red-400 text-white font-semibold rounded-lg" href="../../proses/hapus_user_proses.php?username=<?= $ut['username'] ?>" onclick="return confirm('Yakin Mau Di Hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

            </section>
            <section class="content-tabel_walas hidden">
                <h1 class="bg-pink-400 h-10 flex items-center justify-center text-white text-lg font-bold rounded-lg shadow-lg">Tabel Guru</h1>

                <?php
                $no = 1;
                $guru = 'Guru';
                $user_tabel = mysqli_query($conn, "SELECT  u.id_guru,
        u.username,
        u.level,
        g.kelas_rombel,
        g.no_telp,
        g.jenis_kelamin,
        r.kelas_rombel,
        r.nama_rombel
        FROM users u
        LEFT JOIN guru g 
        ON u.id_guru = g.id_guru 
        JOIN rombel r ON g.kelas_rombel = r.kelas_rombel
        WHERE u.level = '$guru'
        ORDER BY g.kelas_rombel DESC ");

                ?>

                <table class="w-full mt-4 border-collapse shadow-lg" cellpadding="10">
                    <tr class="header_row border-purple-300 border-b-2 text-purple-500">
                        <th class="no_row border-purple-300 text-center py-4 border-purple-300">NO</th>
                        <th class="nis_row border-purple-300">USERNAME</th>
                        <th class="nis_row border-purple-300">L/P</th>
                        <th class="nis_row border-purple-300">No Telp</th>
                        <th class="nis_row border-purple-300">Kelas</th>
                    </tr>
                    <?php while ($ut = mysqli_fetch_array($user_tabel)) { ?>
                        <tr class="odd:bg-white even:bg-gray-100 border-purple-300 relative">
                            <td><?= $no++ ?></td>
                            <td><?= $ut['username'] ?></td>
                            <td><?= $ut['jenis_kelamin'] ?></td>
                            <td><?= $ut['no_telp'] ?></td>
                            <td><?= $ut['kelas_rombel'] ?> <?= $ut['nama_rombel'] ?></td>
                        <?php } ?>
                </table>
            </section>
        </div>
    </body>
    <?php if (isset($_GET['pesan'])): ?>
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Welcome',
                text: "<?= htmlspecialchars($_GET['pesan']) ?> ",
                confirmButtonColor: 'red',
                confirmButtonText: 'OKAY',
            }).then(() => {
                const url = new URL(window.location.href);
                url.searchParams.delete('pesan');
                window.history.replaceState({}, '', url);
            });
        </script>
    <?php endif; ?>
    <?php if (isset($_GET['edit-data'])): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "<?= htmlspecialchars($_GET['edit-data']) ?> ",
                confirmButtonColor: 'red',
                confirmButtonText: 'OKAY',
            }).then(() => {
                const url = new URL(window.location.href);
                url.searchParams.delete('edit-data');
                window.history.replaceState({}, '', url);
            });
        </script>
    <?php endif; ?>
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
    <?php if (isset($_GET['pesan-hapus'])): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "<?= htmlspecialchars($_GET['pesan-hapus']) ?> ",
                confirmButtonColor: 'red',
                confirmButtonText: 'OKAY',
            }).then(() => {
                const url = new URL(window.location.href);
                url.searchParams.delete('pesan-hapus');
                window.history.replaceState({}, '', url);
            });
        </script>
    <?php endif; ?>
    <script src="../../assets/js/index_admin.js?<?= time() ?>"></script>

    </html>