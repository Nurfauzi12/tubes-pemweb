<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table      = 'mahasiswa';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'nama_mahasiswa',
        'jenis_kelamin',
        'id_prodi',
        'nim',
        'periode_masuk'
    ];

    protected $useTimestamps = false;
}
