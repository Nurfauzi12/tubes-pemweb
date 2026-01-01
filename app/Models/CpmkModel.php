<?php

namespace App\Models;

use CodeIgniter\Model;

class CpmkModel extends Model
{
    protected $table = 'cpmk';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_penyusun',
        'id_matakuliah',
        'cpmk'
    ];

    public function getWithRelations()
    {
        return $this->db->table($this->table)
            ->select('
                cpmk.*,
                penyusun.nama_penyusun,
                matakuliah.nama_matakuliah
            ')
            ->join('penyusun', 'penyusun.id = cpmk.id_penyusun')
            ->join('matakuliah', 'matakuliah.id = cpmk.id_matakuliah')
            ->get()
            ->getResultArray();
    }

    public function cariData($q)
    {
        return $this->like('cpmk', $q)->findAll();
    }
}
