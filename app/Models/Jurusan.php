<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $fillable = ['kode_jurusan', 'nama_jurusan'];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_jurusan', 'id_jurusan');
    }
}