<?php namespace App\Controllers;

use App\Models\KorelasiCplCpmkModel;
use App\Models\PenyusunModel;
use App\Models\MatakuliahModel;
use App\Models\RencanaPembelajaranModel;
use App\Models\CpmkModel;
use App\Models\SubCpmkModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KorelasiCplCpmk extends BaseController
{
    public function index()
    {
        $model = new KorelasiCplCpmkModel();
        $data['korelasi'] = $model->getWithRelations();

        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();
        $data['penyusun'] = $penyusunModel->findAll();
        $data['matakuliah'] = $matakuliahModel->findAll();
        $rencanaModel = new RencanaPembelajaranModel();
        $data['rencana_pembelajaran'] = $rencanaModel->findAll();

        // load cpmk and sub cpmk maps for display
        $cpmkModel = new CpmkModel();
        $subModel = new SubCpmkModel();
        $cpmkRows = $cpmkModel->findAll();
        $subRows = $subModel->findAll();
        // also pass raw lists for modal selects
        $data['cpmk'] = $cpmkRows;
        $data['sub_cpmk'] = $subRows;
        $data['cpmk_map'] = [];
        foreach ($cpmkRows as $r) { $data['cpmk_map'][$r['id']] = $r['cpmk']; }
        $data['sub_map'] = [];
        foreach ($subRows as $r) { $data['sub_map'][$r['id']] = $r['sub_cpmk']; }

        echo view('korelasi_cpl_cpmk/index', $data);
    }

    public function create()
    {
        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();
        $data['penyusun'] = $penyusunModel->findAll();
        $data['matakuliah'] = $matakuliahModel->findAll();
        $rencanaModel = new RencanaPembelajaranModel();
        $data['rencana_pembelajaran'] = $rencanaModel->findAll();

        $cpmkModel = new CpmkModel();
        $subModel = new SubCpmkModel();
        $data['cpmk'] = $cpmkModel->findAll();
        $data['sub_cpmk'] = $subModel->findAll();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_penyusun' => 'required|integer',
            'id_matakuliah' => 'required|integer',
            'id_cpmk' => 'required|integer',
            'id_sub_cpmk' => 'required|integer',
            'presentase' => 'required|integer',
            'bobot_penilaian' => 'required|integer'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model = new KorelasiCplCpmkModel();
            $model->insert([
                'id_penyusun' => $this->request->getPost('id_penyusun'),
                'id_matakuliah' => $this->request->getPost('id_matakuliah'),
                'id_cpmk' => $this->request->getPost('id_cpmk'),
                'id_sub_cpmk' => $this->request->getPost('id_sub_cpmk'),
                'presentase' => $this->request->getPost('presentase'),
                'bobot_penilaian' => $this->request->getPost('bobot_penilaian')
            ]);

            return redirect()->to('table/korelasi-cpl-cpmk');
        }

        echo view('korelasi_cpl_cpmk/create', $data);
    }

    public function edit($id)
    {
        $model = new KorelasiCplCpmkModel();
        $data['korelasi'] = $model->find($id);

        if (!$data['korelasi']) {
            throw new PageNotFoundException('Data tidak ditemukan');
        }

        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();
        $data['penyusun'] = $penyusunModel->findAll();
        $data['matakuliah'] = $matakuliahModel->findAll();
        $rencanaModel = new RencanaPembelajaranModel();
        $data['rencana_pembelajaran'] = $rencanaModel->findAll();

        $cpmkModel = new CpmkModel();
        $subModel = new SubCpmkModel();
        $data['cpmk'] = $cpmkModel->findAll();
        $data['sub_cpmk'] = $subModel->findAll();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_penyusun' => 'required|integer',
            'id_matakuliah' => 'required|integer',
            'id_cpmk' => 'required|integer',
            'id_sub_cpmk' => 'required|integer',
            'presentase' => 'required|integer',
            'bobot_penilaian' => 'required|integer'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model->update($id, [
                'id_penyusun' => $this->request->getPost('id_penyusun'),
                'id_matakuliah' => $this->request->getPost('id_matakuliah'),
                'id_cpmk' => $this->request->getPost('id_cpmk'),
                'id_sub_cpmk' => $this->request->getPost('id_sub_cpmk'),
                'presentase' => $this->request->getPost('presentase'),
                'bobot_penilaian' => $this->request->getPost('bobot_penilaian')
            ]);

            return redirect()->to('table/korelasi-cpl-cpmk');
        }

        echo view('korelasi_cpl_cpmk/edit', $data);
    }

    public function delete($id)
    {
        $model = new KorelasiCplCpmkModel();
        $model->delete($id);
        return redirect()->to('table/korelasi-cpl-cpmk');
    }

    public function cari()
    {
        $q = $this->request->getGet('search');
        $model = new KorelasiCplCpmkModel();
        $data['korelasi'] = $model->cariData($q);

        $penyusunModel = new PenyusunModel();
        $matakuliahModel = new MatakuliahModel();
        $data['penyusun'] = $penyusunModel->findAll();
        $data['matakuliah'] = $matakuliahModel->findAll();
        $rencanaModel = new RencanaPembelajaranModel();
        $data['rencana_pembelajaran'] = $rencanaModel->findAll();

        // include CPMK lists for modal in search results view
        $cpmkModel = new CpmkModel();
        $subModel = new SubCpmkModel();
        $data['cpmk'] = $cpmkModel->findAll();
        $data['sub_cpmk'] = $subModel->findAll();

        echo view('korelasi_cpl_cpmk/index', $data);
    }
}
