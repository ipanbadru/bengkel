<?php

namespace App\Controllers;

use App\Models\userModel;

class User extends BaseController
{
    protected $user;
    public function __construct()
    {
        $this->user = new userModel();
    }
    public function index()
    {
        $data =
            [
                'title' => 'Daftar user',
                'active' => 'daftar user',
                'jumlah' => $this->user->where('role', 'customer')->orWhere('role', 'kasir')->countAllResults(),
                'user' => $this->user->where('role', 'customer')->orWhere('role', 'kasir')->findAll()
            ];
        return view('admin/daftarUser', $data);
    }
    public function delete($id)
    {
        $this->user->delete($id);
        session()->setFlashdata('pesan', 'Data User berhasil di hapus');
        return redirect()->to('/user');
    }
    public function edit()
    {
        $id = $this->request->getVar('id');
        return json_encode($this->user->where('id', $id)->first());
    }
    public function update()
    {
        $this->user->set('nama', $this->request->getVar('nama'));
        $this->user->set('username', $this->request->getVar('username'));
        $this->user->set('role', $this->request->getVar('role'));
        $this->user->where('id', $this->request->getVar('id'));
        $this->user->update();
        session()->setFlashdata('pesan', 'Data User berhasil di Edit');
        return redirect()->to('/user');
    }
    public function resetPassword()
    {
        $password = password_hash($this->request->getVar('password2'), PASSWORD_DEFAULT);
        $id = $this->request->getVar('id');
        $this->user->set('password', $password);
        $this->user->where('id', $id);
        $this->user->update();
        session()->setFlashdata('pesan', 'User berhasil di reset password');
        return redirect()->to('/user');
    }
}
