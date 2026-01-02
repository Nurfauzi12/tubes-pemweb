<?php

namespace App\Controllers;

use App\Models\CplModel;
use App\Models\PenyusunModel;
use App\Models\MatakuliahModel;

class CplController extends BaseController
{
    public function index()
    {
        $cpl = new CplModel();
        $data['cpl'] = $cpl
            ->select('cpl.*, penyusun.pengembangan_rps, matakuliah.matakuliah')
            ->join('penyusun', 'penyusun.id = cpl.id_penyusun')
            ->join('matakuliah', 'matakuliah.id = cpl.id_matakuliah')
            ->findAll();

        return view('cpl/index', $data);
    }

    public function create()
    {
        $data['penyusun']   = (new PenyusunModel())->findAll();
        $data['matakuliah'] = (new MatakuliahModel())->findAll();
        return view('cpl/create', $data);
    }

    public function store()
    {
        $cpl = new CplModel();

        if (!$cpl->save($this->request->getPost())) {
            return redirect()->back()->withInput()->with('errors', $cpl->errors());
        }

        return redirect()->to('/cpl')->with('success', 'CPL berhasil ditambahkan');
    }

    public function delete($id)
    {
        (new CplModel())->delete($id);
        return redirect()->to('/cpl')->with('success', 'CPL dihapus');
    }
}
