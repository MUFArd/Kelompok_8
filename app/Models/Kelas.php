<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = ['tingkat_kelas', 'nama_kelas'];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_kelas', 'id_kelas');
    }
}