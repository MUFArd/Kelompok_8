<?php
ob_start();
error_reporting(E_ALL & ~E_DEPRECATED); 
session_start();
date_default_timezone_set('Asia/Jakarta');
include '../config/koneksi.php';

$authFile = __DIR__ . '/credentials.json';
if (!file_exists($authFile)) {
    header("Location: ../index.php?pesan-gagal=" . urlencode("File credentials.json tidak ditemukan"));
    exit;
}

require __DIR__ . '../vendorGoogleSheet/vendor/autoload.php'; 

use Google\Client as GoogleClient;
use Google\Service\Sheets as GoogleSheets;
use Google\Service\Sheets\ValueRange;

$kode_qr = isset($_POST['NISN']) ? trim($_POST['NISN']) : '';
$tanggal = date('Y-m-d');
$jam = date('H:i:s');

if ($kode_qr === '') {
    header("Location: ../scan-qr.php?pesan-gagal=" . urlencode("NIS kosong"));
    exit;
}

$siswa =    mysqli_query($conn, "SELECT * FROM siswa WHERE kode_siswa='$kode_qr'");
if (mysqli_num_rows($siswa) > 0) {
    $s = mysqli_fetch_array($siswa);
    $siswa_id = $s['id_siswa'];
    $siswa_nama = $s['nama'];
    $siswa_nomer = $s['telepon'];

    $cek = mysqli_query($conn, "SELECT * FROM absensi WHERE id_siswa='$siswa_id' AND tanggal='$tanggal'");
    if (mysqli_num_rows($cek) == 0) {
        $status = ($jam > "07:30:59") ? 'Terlambat' : 'Hadir';
        mysqli_query($conn, "INSERT INTO absensi (id_siswa, tanggal, jam_masuk, status) VALUES ('$siswa_id', '$tanggal', '$jam', '$status')");

        // Google Sheets API
        $client = new GoogleClient();
        $client->setApplicationName('Absensi Otomatis');
        $client->setScopes([GoogleSheets::SPREADSHEETS]);
        $client->setAuthConfig($authFile);
        $client->setAccessType('offline');

        $service = new GoogleSheets($client);
        $spreadsheetId = '12mA-fOcQ2C-phFj6YjTI6-CmP_vjtX4qxNrJwmqg4Ok';
        $range = 'Absen_Siswa!A:D';

        $values = [[$siswa_nama, $jam, $tanggal, $status]];
        $body = new ValueRange(['values' => $values]);
        $params = ['valueInputOption' => 'RAW'];

        try {
            $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
        } catch (Exception $e) {
            file_put_contents('log_sheets_error.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
        }

        // Kirim WA via Fonnte
        $pesan = "Kami dari Sekolah PAUD AL UNAYAH memberikan info bahwa anda sudah absen hari ini pada jam $jam.";
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'target' => $siswa_nomer,
                'message' => $pesan,
                'countryCode' => '62',
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: m2AVpZiddB78ZKmb5uzr'
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        // Simpan log WA jika perlu
        file_put_contents('log_wa.txt', date('Y-m-d H:i:s') . " | $siswa_nomer | $response" . PHP_EOL, FILE_APPEND);

        header("Location: ../scan-qr.php?pesan-berhasil=" . urlencode("Berhasil Absen"));
        exit;
    } else {
        header("Location: ../scan-qr.php?pesan-sudah=" . urlencode("Sudah Absen"));
        exit;
    }
} $guru = mysqli_query($conn, "SELECT * FROM guru WHERE kode_guru='$kode_qr'");
if (mysqli_num_rows($guru) > 0) {
    $g = mysqli_fetch_array($guru);
    $guru_id   = $g['id_guru'];
    $guru_nama = $g['nama_guru'];
    $guru_nomer= $g['no_telp'];

    $cek_guru = mysqli_query($conn, "SELECT * FROM absensi WHERE id_guru='$guru_id' AND tanggal='$tanggal'");
    if (mysqli_num_rows($cek_guru) == 0) {
        $status = ($jam > "07:30:59") ? 'Terlambat' : 'Hadir';
        mysqli_query($conn, "INSERT INTO absensi (id_guru, tanggal, jam_masuk, status) 
                             VALUES ('$guru_id', '$tanggal', '$jam', '$status')");

        $client = new GoogleClient();
        $client->setApplicationName('Absensi Otomatis');
        $client->setScopes([GoogleSheets::SPREADSHEETS]);
        $client->setAuthConfig($authFile);
        $client->setAccessType('offline');

        $service = new GoogleSheets($client);
        $spreadsheetId = '12mA-fOcQ2C-phFj6YjTI6-CmP_vjtX4qxNrJwmqg4Ok';
        $range = 'Absen_Guru!A:D';

        $values = [[$guru_nama, $jam, $tanggal, $status]];
        $body = new ValueRange(['values' => $values]);
        $params = ['valueInputOption' => 'RAW'];
        $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);

        $pesan = "Halo, $guru_nama sudah absen pada jam $jam ($status).";
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'target' => $guru_nomer,
                'message' => $pesan,
                'countryCode' => '62',
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: m2AVpZiddB78ZKmb5uzr'
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        file_put_contents('log_wa.txt', date('Y-m-d H:i:s') . " | $guru_nomer | $response" . PHP_EOL, FILE_APPEND);

        header("Location: ../scan-qr.php?pesan-berhasil=" . urlencode("Absensi guru berhasil"));
        exit;
    } else {
        header("Location: ../scan-qr.php?pesan-sudah=" . urlencode("Guru sudah absen"));
        exit;
    }
}

header("Location: ../scan-qr.php?pesan-gagal=" . urlencode("Kode tidak ditemukan di siswa maupun guru"));
exit;


?>