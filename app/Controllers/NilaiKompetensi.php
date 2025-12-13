<?php

namespace App\Controllers;

use App\Models\NilaiKompetensiModel;
use App\Models\MahasiswaModel;
use App\Models\RencanaPembelajaranModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class NilaiKompetensi extends BaseController
{
    public function index()
    {
        $model = new NilaiKompetensiModel();
        $data['nilai'] = $model->getAllWithRelations();
        $mahasiswaModel = new MahasiswaModel();
        $rencanaModel = new RencanaPembelajaranModel();
        $data['mahasiswa'] = $mahasiswaModel->findAll();
        $data['rencana'] = $rencanaModel->findAll();
        echo view('nilai_kompetensi/index', $data);
    }

    public function create()
    {
        // load dropdown data
        $mahasiswaModel = new MahasiswaModel();
        $rencanaModel = new RencanaPembelajaranModel();
        $data['mahasiswa'] = $mahasiswaModel->findAll();
        $data['rencana'] = $rencanaModel->findAll();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nim' => 'required|max_length[20]',
            'id_rencana_pembelajaran' => 'required|integer',
            'nilai_kompetensi' => 'required|integer|is_natural_no_zero',
            'status' => 'required|max_length[50]',
            'keterangan' => 'permit_empty|max_length[255]'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model = new NilaiKompetensiModel();
            $model->insert([
                'nim' => $this->request->getPost('nim'),
                'id_rencana_pembelajaran' => $this->request->getPost('id_rencana_pembelajaran'),
                'nilai_kompetensi' => $this->request->getPost('nilai_kompetensi'),
                'status' => $this->request->getPost('status'),
                'keterangan' => $this->request->getPost('keterangan')
            ]);

            session()->setFlashdata('success', 'Data nilai kompetensi berhasil ditambahkan');
            return redirect()->to('table/nilai-kompetensi');
        }

        if ($this->request->getMethod() === 'post') {
            $data['validation'] = $validation;
        }

        echo view('nilai_kompetensi/create', $data);
    }

    public function edit($id)
    {
        $model = new NilaiKompetensiModel();
        $data['nilai'] = $model->find($id);

        if (!$data['nilai']) {
            throw new PageNotFoundException('Data tidak ditemukan');
        }

        $mahasiswaModel = new MahasiswaModel();
        $rencanaModel = new RencanaPembelajaranModel();
        $data['mahasiswa'] = $mahasiswaModel->findAll();
        $data['rencana'] = $rencanaModel->findAll();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nim' => 'required|max_length[20]',
            'id_rencana_pembelajaran' => 'required|integer',
            'nilai_kompetensi' => 'required|integer|is_natural_no_zero',
            'status' => 'required|max_length[50]',
            'keterangan' => 'permit_empty|max_length[255]'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model->update($id, [
                'nim' => $this->request->getPost('nim'),
                'id_rencana_pembelajaran' => $this->request->getPost('id_rencana_pembelajaran'),
                'nilai_kompetensi' => $this->request->getPost('nilai_kompetensi'),
                'status' => $this->request->getPost('status'),
                'keterangan' => $this->request->getPost('keterangan')
            ]);

            session()->setFlashdata('success', 'Data nilai kompetensi berhasil diupdate');
            return redirect()->to('table/nilai-kompetensi');
        }

        if ($this->request->getMethod() === 'post') {
            $data['validation'] = $validation;
        }

        echo view('nilai_kompetensi/edit', $data);
    }

    public function delete($id)
    {
        $model = new NilaiKompetensiModel();
        $nilai = $model->find($id);
        if (!$nilai) {
            session()->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to('table/nilai-kompetensi');
        }

        $model->delete($id);
        session()->setFlashdata('success', 'Data nilai kompetensi berhasil dihapus');
        return redirect()->to('table/nilai-kompetensi');
    }

    public function cari()
    {
        $keyword = $this->request->getGet('search');
        $model = new NilaiKompetensiModel();
        $data['nilai'] = $model->cariData($keyword);
        $mahasiswaModel = new MahasiswaModel();
        $rencanaModel = new RencanaPembelajaranModel();
        $data['mahasiswa'] = $mahasiswaModel->findAll();
        $data['rencana'] = $rencanaModel->findAll();
        echo view('nilai_kompetensi/index', $data);
    }
}
