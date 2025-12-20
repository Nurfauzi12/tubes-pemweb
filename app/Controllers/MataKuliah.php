<?php

namespace App\Controllers;

use App\Models\MatakuliahModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Matakuliah extends BaseController
{
    public function index()
    {
        $model = new MatakuliahModel();
        $data['matakuliah'] = $model->findAll();

        return view('matakuliah/index', $data);
    }

    public function create()
    {
        $model = new MatakuliahModel();

        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'matakuliah'    => 'required',
                'kode'          => 'required',
                'rumpun'        => 'required',
                'bobot_teori'   => 'required|integer',
                'bobot_praktek' => 'required|integer',
                'semester'      => 'required|integer',
                'tanggal'       => 'required|valid_date'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                $model->insert([
                    'matakuliah'    => $this->request->getPost('matakuliah'),
                    'kode'          => $this->request->getPost('kode'),
                    'rumpun'        => $this->request->getPost('rumpun'),
                    'bobot_teori'   => $this->request->getPost('bobot_teori'),
                    'bobot_praktek' => $this->request->getPost('bobot_praktek'),
                    'semester'      => $this->request->getPost('semester'),
                    'tanggal'       => $this->request->getPost('tanggal')
                ]);

                session()->setFlashdata('success', 'Data matakuliah berhasil ditambahkan');
                return redirect()->to(base_url('master/matakuliah'));
            } else {
                $data['validation'] = $validation;
            }
        }

        return view('matakuliah/create', $data ?? []);
    }

    public function edit($id)
    {
        $model = new MatakuliahModel();
        $data['matakuliah'] = $model->find($id);

        if (!$data['matakuliah']) {
            throw new PageNotFoundException('Data matakuliah tidak ditemukan');
        }

        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'matakuliah'    => 'required',
                'kode'          => 'required',
                'rumpun'        => 'required',
                'bobot_teori'   => 'required|integer',
                'bobot_praktek' => 'required|integer',
                'semester'      => 'required|integer',
                'tanggal'       => 'required|valid_date'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                $model->update($id, [
                    'matakuliah'    => $this->request->getPost('matakuliah'),
                    'kode'          => $this->request->getPost('kode'),
                    'rumpun'        => $this->request->getPost('rumpun'),
                    'bobot_teori'   => $this->request->getPost('bobot_teori'),
                    'bobot_praktek' => $this->request->getPost('bobot_praktek'),
                    'semester'      => $this->request->getPost('semester'),
                    'tanggal'       => $this->request->getPost('tanggal')
                ]);

                session()->setFlashdata('success', 'Data matakuliah berhasil diupdate');
                return redirect()->to(base_url('master/matakuliah'));
            } else {
                $data['validation'] = $validation;
            }
        }

        return view('matakuliah/edit', $data);
    }

    public function delete($id)
    {
        $model = new MatakuliahModel();
        $model->delete($id);

        session()->setFlashdata('success', 'Data matakuliah berhasil dihapus');
        return redirect()->to(base_url('master/matakuliah'));
    }
}
