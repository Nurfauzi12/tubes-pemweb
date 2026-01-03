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

    public function getJoinedData($keyword = null)
{
    $builder = $this->select('cpmk.*, matakuliah.matakuliah as nama_matkul, matakuliah.kode as kode_matkul, penyusun.pengembangan_rps as nama_penyusun')
        ->join('matakuliah', 'matakuliah.id = cpmk.id_matakuliah', 'left')
        ->join('penyusun', 'penyusun.id = cpmk.id_penyusun', 'left');

    if ($keyword) {
        $builder->like('cpmk.cpmk', $keyword);
    }

    return $builder->findAll();
}
}
