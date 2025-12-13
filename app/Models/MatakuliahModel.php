<?php

namespace App\Models;

use CodeIgniter\Model;

class MatakuliahModel extends Model
{
    protected $table      = 'matakuliah';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'matakuliah',
        'kode',
        'rumpun',
        'bobot_teori',
        'bobot_praktek',
        'semester',
        'tanggal'
    ];

    protected $useTimestamps = false;
}
