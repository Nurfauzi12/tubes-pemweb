<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DosenPengampuModel;

class DosenPengampu extends BaseController
{
    protected $dosenPengampuModel;

    public function __construct()
    {
        $this->dosenPengampuModel = new DosenPengampuModel();
    }

    // READ (tampil data)
    public function index()
    {
        $data['dosen_pengampu'] = $this->dosenPengampuModel->findAll();

        return view('dosen_pengampu/index', $data);
    }

    // FORM CREATE
    public function create()
    {
        return view('dosen_pengampu/create');
    }

    // SIMPAN DATA
    public function store()
    {
        $this->dosenPengampuModel->insert([
            'id_penyusun'    => $this->request->getPost('id_penyusun'),
            'id_matakuliah'  => $this->request->getPost('id_matakuliah'),
            'dosen_pengampu' => $this->request->getPost('dosen_pengampu'),
            'semester'       => $this->request->getPost('semester'),
            'tahun_akademik' => $this->request->getPost('tahun_akademik'),
        ]);

        return redirect()->to('/master/dosen-pengampu')
    ->with('success', 'Data berhasil disimpan');

    }

    // FORM EDIT
    public function edit($id)
    {
        $data['dosen_pengampu'] = $this->dosenPengampuModel->find($id);

        if (!$data['dosen_pengampu']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        return view('dosen_pengampu/edit', $data);
    }

    // UPDATE DATA
    public function update($id)
    {
        $this->dosenPengampuModel->update($id, [
            'id_penyusun'    => $this->request->getPost('id_penyusun'),
            'id_matakuliah'  => $this->request->getPost('id_matakuliah'),
            'dosen_pengampu' => $this->request->getPost('dosen_pengampu'),
            'semester'       => $this->request->getPost('semester'),
            'tahun_akademik' => $this->request->getPost('tahun_akademik'),
        ]);

        return redirect()->to('/master/dosen-pengampu')->with('success', 'Data berhasil diupdate');
    }

    // DELETE DATA
    public function delete($id)
    {
        $this->dosenPengampuModel->delete($id);

        return redirect()->to('/master/dosen-pengampu')->with('success', 'Data berhasil dihapus');
    }
}
