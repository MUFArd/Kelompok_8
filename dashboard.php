<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Dashboard</h2>
<p>Selamat datang, <b><?php echo $_SESSION['username']; ?></b></p>

<a href="profil.php">Ke Halaman Profil</a><br><br>
<a href="logout.php">Logout</a>

</body>
</html>