<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SubCpmkModel;
use App\Models\PenyusunModel;
use App\Models\MatakuliahModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class SubCpmk extends BaseController
{
    protected $subcpmkModel;
    protected $penyusunModel;
    protected $matakuliahModel;

    // Inisialisasi model
    public function __construct()
    {
        $this->subcpmkModel = new SubCpmkModel();
        $this->penyusunModel = new PenyusunModel();
        $this->matakuliahModel = new MatakuliahModel();
    }

    // =====================================================
    // INDEX
    // =====================================================
    public function index()
    {
        $data['subcpmk'] = $this->subcpmkModel->getWithRelations();
        $data['penyusun']   = $this->penyusunModel->findAll();
        $data['matakuliah'] = $this->matakuliahModel->findAll();

        echo view('sub_cpmk/index', $data);
    }

    // =====================================================
    // CREATE
    // =====================================================
    public function create()
    {
        $data['penyusun']   = $this->penyusunModel->findAll();
        $data['matakuliah'] = $this->matakuliahModel->findAll();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_penyusun'   => 'required|integer',
            'id_matakuliah' => 'required|integer',
            'sub_cpmk'      => 'required'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $this->subcpmkModel->insert([
                'id_penyusun'   => $this->request->getPost('id_penyusun'),
                'id_matakuliah' => $this->request->getPost('id_matakuliah'),
                'sub_cpmk'      => $this->request->getPost('sub_cpmk'),
            ]);

            return redirect()->to('table/sub_cpmk')->with('success', 'Sub CPMK berhasil ditambahkan');
        }

        echo view('sub_cpmk/create', $data);
    }

    // =====================================================
    // UPDATE (EDIT)
    // =====================================================
    public function update()
    {
        // Ambil data dari form
        $id = $this->request->getPost('id');
        $id_penyusun = $this->request->getPost('id_penyusun');
        $id_matakuliah = $this->request->getPost('id_matakuliah');
        $sub_cpmk = $this->request->getPost('sub_cpmk');

        // Validasi data (optional)
        if (!$this->validate([
            'id_penyusun' => 'required',
            'id_matakuliah' => 'required',
            'sub_cpmk' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update data
        $this->subcpmkModel->update($id, [
            'id_penyusun' => $id_penyusun,
            'id_matakuliah' => $id_matakuliah,
            'sub_cpmk' => $sub_cpmk
        ]);

        // Redirect atau respon sukses
        return redirect()->to(base_url('table/subcpmk'))->with('success', 'Data berhasil diupdate!');
    }

    // =====================================================
    // Store
    // =====================================================
    public function store()
    {
    $model = new SubCpmkModel();

    $data = [
        'id_penyusun'   => $this->request->getPost('id_penyusun'),
        'id_matakuliah' => $this->request->getPost('id_matakuliah'),
        'sub_cpmk'      => $this->request->getPost('sub_cpmk'),
    ];

    $model->insert($data);

    // 🔴 INI KUNCI UTAMA
    return redirect()->to(base_url('table/subcpmk'))
    ->with('success', 'Sub CPMK berhasil ditambahkan');
    }
    
    // =====================================================
    // DELETE
    // =====================================================
    public function delete($id)
{
    // Hapus data berdasarkan ID
    $this->subcpmkModel->delete($id);

    // Redirect kembali ke halaman utama dengan pesan sukses
    return redirect()->to(base_url('table/subcpmk'))->with('success', 'Data Sub CPMK berhasil dihapus!');
}


    // =====================================================
    // SEARCH
    // =====================================================
    public function cari()
    {
        $q = $this->request->getGet('search');
        $data['subcpmk'] = $this->subcpmkModel->cariData($q);

        $data['penyusun']   = $this->penyusunModel->findAll();
        $data['matakuliah'] = $this->matakuliahModel->findAll();

        echo view('sub_cpmk/index', $data);
    }
}
