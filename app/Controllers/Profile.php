<?php

namespace App\Controllers;

use App\Models\userModel;

class Profile extends BaseController
{
    protected $user;
    public function __construct()
    {
        $this->user = new userModel();
    }
    public function index()
    {
        $user = $this->user->where('username', session()->get('username'))->first();
        $transaksi = \Config\Database::connect()->table('transaksi');
        $data =
            [
                'title' => 'Profile',
                'active' => 'profile',
                'user' => $user,
                'transaksi' => $transaksi->where('customer_id', $user['id'])->countAllResults(),
                'bayar' => $transaksi->where('kasir_id', $user['id'])->countAllResults()
            ];
        return view('user/profile', $data);
    }
    public function updateProfile()
    {
        $this->user->set('nama', $this->request->getVar('nama'));
        $this->user->set('username', $this->request->getVar('username'));
        $this->user->where('id', $this->request->getVar('id'));
        $this->user->update();
        session()->remove(['nama', 'username']);
        $user = $this->user->where('id', $this->request->getVar('id'))->first();
        $data =
            [
                'nama' => $user['nama'],
                'username' => $user['username']
            ];
        session()->set($data);
        session()->setFlashdata('pesan', 'Data profile berhasil di ubah');
        return redirect()->to('/profile');
    }
    public function checkPassword()
    {
        $password = $this->request->getVar('password');
        $user = $this->user->where('username', session()->get('username'))->first();
        if (password_verify($password, $user['password'])) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }
    public function changePassword()
    {
        $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        $this->user->set('password', $password);
        $this->user->where('username', session()->get('username'));
        $this->user->update();
        session()->setFlashdata('pesan', 'Password berhasil di ubah');
        return redirect()->to('/profile');
    }
}
