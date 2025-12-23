<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SubCpmkModel;
use App\Models\MatakuliahModel;
use App\Models\PenyusunModel;

class SubCpmk extends BaseController
{
    protected $subModel;
    protected $mkModel;
    protected $penyusunModel;

    public function __construct()
    {
        $this->subModel       = new SubCpmkModel();
        $this->mkModel        = new MatakuliahModel();
        $this->penyusunModel  = new PenyusunModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Data Sub-CPMK',
            'subcpmk'  => $this->subModel->getWithRelations()
        ];

        return view('table/sub-cpmk/index', $data);
    }

    public function create()
    {
        $data = [
            'title'       => 'Tambah Sub-CPMK',
            'matakuliah'  => $this->mkModel->findAll(),
            'penyusun'    => $this->penyusunModel->findAll(),
        ];

        return view('table/sub-cpmk/create', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();

        if (!$this->subModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->subModel->errors());
        }

        return redirect()->to('/table/sub-cpmk')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = [
            'title'       => 'Edit Sub-CPMK',
            'item'        => $this->subModel->find($id),
            'matakuliah'  => $this->mkModel->findAll(),
            'penyusun'    => $this->penyusunModel->findAll(),
        ];

        return view('table/sub-cpmk/edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $data['id'] = $id;

        if (!$this->subModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->subModel->errors());
        }

        return redirect()->to('/table/sub-cpmk')->with('success', 'Data berhasil diperbarui!');
    }

    public function delete($id)
    {
        $this->subModel->delete($id);

        return redirect()->to('/table/sub-cpmk')->with('success', 'Data berhasil dihapus!');
    }
}
