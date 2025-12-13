<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyusunModel extends Model
{
    protected $table      = 'penyusun';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'pengembangan_rps',
        'koordinator_rumpun',
        'ka_prodi'
    ];

    // Use timestamps
    protected $useTimestamps = false;

    // Validation rules
    protected $validationRules = [
        'pengembangan_rps'    => 'required|max_length[255]',
        'koordinator_rumpun'  => 'required|max_length[255]',
        'ka_prodi'            => 'required|max_length[255]',
    ];

    protected $validationMessages = [
        'pengembangan_rps' => [
            'required' => 'Pengembangan RPS harus diisi',
            'max_length' => 'Pengembangan RPS maksimal 255 karakter'
        ],
        'koordinator_rumpun' => [
            'required' => 'Koordinator Rumpun harus diisi',
            'max_length' => 'Koordinator Rumpun maksimal 255 karakter'
        ],
        'ka_prodi' => [
            'required' => 'Kepala Prodi harus diisi',
            'max_length' => 'Kepala Prodi maksimal 255 karakter'
        ]
    ];

    /**
     * Method untuk mencari data penyusun
     * 
     * @param string|null $keyword
     * @return array
     */
    public function cariData($keyword = null)
    {
        $builder = $this->db->table($this->table);

        if (!empty($keyword)) {
            $builder->like('pengembangan_rps', $keyword)
                    ->orLike('koordinator_rumpun', $keyword)
                    ->orLike('ka_prodi', $keyword);
        }

        return $builder->get()->getResultArray();
    }
}
