<?php

namespace App\Controllers;

use App\Models\CpmkModel;
use App\Models\PenyusunModel;
use App\Models\MatakuliahModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class CpmkController extends BaseController
{
    protected $cpmkModel;
    protected $penyusunModel;
    protected $matakuliahModel;

    public function __construct()
    {
        $this->cpmkModel       = new CpmkModel();
        $this->penyusunModel   = new PenyusunModel();
        $this->matakuliahModel = new MatakuliahModel();
    }

    /* ===============================
     * Index
     * =============================== */
    public function index()
    {
        $data['cpmk'] = $this->cpmkModel->findAll();
        $data['penyusun'] = $this->penyusunModel->findAll();
        $data['matakuliah'] = $this->matakuliahModel->findAll();

        return view('cpmk/index', $data);
    }

    /* ===============================
     * Create
     * =============================== */
    public function create()
    {
        if ($this->request->getMethod() === 'post') {

            $rules = [
                'id_penyusun'   => 'required|integer',
                'id_matakuliah' => 'required|integer',
                'cpmk'          => 'required|min_length[5]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $this->cpmkModel->save([
                    'id_penyusun'   => $this->request->getPost('id_penyusun'),
                    'id_matakuliah' => $this->request->getPost('id_matakuliah'),
                    'cpmk'          => $this->request->getPost('cpmk'),
                ]);

                session()->setFlashdata('success', 'Data CPMK berhasil ditambahkan');
                return redirect()->to(base_url('master/cpmk'));
            }
        }

        $data['penyusun']   = $this->penyusunModel->findAll();
        $data['matakuliah'] = $this->matakuliahModel->findAll();

        return view('cpmk/create', $data ?? []);
    }

    /* ===============================
     * Edit
     * =============================== */
    public function edit($id)
    {
        $data['cpmk'] = $this->cpmkModel->find($id);

        if (!$data['cpmk']) {
            throw new PageNotFoundException('Data CPMK tidak ditemukan');
        }

        if ($this->request->getMethod() === 'post') {

            $rules = [
                'id_matakuliah' => 'required|integer',
                'cpmk'          => 'required|min_length[5]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $this->cpmkModel->update($id, [
                    'id_penyusun'   => $this->request->getPost('id_penyusun'),
                    'id_matakuliah' => $this->request->getPost('id_matakuliah'),
                    'cpmk'          => $this->request->getPost('cpmk'),
                ]);

                session()->setFlashdata('success', 'Data CPMK berhasil diperbarui');
                return redirect()->to(base_url('master/cpmk'));
            }
        }

        $data['penyusun_list']   = $this->penyusunModel->findAll();
        $data['matakuliah_list'] = $this->matakuliahModel->findAll();

        return view('cpmk/edit', $data);
    }

    /* ===============================
     * Delete
     * =============================== */
    public function delete($id)
    {
        if (!$this->cpmkModel->find($id)) {
            session()->setFlashdata('error', 'Data CPMK tidak ditemukan');
        } else {
            $this->cpmkModel->delete($id);
            session()->setFlashdata('success', 'Data CPMK berhasil dihapus');
        }

        return redirect()->to(base_url('master/cpmk'));
    }

    /* ===============================
     * Cari
     * =============================== */
    public function cari()
    {
        $keyword = $this->request->getGet('search');

        $data['cpmk'] = $keyword
            ? $this->cpmkModel->like('cpmk', $keyword)->findAll()
            : $this->cpmkModel->findAll();

        $data['penyusun']   = $this->penyusunModel->findAll();
        $data['matakuliah'] = $this->matakuliahModel->findAll();

        return view('cpmk/index', $data);
    }
}
