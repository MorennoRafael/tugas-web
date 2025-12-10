<?php

namespace App\Controllers;

use App\Models\DBtable2b6;

class Table2b6 extends BaseController
{
    public function index()
    {
        $model = new DBtable2b6();
        $data['table2b6'] = $model->findAll();

        return view('table2b6', $data);
    }

    public function create()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'jenis_kemampuan' => 'required'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model = new DBtable2b6();
            $model->insert([
                "jenis_kemampuan" => $this->request->getPost('jenis_kemampuan'),
                "sangat_baik"     => $this->request->getPost('sangat_baik'),
                "baik"            => $this->request->getPost('baik'),
                "cukup"           => $this->request->getPost('cukup'),
                "kurang"          => $this->request->getPost('kurang'),
                "rencana_tindak"  => $this->request->getPost('rencana_tindak'),
            ]);

            return redirect()->to('table/table2b6');
        }

        return view('table2b6');
    }

    public function edit($id)
    {
        $model = new DBtable2b6();
        $data['table2b6'] = $model->where('id', $id)->first();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'jenis_kemampuan' => 'required'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model->update($id, [
                "jenis_kemampuan" => $this->request->getPost('jenis_kemampuan'),
                "sangat_baik"     => $this->request->getPost('sangat_baik'),
                "baik"            => $this->request->getPost('baik'),
                "cukup"           => $this->request->getPost('cukup'),
                "kurang"          => $this->request->getPost('kurang'),
                "rencana_tindak"  => $this->request->getPost('rencana_tindak'),
            ]);

            return redirect()->to('table/table2b6');
        }

        return view('edittable2b6', $data);
    }

    public function delete($id)
    {
        $model = new DBtable2b6();
        $model->delete($id);
        return redirect()->to('table/table2b6');
    }

    public function cari()
    {
        $model = new DBtable2b6();
        $cariData = $this->request->getGet('search');

        $data['table2b6'] = $model->cariData($cariData);

        return view('table2b6', $data);
    }
}
