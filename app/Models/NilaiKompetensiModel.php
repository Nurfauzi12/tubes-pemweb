<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiKompetensiModel extends Model
{
    protected $table      = 'nilai_kompetensi';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'nim',
        'id_rencana_pembelajaran',
        'nilai_kompetensi',
        'status',
        'keterangan'
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nim' => 'required|max_length[20]',
        'id_rencana_pembelajaran' => 'required|integer',
        'nilai_kompetensi' => 'required|integer|is_natural_no_zero',
        'status' => 'required|max_length[50]',
        'keterangan' => 'permit_empty|max_length[255]'
    ];

    protected $validationMessages = [
        'nim' => [
            'required' => 'NIM harus diisi',
            'max_length' => 'NIM maksimal 20 karakter'
        ],
        'id_rencana_pembelajaran' => [
            'required' => 'Rencana pembelajaran harus dipilih',
            'integer' => 'Rencana pembelajaran tidak valid'
        ],
        'nilai_kompetensi' => [
            'required' => 'Nilai kompetensi harus diisi',
            'integer' => 'Nilai kompetensi harus berupa angka'
        ],
        'status' => [
            'required' => 'Status harus diisi',
            'max_length' => 'Status maksimal 50 karakter'
        ]
    ];

    /**
     * Ambil data nilai_kompetensi beserta data mahasiswa dan rencana pembelajaran
     *
     * @return array
     */
    public function getAllWithRelations()
    {
        $builder = $this->db->table('nilai_kompetensi nk');
        $builder->select('nk.*, m.nama_mahasiswa, rp.minggu_ke');
        $builder->join('mahasiswa m', 'nk.nim = m.nim', 'left');
        $builder->join('rencana_pembelajaran rp', 'nk.id_rencana_pembelajaran = rp.id', 'left');
        return $builder->get()->getResultArray();
    }

    public function cariData($keyword = null)
    {
        $builder = $this->db->table('nilai_kompetensi nk');
        $builder->select('nk.*, m.nama_mahasiswa, rp.minggu_ke');
        $builder->join('mahasiswa m', 'nk.nim = m.nim', 'left');
        $builder->join('rencana_pembelajaran rp', 'nk.id_rencana_pembelajaran = rp.id', 'left');

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('nk.nim', $keyword)
                ->orLike('m.nama_mahasiswa', $keyword)
                ->orLike('rp.minggu_ke', $keyword)
                ->orLike('nk.status', $keyword)
            ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }
}

