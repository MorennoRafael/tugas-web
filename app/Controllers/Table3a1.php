<?php

namespace App\Controllers;

use App\Models\DBtable3a1;

class Table3a1 extends BaseController
{
    public function index()
    {
        $model = new DBtable3a1();
        $data['table3a1'] = $model->findAll();

        return view('table3a1', $data);
    }

    public function create()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_prasarana' => 'required',
            'daya_tampung'   => 'required|integer',
            'luas_ruang'     => 'required',
            'kepemilikan'    => 'required',
            'lisensi'        => 'required',
            'perangkat'      => 'required',
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model = new DBtable3a1();
            $model->insert([
                "nama_prasarana" => $this->request->getPost('nama_prasarana'),
                "daya_tampung"   => $this->request->getPost('daya_tampung'),
                "luas_ruang"     => $this->request->getPost('luas_ruang'),
                "kepemilikan"    => $this->request->getPost('kepemilikan'),
                "lisensi"        => $this->request->getPost('lisensi'),
                "perangkat"      => $this->request->getPost('perangkat'),
                "link_bukti"     => $this->request->getPost('link_bukti'),
            ]);

            return redirect()->to('table/table3a1');
        }

        return view('table3a1');
    }

    public function edit($no)
    {
        $model = new DBtable3a1();
        $data['table3a1'] = $model->where('no', $no)->first();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_prasarana' => 'required',
            'daya_tampung'   => 'required|integer',
            'luas_ruang'     => 'required',
            'kepemilikan'    => 'required',
            'lisensi'        => 'required',
            'perangkat'      => 'required',
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model->update($no, [
                "nama_prasarana" => $this->request->getPost('nama_prasarana'),
                "daya_tampung"   => $this->request->getPost('daya_tampung'),
                "luas_ruang"     => $this->request->getPost('luas_ruang'),
                "kepemilikan"    => $this->request->getPost('kepemilikan'),
                "lisensi"        => $this->request->getPost('lisensi'),
                "perangkat"      => $this->request->getPost('perangkat'),
                "link_bukti"     => $this->request->getPost('link_bukti'),
            ]);

            return redirect()->to('table/table3a1');
        }

        return view('edittable3a1', $data);
    }

    public function delete($no)
    {
        $model = new DBtable3a1();
        $model->delete($no);
        return redirect()->to('table/table3a1');
    }

    public function cari()
    {
        $model = new DBtable3a1();
        $cariData = $this->request->getGet('search');

        $data['table3a1'] = $model->cariData($cariData);

        return view('table3a1', $data);
    }
}
