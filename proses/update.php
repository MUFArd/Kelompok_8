<?php
// update_nisn.php
session_start();
include '../config/koneksi.php'; // pastikan path sesuai

// array data siswa yang mau diupdate NISN-nya
$siswa_data = [
    ['nik' => '3603225809180003', 'nisn' => '3183019122'],
    ['nik' => '3172030311190006', 'nisn' => '3192586963'],
    ['nik' => '3201230707200001', 'nisn' => '3205244459'],
    ['nik' => '3374082103210002', 'nisn' => '3218154028'],
    ['nik' => '3201207003200001', 'nisn' => '3209318842'],
    ['nik' => '3603230801200002', 'nisn' => '3207909514'],
    ['nik' => '3201185304200001', 'nisn' => '3204891986'],
    ['nik' => '3201183004200002', 'nisn' => '3207558673'],
    ['nik' => '3201184608200001', 'nisn' => '3204302749'],
    ['nik' => '3201234306210001', 'nisn' => '3214158022'],
    ['nik' => '3603236906200002', 'nisn' => '3202537894'],
    ['nik' => '3201182603200002', 'nisn' => '3203963966'],
    ['nik' => '3674014906200002', 'nisn' => '3201161044'],
    ['nik' => '3201180412190003', 'nisn' => '3193730002'],
    ['nik' => '3201180311190004', 'nisn' => '3196904244'],
    ['nik' => '3201230503200004', 'nisn' => '3201040883'],
    ['nik' => '3201235101200002', 'nisn' => '3206516920'],
    ['nik' => '3201182905200004', 'nisn' => '3200766216'],
    ['nik' => '3201232703210002', 'nisn' => '3214782841'],
    ['nik' => '3201181406190001', 'nisn' => '3195857631'],
    ['nik' => '3201236906210001', 'nisn' => '3212327711'],
    ['nik' => '3173045401200001', 'nisn' => '3206416818'],
    ['nik' => '3201204909190004', 'nisn' => '3195231744'],
    ['nik' => '3173046709180009', 'nisn' => '3188341283'],
    ['nik' => '3201200610190003', 'nisn' => '3198643066'],
    ['nik' => '3201201011190004', 'nisn' => '3197227616'],
    ['nik' => '3201230410200001', 'nisn' => '3209299296'],
    ['nik' => '3201202006200001', 'nisn' => '3207946877']
];

// loop untuk update setiap siswa
foreach ($siswa_data as $siswa) {
    $nik = mysqli_real_escape_string($conn, $siswa['nik']);
    $nisn = mysqli_real_escape_string($conn, $siswa['nisn']);
    
    $update = "UPDATE siswa SET NISN='$nisn' WHERE NIK='$nik'";
    if (mysqli_query($conn, $update)) {
        echo "Berhasil update NISN siswa dengan NIK $nik menjadi $nisn <br>";
    } else {
        echo "Gagal update NISN siswa dengan NIK $nik: " . mysqli_error($conn) . "<br>";
    }
}

echo "<br>Proses update selesai!";
?>
