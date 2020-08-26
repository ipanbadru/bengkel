<?php

namespace App\Controllers;

use App\Models\userModel;

class Auth extends BaseController
{
    protected $tb_user;
    public function __construct()
    {
        $this->tb_user = new userModel();
    }
    public function index()
    {
        $data['validation'] = \Config\Services::validation();
        return view('auth/login', $data);
    }
    public function login()
    {
        if (!$this->validate([
            'username' =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => 'input {field} harus di isi'
                ]
            ],
            'password' =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => 'input {field} harus di isi'
                ]
            ],
        ])) {
            return redirect('/')->withInput();
        } else {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $user = $this->tb_user->where('username', $username)
                ->first();
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $data =
                        [
                            'nama' => $user['nama'],
                            'username' => $user['username'],
                            'role' => $user['role'],
                            'isLoggedIn' => 1,
                        ];
                    session()->set($data);
                    if ($user['role'] == 'admin') {
                        return redirect()->to('/admin');
                    } elseif ($user['role'] == 'customer') {
                        return redirect()->to('/pelanggan');
                    } else {
                        return redirect()->to('/pembayaran');
                    }
                } else {
                    session()->setFlashdata('kesalahan', 'Password yang anda masukan salah');
                    return redirect()->to('/');
                }
            } else {
                session()->setFlashdata('kesalahan', 'Username yang anda masukan tidak terdaftar');
                return redirect()->to('/');
            }
        }
    }
    public function registrasi()
    {
        $data['validation'] = \Config\Services::validation();
        return view('auth/registrasi', $data);
    }
    public function registerAccount()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
            'password1' => [
                'rules' => 'required',
                'label' => 'Password',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ], 'password2' => [
                'rules' => 'required|matches[password1]',
                'label' => 'Password',
                'errors' => [
                    'required' => 'Input {field} harus di isi',
                    'matches' => 'Input {field} Tidak sama'
                ]
            ],
        ])) {
            return redirect()->to('/registrasi')->withInput();
        }
        $data =
            [
                'nama' => $this->request->getVar('nama'),
                'username' => $this->request->getVar('username'),
                'role' => $this->request->getVar('role'),
                'password' => password_hash($this->request->getVar('password1'), PASSWORD_DEFAULT),
            ];
        $this->tb_user->save($data);
        session()->setFlashdata('pesan', 'User baru telah di tambahkan dengan role ' . $this->request->getVar('role'));
        return redirect()->to('registrasi');
    }
    public function logout()
    {
        $items = ['nama', 'username', 'role', 'isLoggedIn'];
        session()->remove($items);
        session()->setFlashdata('pesan', 'Anda berhasil Logout');
        return redirect()->to('/');
    }
}
