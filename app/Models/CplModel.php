<?php

namespace App\Models;

use CodeIgniter\Model;

class CplModel extends Model
{
    protected $table      = 'cpl';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_penyusun',
        'id_matakuliah',
        'cpl_prodi'
    ];

    protected $useTimestamps = false;

    // Validation rules
    protected $validationRules = [
        'id_penyusun'   => 'required|integer',
        'id_matakuliah' => 'required|integer',
        'cpl_prodi'     => 'required|max_length[255]',
    ];

    protected $validationMessages = [
        'id_penyusun' => [
            'required' => 'Penyusun harus dipilih',
            'integer'  => 'Penyusun tidak valid',
        ],
        'id_matakuliah' => [
            'required' => 'Mata kuliah harus dipilih',
            'integer'  => 'Mata kuliah tidak valid',
        ],
        'cpl_prodi' => [
            'required'   => 'CPL Prodi harus diisi',
            'max_length' => 'CPL Prodi maksimal 255 karakter',
        ],
    ];

    /**
     * Get all CPL with penyusun and matakuliah names
     */
    public function getCplWithDetails()
    {
        return $this->db->table($this->table)
            ->select('cpl.*, penyusun.pengembangan_rps, matakuliah.matakuliah as nama_matakuliah, matakuliah.kode as kode_matakuliah')
            ->join('penyusun', 'penyusun.id = cpl.id_penyusun', 'left')
            ->join('matakuliah', 'matakuliah.id = cpl.id_matakuliah', 'left')
            ->get()
            ->getResultArray();
    }

    /**
     * Search CPL with details
     */
    public function cariData($cariData = null)
    {
        $builder = $this->db->table($this->table)
            ->select('cpl.*, penyusun.pengembangan_rps, matakuliah.matakuliah as nama_matakuliah, matakuliah.kode as kode_matakuliah')
            ->join('penyusun', 'penyusun.id = cpl.id_penyusun', 'left')
            ->join('matakuliah', 'matakuliah.id = cpl.id_matakuliah', 'left');

        if (!empty($cariData)) {
            $builder->groupStart()
                    ->like('cpl.cpl_prodi', $cariData)
                    ->orLike('penyusun.pengembangan_rps', $cariData)
                    ->orLike('matakuliah.matakuliah', $cariData)
                    ->orLike('matakuliah.kode', $cariData)
                    ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }
}
