<?php

namespace App\Models;

use CodeIgniter\Model;

class RencanaPembelajaranModel extends Model
{
    protected $table      = 'rencana_pembelajaran';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_penyusun',
        'id_matakuliah',
        'minggu_ke',
        'sub_cpmk',
        'penilaian_indikator',
        'penilaian_teknik',
        'bentuk_pembelajaran',
        'materi',
        'bobot_penilaian',
        'catatan'
    ];

    public function cariData($cariData = null)
    {
        $builder = $this->db->table($this->table);

        if (!empty($cariData)) {
            $builder->like('minggu_ke', $cariData)
                    ->orLike('sub_cpmk', $cariData)
                    ->orLike('materi', $cariData);
        }

        return $builder->get()->getResultArray();
    }
}