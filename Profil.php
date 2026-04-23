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
    <title>Profil</title>
</head>
<body>

<h2>Profil User</h2>

<p>Username: <b><?php echo $_SESSION['username']; ?></b></p>
<p>Status: Aktif</p>
<p>Role: Administrator</p>

<a href="dashboard.php">Kembali ke Dashboard</a>

</body>
</html> profil
