<?php namespace App\Controllers;

use App\Models\RencanaPembelajaranModel;
use App\Models\PenyusunModel;
use App\Models\MatakuliahModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class RencanaPembelajaran extends BaseController
{
    public function index()
    {
        $model = new RencanaPembelajaranModel();
        $data['rencana_pembelajaran'] = $model->findAll();
        // $data['penyusun'] = $this->db->table('penyusun')->findAll();
        // $data['matakuliah'] = $this->db->table('matakuliah')->findAll();
        echo view('rencana_pembelajaran/index', $data);
    }

    public function create()
    {
        // Load data untuk dropdown
        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();
        $data['penyusun'] = $penyusunModel->findAll();
        $data['matakuliah'] = $matakuliahModel->findAll();

        // Validasi data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_penyusun' => 'required|integer',
            'id_matakuliah' => 'required|integer',
            'minggu_ke' => 'required',
            'sub_cpmk' => 'required',
            'penilaian_indikator' => 'required',
            'penilaian_teknik' => 'required',
            'bentuk_pembelajaran' => 'required',
            'materi' => 'required',
            'bobot_penilaian' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();

        // Jika data valid, simpan ke database
        if ($isDataValid) {
            $model = new RencanaPembelajaranModel();
            $model->insert([
                'id_penyusun' => $this->request->getPost('id_penyusun'),
                'id_matakuliah' => $this->request->getPost('id_matakuliah'),
                'minggu_ke' => $this->request->getPost('minggu_ke'),
                'sub_cpmk' => $this->request->getPost('sub_cpmk'),
                'penilaian_indikator' => $this->request->getPost('penilaian_indikator'),
                'penilaian_teknik' => $this->request->getPost('penilaian_teknik'),
                'bentuk_pembelajaran' => $this->request->getPost('bentuk_pembelajaran'),
                'materi' => $this->request->getPost('materi'),
                'bobot_penilaian' => $this->request->getPost('bobot_penilaian'),
                'catatan' => $this->request->getPost('catatan')
            ]);
            return redirect()->to('table/rencana-pembelajaran');
        }

        // Tampilkan form create
        echo view('rencana_pembelajaran/create', $data);
    }

    public function edit($id)
    {
        $model = new RencanaPembelajaranModel();
        $data['rencana'] = $model->find($id);

        if (!$data['rencana']) {
            throw new PageNotFoundException('Data tidak ditemukan');
        }

        // Load data untuk dropdown
        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();
        $data['penyusun'] = $penyusunModel->findAll();
        $data['matakuliah'] = $matakuliahModel->findAll();

        // Validasi data yang diubah
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_penyusun' => 'required|integer',
            'id_matakuliah' => 'required|integer',
            'minggu_ke' => 'required',
            'sub_cpmk' => 'required',
            'penilaian_indikator' => 'required',
            'penilaian_teknik' => 'required',
            'bentuk_pembelajaran' => 'required',
            'materi' => 'required',
            'bobot_penilaian' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model->update($id, [
                'id_penyusun' => $this->request->getPost('id_penyusun'),
                'id_matakuliah' => $this->request->getPost('id_matakuliah'),
                'minggu_ke' => $this->request->getPost('minggu_ke'),
                'sub_cpmk' => $this->request->getPost('sub_cpmk'),
                'penilaian_indikator' => $this->request->getPost('penilaian_indikator'),
                'penilaian_teknik' => $this->request->getPost('penilaian_teknik'),
                'bentuk_pembelajaran' => $this->request->getPost('bentuk_pembelajaran'),
                'materi' => $this->request->getPost('materi'),
                'bobot_penilaian' => $this->request->getPost('bobot_penilaian'),
                'catatan' => $this->request->getPost('catatan')
            ]);
            return redirect()->to('table/rencana-pembelajaran');
        }

        // Tampilkan form edit
        echo view('rencana_pembelajaran/edit', $data);
    }

    public function delete($id)
    {
        $model = new RencanaPembelajaranModel();
        $model->delete($id);
        return redirect()->to('table/rencana-pembelajaran');
    }

    public function cari()
    {
        $cari = $this->request->getGet('search');
        $model = new RencanaPembelajaranModel();
        $data['rencana_pembelajaran'] = $model->cariData($cari);
        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();
        $data['penyusun'] = $penyusunModel->findAll();
        $data['matakuliah'] = $matakuliahModel->findAll();
        echo view('rencana_pembelajaran/index', $data);
    }
}
