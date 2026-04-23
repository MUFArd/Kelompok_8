<?php
ob_start();
error_reporting(E_ALL & ~E_DEPRECATED); 
session_start();
date_default_timezone_set('Asia/Jakarta');
include '../config/koneksi.php';

use Google\Client as GoogleClient;
use Google\Service\Sheets as GoogleSheets;
use Google\Service\Sheets\ValueRange;

$authFile = __DIR__ . '/credentials.json';
if (!file_exists($authFile)) {
    header("Location: ../dashboard/guru/index.php?pesan=" . urlencode("File credentials.json tidak ditemukan"));
    exit;
}

require __DIR__ . '../vendorGoogleSheet/vendor/autoload.php';

$id_siswa = $_POST['id_absen'] ?? '';
if (empty($id_siswa)) {
    header("Location: ../dashboard/guru/index.php?pesan=" . urlencode("ID Siswa tidak ditemukan"));
    exit;
}

$query = $conn->prepare("SELECT a.jam_masuk, a.tanggal, a.status,s.nama FROM absensi a join siswa s on s.id_siswa = a.id_siswa  WHERE a.id_absen = ?");
$query->bind_param("s", $id_siswa);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    header("Location: ../dashboard/guru/index.php?pesan=" . urlencode("Data siswa tidak ditemukan"));
    exit;
}


$data = $result->fetch_assoc();
$nama    = $data['nama'];
$jam     = $data['jam_masuk'];
$tanggal = $data['tanggal'];
$status  = $data['status'];

// Kirim ke Google Sheets
$client = new GoogleClient();
$client->setApplicationName('Absensi Otomatis');
$client->setScopes([GoogleSheets::SPREADSHEETS]);
$client->setAuthConfig($authFile);
$client->setAccessType('offline');

$service = new GoogleSheets($client);
$spreadsheetId = '12mA-fOcQ2C-phFj6YjTI6-CmP_vjtX4qxNrJwmqg4Ok';
$range = 'Absen_Siswa!A:D';

$values = [[$nama, $jam, $tanggal, $status]];
$body = new ValueRange(['values' => $values]);
$params = ['valueInputOption' => 'RAW'];

try {
    $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
    header("Location: ../dashboard/guru/index.php?pesan=" . urlencode("Data berhasil dikirim ke Google Sheets"));
    exit;
} catch (Exception $e) {
    file_put_contents('log_sheets_error.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
    header("Location: ../dashboard/guru/index.php?pesan=" . urlencode("Gagal simpan ke Google Sheets"));
    exit;
}
