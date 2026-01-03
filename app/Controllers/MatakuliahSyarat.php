<?php

namespace App\Controllers;

use App\Models\MatakuliahSyaratModel;
use App\Models\PenyusunModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class MatakuliahSyarat extends BaseController
{
    public function index()
    {
        $model = new MatakuliahSyaratModel();
        $data['matakuliah_syarat'] = $model->findAll();

        // load related master data for display
        $penyusunModel = new PenyusunModel();
        $penyusunList = $penyusunModel->findAll();
        $data['penyusun_map'] = [];
        foreach ($penyusunList as $p) {
            $data['penyusun_map'][$p['id']] = $p;
        }

        $matakuliahList = $this->db->table('matakuliah')->get()->getResultArray();
        $data['matakuliah_map'] = [];
        foreach ($matakuliahList as $m) {
            $data['matakuliah_map'][$m['id']] = $m;
        }

        return view('matakuliah_syarat/index', $data);
    }

    public function create()
    {
        $model = new MatakuliahSyaratModel();

        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules($model->validationRules, $model->validationMessages ?? []);

            $isDataValid = $validation->withRequest($this->request)->run();

            if ($isDataValid) {
                $model->insert([
                    'id_penyusun' => $this->request->getPost('id_penyusun') ?: null,
                    'id_matakuliah' => $this->request->getPost('id_matakuliah'),
                    'mk_syarat' => $this->request->getPost('mk_syarat')
                ]);

                session()->setFlashdata('success', 'Data mata kuliah syarat berhasil ditambahkan');
                return redirect()->to(base_url('table/matakuliah-syarat'));
            } else {
                $data['validation'] = $validation;
            }
        }

        // load penyusun and matakuliah lists
        $penyusunModel = new PenyusunModel();
        $data['penyusun_list'] = $penyusunModel->findAll();
        $data['matakuliah_list'] = $this->db->table('matakuliah')->get()->getResultArray();

        return view('matakuliah_syarat/create', $data ?? []);
    }

    public function edit($id)
    {
        $model = new MatakuliahSyaratModel();
        $data['item'] = $model->find($id);

        if (!$data['item']) {
            throw new PageNotFoundException('Data matakuliah syarat tidak ditemukan');
        }

        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules($model->validationRules, $model->validationMessages ?? []);

            $isDataValid = $validation->withRequest($this->request)->run();

            if ($isDataValid) {
                $model->update($id, [
                    'id_penyusun' => $this->request->getPost('id_penyusun') ?: null,
                    'id_matakuliah' => $this->request->getPost('id_matakuliah'),
                    'mk_syarat' => $this->request->getPost('mk_syarat')
                ]);

                session()->setFlashdata('success', 'Data mata kuliah syarat berhasil diupdate');
                return redirect()->to(base_url('table/matakuliah-syarat'));
            } else {
                $data['validation'] = $validation;
            }
        }

        $penyusunModel = new PenyusunModel();
        $data['penyusun_list'] = $penyusunModel->findAll();
        $data['matakuliah_list'] = $this->db->table('matakuliah')->get()->getResultArray();

        return view('matakuliah_syarat/edit', $data);
    }

    public function delete($id)
    {
        $model = new MatakuliahSyaratModel();
        $item = $model->find($id);

        if (!$item) {
            session()->setFlashdata('error', 'Data matakuliah syarat tidak ditemukan');
            return redirect()->to(base_url('table/matakuliah-syarat'));
        }

        $model->delete($id);
        session()->setFlashdata('success', 'Data matakuliah syarat berhasil dihapus');
        return redirect()->to(base_url('table/matakuliah-syarat'));
    }

    public function cari()
    {
        $keyword = $this->request->getGet('search');
        $model = new MatakuliahSyaratModel();
        $data['matakuliah_syarat'] = $model->cariData($keyword);

        return view('matakuliah_syarat/index', $data);
    }
}
