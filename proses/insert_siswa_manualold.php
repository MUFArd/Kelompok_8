<?php
session_start();
include '../config/koneksi.php';
include 'phpqrcode/qrlib.php'; 

$siswa_list = [
    [
        'nama' => 'AISYAH INARA PUTRI',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-11-23',
        'nama_ibu' => 'DEVI NURDIANA',
        'nik' => '3175096311200008',
        'nisn' => '3205198142',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'SEPTIYA AULIYA P AZZAHRA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2018-09-18',
        'nama_ibu' => 'SITI NURJANAH',
        'nik' => '3603225809180003',
        'nisn' => '3183019122',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'DEVANA GEZA MIKAIL',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-11-03',
        'nama_ibu' => 'NOVIYANTI',
        'nik' => '3172030311190006',
        'nisn' => '3192586963',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'AKBAR AL-QUDS IRAWAN',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-07-07',
        'nama_ibu' => 'FITRIANI',
        'nik' => '3201230707200001',
        'nisn' => '3205244459',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'HAFLA FATAR BASKARA',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2021-03-21',
        'nama_ibu' => 'NISAA MADYAN FADILAH',
        'nik' => '3374082103210002',
        'nisn' => '3218154028',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'REVA AULIA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-03-30',
        'nama_ibu' => 'WATI',
        'nik' => '3201207003200001',
        'nisn' => '3209318842',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'FARHAN NAUFAL',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-01-08',
        'nama_ibu' => 'MILA',
        'nik' => '3603230801200002',
        'nisn' => '3207909514',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'AZ ZAHRA FITRIANI',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-04-13',
        'nama_ibu' => 'SITI NURJANAH',
        'nik' => '3201185304200001',
        'nisn' => '3204891986',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMAD AL FARIZQIL',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-04-30',
        'nama_ibu' => 'ANIS FITRIA',
        'nik' => '3201183004200002',
        'nisn' => '3207558673',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'DELISHA NURFATIHA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-08-06',
        'nama_ibu' => 'ELA',
        'nik' => '3201184608200001',
        'nisn' => '3204302749',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'MALIKA AZ ZAHRA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2021-06-03',
        'nama_ibu' => 'ROSMINAH',
        'nik' => '3201234306210001',
        'nisn' => '3214158022',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'JIHAN HUMAIROH ZIDNI',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-06-29',
        'nama_ibu' => 'NURHAYAT 1',
        'nik' => '3603236906200002',
        'nisn' => '3202537894',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'ATHALLA NAUFAL SYAHPUTRA',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-03-26',
        'nama_ibu' => 'LALAS UMIYATI',
        'nik' => '3201182603200002',
        'nisn' => '3203963966',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'FATIYAH AL MUNA ZAHRA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-06-09',
        'nama_ibu' => 'NURSIYAH BT. AHMAD',
        'nik' => '3674014906200002',
        'nisn' => '3201161044',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'DENDI ARDIYANSAH',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-12-04',
        'nama_ibu' => 'ЕНА',
        'nik' => '3201180412190003',
        'nisn' => '3193730002',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMAD ABIZAR',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-11-03',
        'nama_ibu' => 'SITI LATIFAH',
        'nik' => '3201180311190004',
        'nisn' => '3196904244',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'KEVIN SANJAYA',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-03-05',
        'nama_ibu' => 'SANTI PRIHATINI',
        'nik' => '3201230503200004',
        'nisn' => '3201040883',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'ATHIYA NAJIHA NURUN',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-01-11',
        'nama_ibu' => 'NURSIAH',
        'nik' => '3201235101200002',
        'nisn' => '3206516920',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'HAERUL SAPUTRA',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-05-29',
        'nama_ibu' => 'SITI NURHASA NAH',
        'nik' => '3201182905200004',
        'nisn' => '3200766216',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMAD AL MAHDI SHARIQUE ZAFRAN',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2021-03-27',
        'nama_ibu' => 'RATNA PUSPITA SARI',
        'nik' => '3201232703210002',
        'nisn' => '3214782841',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'JULIYANA FITRIA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2019-06-14',
        'nama_ibu' => 'SUHERNI',
        'nik' => '3201181406190001',
        'nisn' => '3195857631',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'ARSYLIA MALIKA MISHA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2021-06-29',
        'nama_ibu' => 'ATIN FATIMAH',
        'nik' => '3201236906210001',
        'nisn' => '3212327711',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'EL SHANUM HUMAIRA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-01-14',
        'nama_ibu' => 'ANGGIT SAPUTRI',
        'nik' => '3173045401200001',
        'nisn' => '3206416818',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'NAYLA NURPAHRUL',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2019-09-09',
        'nama_ibu' => 'ΝΙΑ RESNIA',
        'nik' => '3201204909190004',
        'nisn' => '3195231744',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'ZAHRA RABBANI ALESHA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2018-09-27',
        'nama_ibu' => 'INDAH FITRIYANI',
        'nik' => '3173046709180009',
        'nisn' => '3188341283',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMAD ABDUL LATIP',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-10-06',
        'nama_ibu' => 'SITI KOMALA',
        'nik' => '3201200610190003',
        'nisn' => '3198643066',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMAD WILDAN',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-11-10',
        'nama_ibu' => 'LELA',
        'nik' => '3201201011190004',
        'nisn' => '3197227616',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'OKTA AL FAERRY',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-10-04',
        'nama_ibu' => 'ELI NURLAELI',
        'nik' => '3201230410200001',
        'nisn' => '3209299296',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'ARYA SUDRAJAT',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-06-20',
        'nama_ibu' => 'ADE',
        'nik' => '3201202006200001',
        'nisn' => '3207946877',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMAD NIZAM RAFFASYA',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-12-14',
        'nama_ibu' => 'MARLINA',
        'nik' => '3201201412190002',
        'nisn' => '3196884165',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'ALBI AGUSTIAN',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2018-08-17',
        'nama_ibu' => 'KARNI',
        'nik' => '3201181708180002',
        'nisn' => '3185118338',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'AZZAM SYAPUTRA NABIL',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-09-21',
        'nama_ibu' => 'SITI PATIMAH',
        'nik' => '3171072109190005',
        'nisn' => '3192917323',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'DESTI ANDINI PUTRI',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-06-25',
        'nama_ibu' => 'SUMIATI',
        'nik' => '3201236506200001',
        'nisn' => '3202406364',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMAD RADEN SILI',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-09-20',
        'nama_ibu' => 'SITI NURSIAH',
        'nik' => '3201202009190003',
        'nisn' => '3190226723',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'JAKI ALIP MAULANA',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-10-21',
        'nama_ibu' => 'KHAMIDATU L HASANAH',
        'nik' => '3329152110190005',
        'nisn' => '3190896366',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'ESAH',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2018-07-15',
        'nama_ibu' => 'ECIH',
        'nik' => '3201205507180003',
        'nisn' => '3189533743',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMMAD HISYAM A HAFIDZ',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-10-28',
        'nama_ibu' => 'МАМАН MAHPUDO H',
        'nik' => '3601322810190001',
        'nisn' => '3194679952',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMMAD HAZMI ABDILLAH',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2021-09-16',
        'nama_ibu' => 'МАМАН MAHPUDO H',
        'nik' => '3601321509210001',
        'nisn' => '3216489065',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'RIFKI ALL HABSY',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-07-05',
        'nama_ibu' => 'KARTINI',
        'nik' => '3603230507200001',
        'nisn' => '3205870019',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'RAYA HUMAIRAH',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-12-21',
        'nama_ibu' => 'HASANAH',
        'nik' => '3201236112200002',
        'nisn' => '3204805339',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'KHALISA NAILA CHANDANI',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-03-22',
        'nama_ibu' => 'GITA INDAH CAHYANI',
        'nik' => '3201236203200001',
        'nisn' => '3203695311',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'SITI HALIMAH HIJRIAH',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-07-13',
        'nama_ibu' => 'RINDI ΑΝΤΙΚΑ',
        'nik' => '3603235307200004',
        'nisn' => '3202795932',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'SAHLATUR RIZGIANA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2019-09-12',
        'nama_ibu' => 'SRI WANTINI',
        'nik' => '3201185209190001',
        'nisn' => '3193595794',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMMAD ZAIDAN HABIBIE',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-02-14',
        'nama_ibu' => 'ANNIISA',
        'nik' => '3201181402200001',
        'nisn' => '3208208634',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMMAD HAMIZAN RABBANI',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-05-18',
        'nama_ibu' => 'WENNY',
        'nik' => '3201231805200002',
        'nisn' => '3208490579',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'NADA HUMAIRA SAYYIDAH',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-03-25',
        'nama_ibu' => 'MUYANIAPR',
        'nik' => '3201236503200001',
        'nisn' => '3204947435',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'GUNTUR IBNU MALIK',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-06-04',
        'nama_ibu' => 'PITRIYANI',
        'nik' => '3201230406200001',
        'nisn' => '3206613428',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMAD KHAIRUL IHSAN',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-03-09',
        'nama_ibu' => 'SRI WAHYUNI',
        'nik' => '3603230903200002',
        'nisn' => '3202968405',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMAD PATHAR',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-05-29',
        'nama_ibu' => 'ULYANTI',
        'nik' => '3201182905200005',
        'nisn' => '3202800161',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'SITI KAMILAH KHOTIMATUL',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-11-03',
        'nama_ibu' => 'MARSUNA H',
        'nik' => '3201234311200003',
        'nisn' => '3209500138',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'FRISKA ANGGRAENY',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-02-29',
        'nama_ibu' => 'YULI MUSTIKA',
        'nik' => '3201236902200002',
        'nisn' => '3202862481',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'KHANZA AURELIA SYAKILLA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2019-08-05',
        'nama_ibu' => 'FIRDA YUNITA',
        'nik' => '3603234508190001',
        'nisn' => '3197781695',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'SYIFA AULIA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-01-04',
        'nama_ibu' => 'IDA SEPIA',
        'nik' => '3201204401200002',
        'nisn' => '3207329283',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMAD RIJWAN',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-04-18',
        'nama_ibu' => 'IDA',
        'nik' => '3201201804200002',
        'nisn' => '3208924351',
        'kelas' => 'B',
        'telepon' => ''
    ],
    [
        'nama' => 'PUTRI PADILAH',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2021-02-20',
        'nama_ibu' => 'RAMI',
        'nik' => '3201206002210003',
        'nisn' => '3212829393',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'JAYDEN ALEXANDER ZEVANO LUMALESSIL',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2021-02-05',
        'nama_ibu' => 'AGATHA CHRISTINE PUTRIANA LUMALESSI L',
        'nik' => '3275080502210002',
        'nisn' => '3213683298',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'ALFINA ZALFA SABIRA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2021-07-28',
        'nama_ibu' => 'TRI FITRI YANTHI',
        'nik' => '3201236807210003',
        'nisn' => '3206978385',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'NADILA PUTRI SAHER',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-08-18',
        'nama_ibu' => 'HERMIYANT',
        'nik' => '3171075808200002',
        'nisn' => '3206979841',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMAD YASIRAZHA RI',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2021-10-12',
        'nama_ibu' => 'ATIFAH ANWAR',
        'nik' => '3201231210210004',
        'nisn' => '3214133133',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMMAD WAFI NUGRAHA',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-10-15',
        'nama_ibu' => 'WACIH',
        'nik' => '3201181510190002',
        'nisn' => '3196769502',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'CIKACAHAYA PUTRI',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2019-12-11',
        'nama_ibu' => 'CUCU CAHYATI',
        'nik' => '3201235112190003',
        'nisn' => '3195665392',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'IRWAN',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-04-16',
        'nama_ibu' => 'JUMINAH',
        'nik' => '3201231604190003',
        'nisn' => '3196011980',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMMAD IKHSAN L',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2021-07-14',
        'nama_ibu' => 'SULISTIANI',
        'nik' => '327503140',
        'nisn' => '321764975',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'KAMIL FAHRIKA SAMAH NADYA DINI',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '1999-12-31',
        'nama_ibu' => '',
        'nik' => '72100046',
        'nisn' => '',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'FAUZAN ATHARRAYHAN NUDIN',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-11-08',
        'nama_ibu' => 'RIKA',
        'nik' => '3201230811190002',
        'nisn' => '3197504667',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'NABILA PUTRI SAHER',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-08-18',
        'nama_ibu' => 'HERMIYANT',
        'nik' => '3171075808200001',
        'nisn' => '3209597792',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'ZAHRA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2019-05-18',
        'nama_ibu' => 'JUHANAH',
        'nik' => '3201235005190001',
        'nisn' => '3191264403',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'SITI NURMALA MAYA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-02-27',
        'nama_ibu' => '',
        'nik' => '3201182702200001',
        'nisn' => '3202375510',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'AL QALBI SHALIH',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-01-19',
        'nama_ibu' => 'VERAWATI',
        'nik' => '3201181901200001',
        'nisn' => '3204430551',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'THANIA AZZAHRA NUR',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-01-08',
        'nama_ibu' => 'SAYATI',
        'nik' => '3201184801200005',
        'nisn' => '3204987007',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'DEBI YULIANSARI',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-07-10',
        'nama_ibu' => 'YEYEN',
        'nik' => '3201235007200003',
        'nisn' => '3209736633',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'NUR CANDRA ALL FARIZI',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-02-08',
        'nama_ibu' => 'MAELENIΗ',
        'nik' => '3201180802200001',
        'nisn' => '3209562581',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'AIDA UMAIROH',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-12-20',
        'nama_ibu' => 'NENENG',
        'nik' => '3201196012200001',
        'nisn' => '3204168648',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'ANDRI FADILLAH',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-03-03',
        'nama_ibu' => 'ANAH',
        'nik' => '3603230303200006',
        'nisn' => '3200620658',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMAD ARKHAN SYAKIF',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-10-31',
        'nama_ibu' => 'SRI HARTINI',
        'nik' => '3201233110200004',
        'nisn' => '3205602335',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'NAILA PUTRI SAHER',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-08-18',
        'nama_ibu' => 'HERMIYANT',
        'nik' => '3171075808200003',
        'nisn' => '3202966897',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMAD PAHRUL',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2021-04-17',
        'nama_ibu' => 'SAWIYAH',
        'nik' => '3201231704210001',
        'nisn' => '3213006329',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'NURUL HAERUNISA',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-10-11',
        'nama_ibu' => 'SITI',
        'nik' => '3201235110200001',
        'nisn' => '3205085052',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'ARKANA NARENDRA L PUTRA',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-10-14',
        'nama_ibu' => 'HENI WIDIYANTI',
        'nik' => '3201181410190003',
        'nisn' => '3190892204',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'ANDRA FADILLAH',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-03-03',
        'nama_ibu' => 'ANAH',
        'nik' => '3603230303200007',
        'nisn' => '3201985463',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'REZA ALPATIN',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2020-09-17',
        'nama_ibu' => 'IIS',
        'nik' => '3201231709200001',
        'nisn' => '3202850914',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'MUHAMMAD HISYAM L AL HAFIDZ',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2019-10-28',
        'nama_ibu' => 'MAMAH MAHPUDO H',
        'nik' => '3601322810190001',
        'nisn' => '3217467691',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'HILYA NAFISAH',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2021-10-18',
        'nama_ibu' => 'JENAB',
        'nik' => '3201235810210007',
        'nisn' => '3210503752',
        'kelas' => 'A',
        'telepon' => ''
    ],
    [
        'nama' => 'DELILAH RAMADANI',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2020-05-03',
        'nama_ibu' => 'NURSIAH',
        'nik' => '3201184305200001',
        'nisn' => '3200503698',
        'kelas' => 'A',
        'telepon' => ''
    ],
];

