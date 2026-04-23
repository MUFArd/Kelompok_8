<?php
session_start();
include '../config/koneksi.php';
require '../vendor/autoload.php'; // PhpSpreadsheet
include 'phpqrcode/qrlib.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['upload_excel'])) {

    if (isset($_FILES['excel_file']['name'])) {
        $fileName = $_FILES['excel_file']['name'];
        $fileType = $_FILES['excel_file']['type'];
        $fileTmp = $_FILES['excel_file']['tmp_name'];

        $allowed_types = [
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        if (in_array($fileType, $allowed_types)) {
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $reader = ($ext == 'xlsx') ? IOFactory::createReader('Xlsx') : IOFactory::createReader('Xls');
            $spreadsheet = $reader->load($fileTmp);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            $successCount = 0;
            $errorCount = 0;

            $dir = '../assets/img/qrcode_siswa';
            if (!file_exists($dir)) mkdir($dir, 0777, true);

            for ($i = 1; $i < count($sheetData); $i++) {
                $nama = $sheetData[$i][0] ?? '';
                $jenis_kelamin = $sheetData[$i][1] ?? '';
                $tanggal_lahir = $sheetData[$i][2] ?? '';
                $nama_ibu = $sheetData[$i][3] ?? '';
                $nik = $sheetData[$i][4] ?? '';
                $nisn = $sheetData[$i][5] ?? '';
                $kelas = $sheetData[$i][6] ?? '';
                $telepon = $sheetData[$i][7] ?? '';
                $username = $nisn;
                $password = $nisn;

                $cek_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE NIK='$nik'");
                if (mysqli_num_rows($cek_siswa) > 0) {
                    $errorCount++;
                    continue;
                }

                $q_kode_siswa = mysqli_query($conn, "SELECT MAX(id_siswa) as last_id FROM siswa");
                $row = mysqli_fetch_assoc($q_kode_siswa);
                $last_id = $row['last_id'] ?? 0;
                $next_id = $last_id + 1;
                $kode_siswa = 'SISWA' . str_pad($next_id, 3, '0', STR_PAD_LEFT);

                $stmt = $conn->prepare("INSERT INTO siswa (nama, jenis_kelamin, tanggal_lahir, nama_ibu, NIK, NISN, kelas_rombel, telepon, kode_siswa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssssss", $nama, $jenis_kelamin, $tanggal_lahir, $nama_ibu, $nik, $nisn, $kelas, $telepon, $kode_siswa);

                if ($stmt->execute()) {
                    $id_siswa = $conn->insert_id;

                    $file_qr = $dir . '/' . $kode_siswa . '.png';
                    QRcode::png($kode_siswa, $file_qr, QR_ECLEVEL_L, 5);

                    $stmt_update = $conn->prepare("UPDATE siswa SET qr_path=? WHERE kode_siswa=?");
                    $stmt_update->bind_param("ss", $file_qr, $kode_siswa);
                    $stmt_update->execute();
                    $stmt_update->close();

                    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
                    $stmt_user = $conn->prepare("INSERT INTO users (username, password, level, id_siswa) VALUES (?, ?, 'siswa', ?)");
                    $stmt_user->bind_param("ssi", $username, $hashed_pass, $id_siswa);
                    $stmt_user->execute();
                    $stmt_user->close();

                    $successCount++;
                } else {
                    $errorCount++;
                }
                $stmt->close();
            }

            header("Location: ../dashboard/admin/tambah_siswa.php?Upload-data=Berhasil%20($successCount%20berhasil,%20$errorCount%20gagal)");
            exit;
        } else {
            header("Location: ../dashboard/admin/tambah_siswa.php?Upload-data=Format%20file%20tidak%20didukung");
            exit;
        }
    }
} else {
    header("Location: ../dashboard/admin/tambah_siswa.php");
    exit;
}
