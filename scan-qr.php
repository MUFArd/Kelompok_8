<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absensi Siswa</title>
  <link rel="stylesheet" href="assets/css/index.css?=<?= time() ?>" type="text/css">
  <link rel="icon" href="assets/img/bpm.jpg">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/html5-qrcode"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="assets/js/index.js"></script>
</head>

<body class="hidden max-[1080px]:block bg-gradient-to-tl from-blue-200 to-white grid place-items-center min-h-screen">

  <img src="assets/img/Element_sekolah/PAUD-AL-UNAYAH.png" alt="">
  <h1 class="text-2xl font-bold text-purple-500"><i class="fa-solid fa-star"></i>PAUD AL-UNAYAH<i class="fa-solid fa-star"></i></h1>
  <div id="scanner-modal">
    <div id="reader-wrapper">
      <div id="reader"></div>
    </div>
  </div>
  <button id="open" type="button" onclick="bukaScanner()"
    class=" w-[90%] rounded-xl  bg-green-500 text-white text-xl font-bold h-14 relative top-[62vh] left-[50%] -translate-x-[50%]">Buka QR Code</button>
  <button type="button" id="close" onclick="tutupScanner()"
    class="w-[90%] rounded-xl bg-red-500 text-white text-xl font-bold h-14 relative top-[64vh] left-[50%] -translate-x-[50%]">
    Tutup
  </button>
  <audio id="scan-sound" src="Beep.mp3" preload="auto"></audio>
  <script>


  </script>

  <?php if (isset($_GET['pesan-berhasil'])): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Info',
        text: "<?= htmlspecialchars($_GET['pesan-berhasil']) ?>",
        confirmButtonColor: '#3085d6',
        color: 'red',
        background: '#fff',
        confirmButtonText: 'OKAY',
        focusConfirm: false,
      }).then(() => {
        const url = new URL(window.location.href);
        url.searchParams.delete('pesan-berhasil');
        window.history.replaceState({}, '', url);
      });
    </script>
  <?php endif; ?>

  <?php if (isset($_GET['pesan-sudah'])): ?>
    <script>
      Swal.fire({
        icon: 'info',
        title: 'Info',
        text: "<?= htmlspecialchars($_GET['pesan-sudah']) ?>",
        confirmButtonColor: '#3085d6',
        color: 'red',
        background: '#fff',
        confirmButtonText: 'OKAY',
        focusConfirm: false,
      }).then(() => {
        const url = new URL(window.location.href);
        url.searchParams.delete('pesan-sudah');
        window.history.replaceState({}, '', url);
      });
    </script>
  <?php endif; ?>

  <?php if (isset($_GET['pesan-gagal'])): ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Info',
        text: "<?= htmlspecialchars($_GET['pesan-gagal']) ?>",
        confirmButtonColor: '#3085d6',
        color: 'red',
        background: '#fff',
        confirmButtonText: 'OKAY',
        focusConfirm: false,
      }).then(() => {
        const url = new URL(window.location.href);
        url.searchParams.delete('pesan-gagal');
        window.history.replaceState({}, '', url);
      });
    </script>
  <?php endif; ?>

</body>

</html>