<?php
session_start();

if (isset($_GET['pesan'])) {}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"  />
    <link rel="stylesheet" href="assets/css/login.css?<?= time () ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login</title>
</head>
<body>
<span class="img1"></span>
<span class="img2"></span>
<span class="img3"></span>
<span class="img4"></span>
<span class="img5"></span>
<div class="form-login" >
<div class="text">
    <h1>Selamat Datang</h1>
    <h2><p class="animated-text">
  <span>Y</span><span>u</span><span>k</span><span>,</span><span> </span>
  <span>A</span><span>k</span><span>s</span><span>e</span><span>s</span><span> </span>
  <span>a</span><span>k</span><span>u</span><span>n</span><span> </span><span>m</span><span>u</span><span>.</span><span> </span>
  <span>M</span><span>a</span><span>s</span><span>u</span><span>k</span><span> </span>
  <span>U</span><span>n</span><span>t</span><span>u</span><span>k</span><span> </span>
  <span>M</span><span>e</span><span>l</span><span>a</span><span>n</span><span>j</span><span>u</span><span>t</span><span>k</span><span>a</span><span>n</span>
</p>
</h2>
</div>
<div class="logo">
    <img  src="assets/img/bpm.png" alt="">
    <p>SMK Bina Putra Mandiri</p>
</div>
<div class="form">
<form method="POST" class="active" action="proses/login_proses.php" id="formlogin">
<h2>Login</h2>
    <div class="wrapper">
        <input type="text" name="username" value="" placeholder="" required>
        <label><i class="fa-solid fa-user"></i><p>Username</p></label>
    </div>
    <div class="wrapper">
        <i class="fa-solid fa-eye" id="seepassword"></i>
        <input type="password" name="password" id="password-input" value="" placeholder="" required>
        <label><i class="fa-solid fa-lock"></i><p>Password</p></label>
    </div>
    <button type="button" id="bttn-lupa-password" >Lupa Password ?</button>
    <button name="login" id="btn-submit">Login</button>
</form>
<form action="proses/lupa_password_proses.php" method="post" id="form-lupa-password">
    <h2>Lupa Password </h2>
    <p>Masukkan Nomor yang terhubung dengan akun anda</p>
    <div class="wrapper">
        <input type="number" name="telepon" value="" placeholder="" required>
        <label><i class="fa-solid fa-mobile"></i><p>Telepon</p></label>
    </div>
    <button name="kirim" id="btn-submit" >Kirim</button>
    <button type="button" id="bttn-login">Kembali</button>
</form>
</div>
</div>
</body>
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
         window.scrollTo(0, 0);
    </script>
<?php endif; ?>
  <?php if (isset($_GET['pesan-berhasil'])): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Info',
        text: "<?= htmlspecialchars($_GET['pesan-berhasil']) ?>",
        confirmButtonColor: '#3085d6',
        color:'red',
        background: '#fff',
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
        color:'red',
        background: '#fff',
        confirmButtonText: 'OKAY',
        heightAuto:false



    }).then(() => {
            const url = new URL(window.location.href);
            url.searchParams.delete('pesan-gagal');
            window.history.replaceState({}, '', url);
        });
</script>
<?php endif; ?>

<script src="assets/js/login.js?<?= time ()?>"></script>
</html>