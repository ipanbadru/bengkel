<?php

namespace App\Controllers;

use App\Models\pelangganModel;

class Pelanggan extends BaseController
{
    protected $pelanggan;
    public function __construct()
    {
        $this->pelanggan = new pelangganModel();
    }
    public function index()
    {
        $currentPage = $this->request->getVar('page_pelanggan') ? $this->request->getVar('page_pelanggan') : 1;
        $keyword = $this->request->getVar('keyword');
        $data =
            [
                'title' => 'Pelanggan',
                'active' => 'pelanggan',
                'jumlah' => $this->pelanggan->countAll(),
                'pelanggan' => $keyword ? $this->pelanggan->like('nama_pelanggan', $keyword)->paginate(5, 'pelanggan') : $this->pelanggan->paginate(5, 'pelanggan'),
                'pager' => $this->pelanggan->pager,
                'currentPage' => $currentPage
            ];
        return view('pelanggan/index', $data);
    }
    public function tambah()
    {
        $data =
            [
                'title' => 'Tambah Pelanggan',
                'active' => 'pelanggan',
                'validation' => \Config\Services::validation()
            ];
        return view('pelanggan/tambah', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
            'no_hp' =>
            [
                'rules' => 'required|numeric',
                'label' => 'No hp',
                'errors' => [
                    'required' => 'Input {field} harus di isi',
                    'numeric' => 'Input harus berupa angka'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
        ])) {
            return redirect()->to('/pelanggan/tambah')->withInput();
        } else {
            $data =
                [
                    'nama_pelanggan' => $this->request->getVar('nama'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'alamat' => $this->request->getVar('alamat')
                ];
            $this->pelanggan->save($data);
            session()->setFlashdata('pesan', 'Data Pelanggan berhasil di tambahkan');
            return redirect()->to('/pelanggan');
        }
    }
    public function delete($id)
    {
        $this->pelanggan->delete($id);
        session()->setFlashdata('pesan', 'Data Pelanggan berhasil di Hapus');
        return redirect()->to('/pelanggan');
    }
    public function edit($id)
    {
        $data =
            [
                'title' => 'Edit Pelanggan',
                'active' => 'pelanggan',
                'pelanggan' => $this->pelanggan->where('id', $id)
                    ->first(),
                'validation' => \Config\Services::validation()
            ];
        return view('pelanggan/edit', $data);
    }
    public function update()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
            'no_hp' =>
            [
                'rules' => 'required|numeric',
                'label' => 'No hp',
                'errors' => [
                    'required' => 'Input {field} harus di isi',
                    'numeric' => 'Input harus berupa angka'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
        ])) {
            return redirect()->to('/pelanggan/edit/' . $this->request->getVar('id'))->withInput();
        } else {
            $data =
                [
                    'id' => $this->request->getVar('id'),
                    'nama_pelanggan' => $this->request->getVar('nama'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'alamat' => $this->request->getVar('alamat')
                ];
            $this->pelanggan->save($data);
            session()->setFlashdata('pesan', 'Data Pelanggan berhasil di Edit');
            return redirect()->to('/pelanggan');
        }
    }
}
