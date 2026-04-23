<?php
    include '../../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Registrasi</title>
</head>

<body class="bg-gradient-to-br from-white to-blue-200 h-screen w-full flex items-center justify-center">
    <div class="form-login w-full h-auto max-w-sm bg-white p-4 rounded-lg shadow-lg ">
        <form class="grid gap-1" method="POST" action="../../proses/registrasi_proses.php" autocomplete="off">
            <img src="../../assets/img/bpm.jpg" alt="">
            <h1 class="text-3xl text-center text-purple-500 font-bold mb-10">Registrasi</h1>
            <label class="text-md" for="">Username</label>
            <input class="h-10 p-2 border-2 border-purple-300 rounded-lg w-full mb-4" type="text" name="username" placeholder="Username" maxlength="50" required>
            <label class="text-md" for="">Password</label>
            <input class="h-10 p-2 border-2 border-purple-300 rounded-lg w-full mb-4" type="password" name="password" placeholder="Password" maxlength="50" required>
            <select name="level" id="level" class="w-full h-10 pl-2 bg-white mb-1">
                <option value="" required disabled selected hidden>Pilih Level</option>
                <option value="Admin">Admin</option>
                <option value="Kepsek">Kepala Sekolah</option>
            </select>
            <button class="w-full bg-orange-500 h-10 rounded-lg shadow-lg text-white text-lg font-bold my-2" name="registrasi" id="btn-registrasi">Registrasi</button>
            <button class="w-full bg-red-500 h-8 rounded-lg shadow-lg text-white font-bold" onclick="history.back()">Kembali</button>
        </form>
    </div>
</body>
<script src="../../assets/js/registrasi.js"></script>

</html>