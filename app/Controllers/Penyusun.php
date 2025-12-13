<?php

namespace App\Controllers;

use App\Models\PenyusunModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Penyusun extends BaseController
{
    /**
     * Display list of penyusun
     * 
     * @return void
     */
    public function index()
    {
        $model = new PenyusunModel();
        $data['penyusun'] = $model->findAll();
        
        return view('penyusun/index', $data);
    }

    /**
     * Show create form and handle form submission
     * 
     * @return mixed
     */
    public function create()
    {
        $model = new PenyusunModel();

        // Check if form is submitted
        if ($this->request->getMethod() === 'post') {
            // Validation rules
            $validation = \Config\Services::validation();
            $validation->setRules([
                'pengembangan_rps' => 'required|max_length[255]',
                'koordinator_rumpun' => 'required|max_length[255]',
                'ka_prodi' => 'required|max_length[255]'
            ]);

            $isDataValid = $validation->withRequest($this->request)->run();

            // If data valid, insert to database
            if ($isDataValid) {
                $model->insert([
                    'pengembangan_rps' => $this->request->getPost('pengembangan_rps'),
                    'koordinator_rumpun' => $this->request->getPost('koordinator_rumpun'),
                    'ka_prodi' => $this->request->getPost('ka_prodi')
                ]);

                session()->setFlashdata('success', 'Data penyusun berhasil ditambahkan');
                return redirect()->to(base_url('master/penyusun'));
            } else {
                $data['validation'] = $validation;
            }
        }

        // Display create form
        return view('penyusun/create', $data ?? []);
    }

    /**
     * Show edit form and handle form submission
     * 
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        $model = new PenyusunModel();
        $data['penyusun'] = $model->find($id);

        if (!$data['penyusun']) {
            throw new PageNotFoundException('Data penyusun tidak ditemukan');
        }

        // Check if form is submitted
        if ($this->request->getMethod() === 'post') {
            // Validation rules
            $validation = \Config\Services::validation();
            $validation->setRules([
                'pengembangan_rps' => 'required|max_length[255]',
                'koordinator_rumpun' => 'required|max_length[255]',
                'ka_prodi' => 'required|max_length[255]'
            ]);

            $isDataValid = $validation->withRequest($this->request)->run();

            // If data valid, update database
            if ($isDataValid) {
                $model->update($id, [
                    'pengembangan_rps' => $this->request->getPost('pengembangan_rps'),
                    'koordinator_rumpun' => $this->request->getPost('koordinator_rumpun'),
                    'ka_prodi' => $this->request->getPost('ka_prodi')
                ]);

                session()->setFlashdata('success', 'Data penyusun berhasil diupdate');
                return redirect()->to(base_url('master/penyusun'));
            } else {
                $data['validation'] = $validation;
            }
        }

        // Display edit form
        return view('penyusun/edit', $data);
    }

    /**
     * Delete penyusun data
     * 
     * @param int $id
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete($id)
    {
        $model = new PenyusunModel();
        
        // Check if data exists
        $penyusun = $model->find($id);
        if (!$penyusun) {
            session()->setFlashdata('error', 'Data penyusun tidak ditemukan');
            return redirect()->to(base_url('master/penyusun'));
        }

        // Delete data
        $model->delete($id);
        
        session()->setFlashdata('success', 'Data penyusun berhasil dihapus');
        return redirect()->to(base_url('master/penyusun'));
    }

    /**
     * Search penyusun data
     * 
     * @return void
     */
    public function cari()
    {
        $keyword = $this->request->getGet('search');
        $model = new PenyusunModel();
        $data['penyusun'] = $model->cariData($keyword);
        
        return view('penyusun/index', $data);
    }
}
