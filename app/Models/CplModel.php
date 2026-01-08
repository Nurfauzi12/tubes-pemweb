<?php

namespace App\Models;

use CodeIgniter\Model;

class CplModel extends Model
{
    protected $table            = 'cpl';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'id_penyusun',
        'id_matakuliah',
        'cpl_prodi'
    ];

    protected $useTimestamps = false;

    public function getCplWithRelation()
    {
        return $this->select('
                cpl.*,
                penyusun.pengembangan_rps,
                matakuliah.matakuliah
            ')
            ->join('penyusun', 'penyusun.id = cpl.id_penyusun')
            ->join('matakuliah', 'matakuliah.id = cpl.id_matakuliah')
            ->orderBy('cpl.id', 'DESC')
            ->findAll();
    }
}
