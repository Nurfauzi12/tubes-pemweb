<?php

namespace App\Models;

use CodeIgniter\Model;

class SubCpmkModel extends Model
{
    protected $table      = 'sub_cpmk';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_penyusun',
        'id_matakuliah',
        'sub_cpmk'
    ];

    protected $returnType = 'array';
    protected $useTimestamps = false;

    // Validation rules
    protected $validationRules = [
        'id_penyusun'   => 'required|integer',
        'id_matakuliah' => 'required|integer',
        'sub_cpmk'      => 'required|string',
    ];

    /**
     * Cari data sub_cpmk berdasarkan keyword
     */
    public function cariData($q = null): array
    {
        $builder = $this->db->table($this->table . ' s')
            ->select('s.*, p.pengembangan_rps as penyusun_nama, m.matakuliah as matakuliah_nama')
            ->join('penyusun p', 'p.id = s.id_penyusun', 'left')
            ->join('matakuliah m', 'm.id = s.id_matakuliah', 'left');

        if (!empty($q)) {
            $builder->groupStart()
                ->like('p.pengembangan_rps', $q)
                ->orLike('m.matakuliah', $q)
                ->orLike('s.sub_cpmk', $q)
            ->groupEnd();
        }

        return $builder->orderBy('s.id')->get()->getResultArray();
    }

    /**
     * Ambil data dengan relasi penyusun & matakuliah
     */
    public function getWithRelations(int $id = null): array
    {
        $builder = $this->db->table($this->table . ' s')
            ->select('s.*, p.pengembangan_rps as penyusun_nama, m.matakuliah as matakuliah_nama')
            ->join('penyusun p', 'p.id = s.id_penyusun', 'left')
            ->join('matakuliah m', 'm.id = s.id_matakuliah', 'left');

        if ($id !== null) {
            $builder->where('s.id', $id);
        }

        return $builder->get()->getResultArray();
    }

    /**
     * Ambil data berdasarkan matakuliah & (opsional) penyusun
     */
    public function getByMatakuliah(int $id_matakuliah, int $id_penyusun = null): array
    {
        $builder = $this->where('id_matakuliah', $id_matakuliah);

        if ($id_penyusun !== null) {
            $builder = $builder->where('id_penyusun', $id_penyusun);
        }

        return $builder->orderBy('id')->findAll();
    }

    /**
     * Replace semua sub_cpmk untuk matakuliah + penyusun
     */
    public function saveBatchForMatakuliah(int $id_penyusun, int $id_matakuliah, array $dataArray): bool
    {
        $this->db->transStart();

        // delete existing rows
        $this->where('id_penyusun', $id_penyusun)
            ->where('id_matakuliah', $id_matakuliah)
            ->delete();

        // insert batch
        if (!empty($dataArray)) {
            $this->insertBatch($dataArray);
        }

        $this->db->transComplete();

        return $this->db->transStatus();
    }
}
