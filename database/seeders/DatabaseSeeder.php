<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed Jurusan
        DB::table('jurusan')->insert([
            ['kode_jurusan' => 'RPL', 'nama_jurusan' => 'Rekayasa Perangkat Lunak'],
            ['kode_jurusan' => 'DKV', 'nama_jurusan' => 'Desain Komunikasi Visual'],
            ['kode_jurusan' => 'TKJ', 'nama_jurusan' => 'Teknik Komputer dan Jaringan'],
            ['kode_jurusan' => 'BD', 'nama_jurusan' => 'Bisnis Digital'],
        ]);

        // Seed Kelas
        DB::table('kelas')->insert([
            ['tingkat_kelas' => '10', 'nama_kelas' => 'X'],
            ['tingkat_kelas' => '11', 'nama_kelas' => 'XI'],
            ['tingkat_kelas' => '12', 'nama_kelas' => 'XII'],
        ]);
    }
}
