<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    public function index()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Anda tidak memiliki akses!');
        }

        $model = new UsersModel();
        $data['users'] = $model->findAll();

        // arahkan ke tableusers.php
        return view('tableusers', $data);
    }

    public function create()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Anda tidak memiliki akses!');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|is_unique[users.username]',
            'password' => 'required',
            'name' => 'required',
            'role' => 'required|in_list[admin,staff,manajer]'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model = new UsersModel();
            $model->insert([
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'name' => $this->request->getPost('name'),
                'role' => $this->request->getPost('role'),
            ]);

            return redirect()->to('table/users');
        }
        return $this->index();
    }

    public function edit($username)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Anda tidak memiliki akses!');
        }

        $model = new UsersModel();
        $data['user'] = $model->where('username', $username)->first();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'role' => 'required|in_list[admin,staff,manajer]'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {

            $updateData = [
                'name' => $this->request->getPost('name'),
                'role' => $this->request->getPost('role'),
            ];

            // password opsional
            if ($this->request->getPost('password')) {
                $updateData['password'] =
                    password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            }

            $model->update($username, $updateData);

            return redirect()->to('table/users');
        }

        // arahkan ke editusers.php
        return view('editusers', $data);
    }

    public function delete($username)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Anda tidak memiliki akses!');
        }

        $model = new UsersModel();
        $model->delete($username);

        return redirect()->to('table/users');
    }
}
