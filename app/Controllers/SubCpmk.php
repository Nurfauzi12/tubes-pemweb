<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SubCpmkModel;
use App\Models\PenyusunModel;
use App\Models\MatakuliahModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class SubCpmk extends BaseController
{
    // =====================================================
    // INDEX
    // =====================================================
    public function index()
    {
        $model = new SubCpmkModel();
        $data['subcpmk'] = $model->getWithRelations();

        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();

        $data['penyusun']   = $penyusunModel->findAll();
        $data['matakuliah'] = $matakuliahModel->findAll();

        echo view('sub_cpmk/index', $data);
    }

    // =====================================================
    // CREATE
    // =====================================================
    public function create()
    {
        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();

        $data['penyusun']   = $penyusunModel->findAll();
        $data['matakuliah'] = $matakuliahModel->findAll();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_penyusun'   => 'required|integer',
            'id_matakuliah' => 'required|integer',
            'sub_cpmk'      => 'required'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model = new SubCpmkModel();
            $model->insert([
                'id_penyusun'   => $this->request->getPost('id_penyusun'),
                'id_matakuliah' => $this->request->getPost('id_matakuliah'),
                'sub_cpmk'      => $this->request->getPost('sub_cpmk'),
            ]);

            return redirect()->to('subcpmk');
        }

        echo view('sub_cpmk/create', $data);
    }

    // =====================================================
    // EDIT
    // =====================================================
    public function edit($id)
    {
        $model = new SubCpmkModel();
        $data['subcpmk'] = $model->find($id);

        if (!$data['subcpmk']) {
            throw new PageNotFoundException('Data Sub CPMK tidak ditemukan');
        }

        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();

        $data['penyusun']   = $penyusunModel->findAll();
        $data['matakuliah'] = $matakuliahModel->findAll();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_penyusun'   => 'required|integer',
            'id_matakuliah' => 'required|integer',
            'sub_cpmk'      => 'required'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model->update($id, [
                'id_penyusun'   => $this->request->getPost('id_penyusun'),
                'id_matakuliah' => $this->request->getPost('id_matakuliah'),
                'sub_cpmk'      => $this->request->getPost('sub_cpmk'),
            ]);

            return redirect()->to('subcpmk');
        }

        echo view('sub_cpmk/edit', $data);
    }

    // =====================================================
    // DELETE
    // =====================================================
    public function delete($id)
    {
        $model = new SubCpmkModel();
        $model->delete($id);

        return redirect()->to('subcpmk');
    }

    // =====================================================
    // SEARCH
    // =====================================================
    public function cari()
    {
        $q = $this->request->getGet('search');

        $model = new SubCpmkModel();
        $data['subcpmk'] = $model->cariData($q);

        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();

        $data['penyusun']   = $penyusunModel->findAll();
        $data['matakuliah'] = $matakuliahModel->findAll();

        echo view('sub_cpmk/index', $data);
    }
}
