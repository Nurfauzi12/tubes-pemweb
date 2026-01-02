<?php

namespace App\Models;
use CodeIgniter\Model;

class CplModel extends Model
{
    protected $table = 'cpl';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_penyusun',
        'id_matakuliah',
        'cpl_prodi'
    ];

    protected $validationRules = [
        'id_penyusun'   => 'required|integer',
        'id_matakuliah' => 'required|integer',
        'cpl_prodi'     => 'required|min_length[5]'
    ];
}
