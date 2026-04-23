<?php
session_start();

if (isset($_GET['pesan'])) {}
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
  <title>Login</title>
</head>
<body class="bg-gradient-to-b from-blue-200 to-white grid place-items-center min-h-screen overflow-hidden">

  <div class="w-full max-w-sm bg-gradient-to-tl from-blue-100 to-white p-6 rounded-2xl shadow-lg space-y-6 relative">
    <img src="https://png.pngtree.com/png-clipart/20250104/original/pngtree-kids-reading-book-clipart-with-transparent-background-png-image_18955171.png" alt="" srcset=""
    class="w-1/2 mx-auto mt-4"
    >
    <!-- Logo Sekolah -->
    <div class="grid grid-cols-[1fr_3fr] items-center absolute -top-4 left-0">
      <img src="assets/img/Element_sekolah/PAUD-AL-UNAYAH.png" alt="logo" 
      class="w-12 ">
      <p class="text-lg font-bold text-purple-600">PAUD AL-UNAYAH</p>
    </div>

    <!-- Form Login -->
    <form method="POST" action="proses/login_proses.php" id="formlogin" class="space-y-4">
      <h2 class="text-2xl font-semibold text-purple-500">
        Login
      </h2>
      <div class="space-y-1">
        <label class="text-gray-600 flex items-center gap-2 text-sm">
          <i class="fa-solid fa-child text-red-600"></i> Username
        </label>
        <input type="text" name="username" required
          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400">
      </div>

      <div class="space-y-1">
        <label class="text-gray-600 flex items-center gap-2 text-sm">
          <i class="fa-solid fa-puzzle-piece text-green-500"></i> Password
        </label>
        <div class="relative">
          <input type="password" name="password" id="password-input" required
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 pr-10">
          <i class="fa-solid fa-eye absolute right-3 top-3 text-gray-500 cursor-pointer text-orange-500" id="seepassword"></i>
        </div>
      </div>

      <button type="button" id="bttn-lupa-password"
        class="text-sm text-purple-600 hover:underline">Lupa Password?</button>

      <button type="submit" name="login"
        class="w-full py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition">Login</button>
    </form>

    <!-- Form Lupa Password -->
    <form action="proses/lupa_password_proses.php" method="post" id="form-lupa-password" class="hidden space-y-4">
      <h2 class="text-lg font-semibold text-purple-500">Lupa Password</h2>
      <p class="text-sm text-gray-500">Masukkan nomor yang terhubung dengan akun anda</p>
      <div class="space-y-1">
        <label class="text-gray-600 flex items-center gap-2 text-sm">
          <i class="fa-solid fa-mobile"></i> Telepon
        </label>
        <input type="number" name="telepon" required
          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400">
      </div>
      <button type="submit" name="kirim"
        class="w-full py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition">Kirim</button>
      <button type="button" id="bttn-login"
        class="w-full py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">Kembali</button>
    </form>
  </div>

<?php if (isset($_GET['pesan'])): ?>
<script>
Swal.fire({
  icon: 'error',
  title: 'Info',
  text: "<?= htmlspecialchars($_GET['pesan']) ?>",
  confirmButtonColor: 'red',
  confirmButtonText: 'OKAY',
  heightAuto: false
}).then(() => {
  const url = new URL(window.location.href);
  url.searchParams.delete('pesan');
  window.history.replaceState({}, '', url);
});
</script>
<?php endif; ?>

<?php if (isset($_GET['pesan-berhasil'])): ?>
<script>
Swal.fire({
  icon: 'success',
  title: 'Info',
  text: "<?= htmlspecialchars($_GET['pesan-berhasil']) ?>",
  confirmButtonColor: '#3085d6',
  confirmButtonText: 'OKAY',
  heightAuto:false
}).then(() => {
  const url = new URL(window.location.href);
  url.searchParams.delete('pesan-berhasil');
  window.history.replaceState({}, '', url);
});
</script>
<?php endif; ?>

<?php if (isset($_GET['pesan-gagal'])): ?>
<script>
Swal.fire({
  icon: 'info',
  title: 'Info',
  text: "<?= htmlspecialchars($_GET['pesan-gagal']) ?>",
  confirmButtonColor: '#3085d6',
  confirmButtonText: 'OKAY',
  heightAuto:false
}).then(() => {
  const url = new URL(window.location.href);
  url.searchParams.delete('pesan-gagal');
  window.history.replaceState({}, '', url);
});
</script>
<?php endif; ?>

<script src="assets/js/login.js?<?= time()?>"></script>
</body>
</html>
