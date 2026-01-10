<?php

namespace App\Controllers;

use App\Models\CplModel;
use App\Models\PenyusunModel;
use App\Models\MatakuliahModel;

class CplController extends BaseController
{
    protected $cplModel;
    protected $penyusunModel;
    protected $matakuliahModel;

    public function __construct()
    {
        $this->cplModel = new CplModel();
        $this->penyusunModel = new PenyusunModel();
        $this->matakuliahModel = new MatakuliahModel();
    }

    public function index()
    {
        return view('cpl/index', [
            'cpl' => $this->cplModel->getCplWithRelation()
        ]);
    }

    public function create()
    {
        return view('cpl/create', [
            'penyusun'   => $this->penyusunModel->findAll(),
            'matakuliah'=> $this->matakuliahModel->findAll()
        ]);
    }

    public function store()
    {
        $this->cplModel->insert([
            'id_penyusun'   => $this->request->getPost('id_penyusun'),
            'id_matakuliah'=> $this->request->getPost('id_matakuliah'),
            'cpl_prodi'    => $this->request->getPost('cpl_prodi'),
        ]);

        return redirect()->to('/cpl')->with('success', 'CPL berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('cpl/edit', [
            'cpl'        => $this->cplModel->find($id),
            'penyusun'   => $this->penyusunModel->findAll(),
            'matakuliah'=> $this->matakuliahModel->findAll()
        ]);
    }

    public function update($id)
    {
        $this->cplModel->update($id, [
            'id_penyusun'   => $this->request->getPost('id_penyusun'),
            'id_matakuliah'=> $this->request->getPost('id_matakuliah'),
            'cpl_prodi'    => $this->request->getPost('cpl_prodi'),
        ]);

        return redirect()->to('/cpl')->with('success', 'CPL berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->cplModel->delete($id);
        return redirect()->to('/cpl')->with('success', 'CPL berhasil dihapus');
    }
}
