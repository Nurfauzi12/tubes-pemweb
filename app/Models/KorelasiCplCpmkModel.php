<?php

namespace App\Models;

use CodeIgniter\Model;

class KorelasiCplCpmkModel extends Model
{
    protected $table      = 'korelasi_cpl_cpmk';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_penyusun',
        'id_matakuliah',
        'id_sub_cpmk',
        'id_cpmk',
        'presentase',
        'bobot_penilaian'
    ];
    protected $returnType     = 'array';
    protected $useTimestamps  = false;

    protected $validationRules = [
        'id_penyusun'     => 'required|integer',
        'id_matakuliah'   => 'required|integer',
        'id_cpmk'         => 'required|integer',
        'id_sub_cpmk'     => 'permit_empty|integer',
        'presentase'      => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
        'bobot_penilaian' => 'required|numeric|greater_than_equal_to[0]'
    ];

    /**
     * Search entries by keywords across numeric fields and related text fields.
     * If $q is null returns all rows.
     *
     * @param string|null $q
     * @return array
     */
    public function cariData($q = null): array
    {
        $builder = $this->db->table($this->table . ' k')
            ->select('k.*, p.pengembangan_rps as penyusun_nama, m.matakuliah as matakuliah_nama, c.cpmk as cpmk_nama, s.sub_cpmk as sub_cpmk_nama')
            ->join('penyusun p', 'p.id = k.id_penyusun', 'left')
            ->join('matakuliah m', 'm.id = k.id_matakuliah', 'left')
            ->join('cpmk c', 'c.id = k.id_cpmk', 'left')
            ->join('sub_cpmk s', 's.id = k.id_sub_cpmk', 'left');

        if (!empty($q)) {
            $builder->groupStart()
                ->like('p.pengembangan_rps', $q)
                ->orLike('m.matakuliah', $q)
                ->orLike('c.cpmk', $q)
                ->orLike('s.sub_cpmk', $q)
                ->orLike('k.presentase', $q)
                ->orLike('k.bobot_penilaian', $q)
            ->groupEnd();
        }

        return $builder->orderBy('k.id')->get()->getResultArray();
    }

    /**
     * Get korelasi rows joined with related tables for display.
     *
     * @param int|null $id
     * @return array
     */
    public function getWithRelations(int $id = null): array
    {
        $builder = $this->db->table($this->table . ' k')
            ->select('k.*, p.pengembangan_rps as penyusun_nama, m.matakuliah as matakuliah_nama, c.cpmk as cpmk_nama, s.sub_cpmk as sub_cpmk_nama')
            ->join('penyusun p', 'p.id = k.id_penyusun', 'left')
            ->join('matakuliah m', 'm.id = k.id_matakuliah', 'left')
            ->join('cpmk c', 'c.id = k.id_cpmk', 'left')
            ->join('sub_cpmk s', 's.id = k.id_sub_cpmk', 'left');

        if ($id !== null) {
            $builder->where('k.id', $id);
        }

        return $builder->get()->getResultArray();
    }

    /**
     * Get rows for a specific matakuliah and (optionally) penyusun.
     *
     * @param int $id_matakuliah
     * @param int|null $id_penyusun
     * @return array
     */
    public function getByMatakuliah(int $id_matakuliah, int $id_penyusun = null): array
    {
        $builder = $this->where('id_matakuliah', $id_matakuliah);

        if ($id_penyusun !== null) {
            $builder = $builder->where('id_penyusun', $id_penyusun);
        }

        return $builder->orderBy('id_cpmk')->findAll();
    }

    /**
     * Sum presentase grouped for a matakuliah (optionally filtered by penyusun).
     *
     * @param int $id_matakuliah
     * @param int|null $id_penyusun
     * @return float
     */
    public function sumPresentaseByMatakuliah(int $id_matakuliah, int $id_penyusun = null): float
    {
        $builder = $this->db->table($this->table)->select('SUM(presentase) as total')->where('id_matakuliah', $id_matakuliah);

        if ($id_penyusun !== null) {
            $builder->where('id_penyusun', $id_penyusun);
        }

        $row = $builder->get()->getRowArray();

        return isset($row['total']) ? (float) $row['total'] : 0.0;
    }

    /**
     * Replace korelasi entries for a matakuliah+penyusun with provided batch.
     * Each item in $dataArray must contain keys matching $allowedFields except primary key.
     *
     * @param int $id_penyusun
     * @param int $id_matakuliah
     * @param array $dataArray
     * @return bool
     */
    public function saveBatchForMatakuliah(int $id_penyusun, int $id_matakuliah, array $dataArray): bool
    {
        $this->db->transStart();

        // remove existing
        $this->where('id_penyusun', $id_penyusun)
            ->where('id_matakuliah', $id_matakuliah)
            ->delete();

        if (!empty($dataArray)) {
            $this->insertBatch($dataArray);
        }

        $this->db->transComplete();

        return $this->db->transStatus();
    }
}
