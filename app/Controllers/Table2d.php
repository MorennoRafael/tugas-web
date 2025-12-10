<?php

namespace App\Controllers;

use App\Models\DBtable2d;

class Table2d extends BaseController
{
    public function index()
    {
        $model = new DBtable2d();
        $data['table2d'] = $model->findAll();

        return view('table2d', $data);
    }

    public function create()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'sumber_rekognisi'        => 'required',
            'jenis_pengakuan_lulusan' => 'required',
            'tahun_akademik'          => 'required',
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model = new DBtable2d();
            $model->insert([
                "sumber_rekognisi"        => $this->request->getPost('sumber_rekognisi'),
                "jenis_pengakuan_lulusan" => $this->request->getPost('jenis_pengakuan_lulusan'),
                "tahun_akademik"          => $this->request->getPost('tahun_akademik'),
                "link_bukti"              => $this->request->getPost('link_bukti'),
            ]);

            return redirect()->to('table/table2d');
        }

        return view('table2d');
    }

    public function edit($no)
    {
        $model = new DBtable2d();
        $data['table2d'] = $model->where('no', $no)->first();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'sumber_rekognisi'        => 'required',
            'jenis_pengakuan_lulusan' => 'required',
            'tahun_akademik'          => 'required',
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model->update($no, [
                "sumber_rekognisi"        => $this->request->getPost('sumber_rekognisi'),
                "jenis_pengakuan_lulusan" => $this->request->getPost('jenis_pengakuan_lulusan'),
                "tahun_akademik"          => $this->request->getPost('tahun_akademik'),
                "link_bukti"              => $this->request->getPost('link_bukti'),
            ]);

            return redirect()->to('table/table2d');
        }

        return view('edittable2d', $data);
    }

    public function delete($no)
    {
        $model = new DBtable2d();
        $model->delete($no);
        return redirect()->to('table/table2d');
    }

    public function cari()
    {
        $model = new DBtable2d();
        $cariData = $this->request->getGet('search');

        $data['table2d'] = $model->cariData($cariData);

        return view('table2d', $data);
    }
}
