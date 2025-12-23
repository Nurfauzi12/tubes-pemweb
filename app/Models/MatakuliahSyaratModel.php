<?php

namespace App\Models;

use CodeIgniter\Model;

class MatakuliahSyaratModel extends Model
{
    protected $table      = 'matakuliah_syarat';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_penyusun',
        'id_matakuliah',
        'mk_syarat'
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'id_matakuliah' => 'required|integer',
        'mk_syarat' => 'required|max_length[255]'
    ];

    protected $validationMessages = [
        'id_matakuliah' => [
            'required' => 'Mata kuliah harus dipilih',
            'integer' => 'Nilai tidak valid'
        ],
        'mk_syarat' => [
            'required' => 'Mata kuliah syarat harus diisi',
            'max_length' => 'Mata kuliah syarat maksimal 255 karakter'
        ]
    ];

    public function cariData($keyword = null)
    {
        $builder = $this->db->table($this->table);

        if (!empty($keyword)) {
            $builder->like('mk_syarat', $keyword);
        }

        return $builder->get()->getResultArray();
    }
}
