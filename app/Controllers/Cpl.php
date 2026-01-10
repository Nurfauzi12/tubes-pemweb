<?php

namespace App\Controllers;

use App\Models\CplModel;
use App\Models\PenyusunModel;
use App\Models\MatakuliahModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Cpl extends BaseController
{
    public function index()
    {
        $model = new CplModel();
        $data['cpl'] = $model->getCplWithDetails();

        // Load dependencies for modal create form
        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();

        $data['penyusunList'] = $penyusunModel->findAll();
        $data['matakuliahList'] = $matakuliahModel->findAll();

        return view('cpl/index', $data);
    }

    public function create()
    {
        $model = new CplModel();

        // Load dependencies for form
        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();

        $data['penyusunList'] = $penyusunModel->findAll();
        $data['matakuliahList'] = $matakuliahModel->findAll();

        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'id_penyusun'   => 'required|integer',
                'id_matakuliah' => 'required|integer',
                'cpl_prodi'     => 'required|max_length[255]',
            ]);

            $isValid = $validation->withRequest($this->request)->run();

            if ($isValid) {
                $model->insert([
                    'id_penyusun'   => $this->request->getPost('id_penyusun'),
                    'id_matakuliah' => $this->request->getPost('id_matakuliah'),
                    'cpl_prodi'     => $this->request->getPost('cpl_prodi'),
                ]);

                session()->setFlashdata('success', 'Data CPL berhasil ditambahkan');
                return redirect()->to(base_url('table/cpl'));
            } else {
                $data['validation'] = $validation;
            }
        }

        return view('cpl/create', $data ?? []);
    }

    public function edit($id)
    {
        $model = new CplModel();
        $data['cpl'] = $model->find($id);

        if (!$data['cpl']) {
            throw new PageNotFoundException('Data CPL tidak ditemukan');
        }

        // Load dependencies for form
        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();

        $data['penyusunList'] = $penyusunModel->findAll();
        $data['matakuliahList'] = $matakuliahModel->findAll();

        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'id_penyusun'   => 'required|integer',
                'id_matakuliah' => 'required|integer',
                'cpl_prodi'     => 'required|max_length[255]',
            ]);

            $isValid = $validation->withRequest($this->request)->run();

            if ($isValid) {
                $model->update($id, [
                    'id_penyusun'   => $this->request->getPost('id_penyusun'),
                    'id_matakuliah' => $this->request->getPost('id_matakuliah'),
                    'cpl_prodi'     => $this->request->getPost('cpl_prodi'),
                ]);

                session()->setFlashdata('success', 'Data CPL berhasil diupdate');
                return redirect()->to(base_url('table/cpl'));
            } else {
                $data['validation'] = $validation;
            }
        }

        return view('cpl/edit', $data);
    }

    public function delete($id)
    {
        $model = new CplModel();
        $record = $model->find($id);

        if (!$record) {
            session()->setFlashdata('error', 'Data CPL tidak ditemukan');
            return redirect()->to(base_url('table/cpl'));
        }

        $model->delete($id);
        session()->setFlashdata('success', 'Data CPL berhasil dihapus');
        return redirect()->to(base_url('table/cpl'));
    }

    public function cari()
    {
        $keyword = $this->request->getGet('search');
        $model = new CplModel();
        $data['cpl'] = $model->cariData($keyword);

        // Load dependencies for modal
        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();

        $data['penyusunList'] = $penyusunModel->findAll();
        $data['matakuliahList'] = $matakuliahModel->findAll();

        return view('cpl/index', $data);
    }
}