foreach($siswa_list as $siswa){
    $nama = $siswa['nama'];
    $jenis_kelamin = $siswa['jenis_kelamin'];
    $ttd = $siswa['tanggal_lahir'];
    $nama_ibu = $siswa['nama_ibu'];
    $nik = $siswa['nik'];
    $nisn = $siswa['nisn'];
    $kelas = $siswa['kelas'];
    $telepon = $siswa['telepon'];
    $username = $nisn;
    $password = $nisn;

    // cek NIK
    $cek_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE NIK='$nik'");
    if(mysqli_num_rows($cek_siswa) > 0) continue; // skip jika sudah ada

    // generate kode siswa
    $q_kode_siswa = mysqli_query($conn, "SELECT MAX(id_siswa) as last_id FROM siswa");
    $row = mysqli_fetch_assoc($q_kode_siswa);
    $last_id = $row['last_id'] ?? 0;
    $next_id = $last_id + 1;
    $kode_siswa = 'SISWA'.str_pad($next_id,3,'0',STR_PAD_LEFT);

    // insert siswa
    $insert = mysqli_query($conn, "INSERT INTO siswa 
        (nama, jenis_kelamin, tanggal_lahir, nama_ibu, NIK, NISN, kelas_rombel, telepon, kode_siswa)
        VALUES
        ('$nama','$jenis_kelamin','$ttd','$nama_ibu','$nik','$nisn','$kelas','$telepon','$kode_siswa')");
    $id_siswa = mysqli_insert_id($conn);

    // generate QR
    $dir = '../assets/img/qrcode_siswa';
    if(!file_exists($dir)) mkdir($dir, 0777, true);
    $file_qr = $dir.'/'.$nama.'.png';
    QRcode::png($kode_siswa,$file_qr,QR_ECLEVEL_L,5);

    $update_qr = mysqli_query($conn, "UPDATE siswa SET qr_path='$file_qr' WHERE kode_siswa='$kode_siswa'");

    // insert user
    $insert_user = mysqli_query($conn, "INSERT INTO users (username, password, level, id_siswa)
        VALUES ('$username','".password_hash($password,PASSWORD_DEFAULT)."','siswa','$id_siswa')");
}

echo "Semua data siswa berhasil diinsert!";
?>
