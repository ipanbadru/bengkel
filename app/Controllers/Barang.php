<?php

namespace App\Controllers;

use App\Models\barangModel;

class Barang extends BaseController
{
    protected $barang;
    public function __construct()
    {
        $this->barang = new barangModel();
    }
    public function index()
    {
        $data =
            [
                'title' => 'Barang',
                'active' => 'barang',
                'jumlah' => $this->barang->countAll(),
                'barang' => $this->barang->findAll()
            ];
        return view('barang/index', $data);
    }
    public function tambah()
    {
        $data =
            [
                'title' => 'Tambah Barang',
                'active' => 'barang',
                'validation' => \Config\Services::validation()
            ];
        return view('barang/tambah', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Input {field} harus di isi',
                    'numeric' => 'Input {field} harus berupa angka'
                ]
            ],
            'harga_beli' => [
                'rules' => 'required|numeric|trim',
                'label' => 'Harga Beli',
                'errors' => [
                    'required' => 'Input {field} harus di isi',
                    'numeric' => 'Input {field} harus berupa angka'
                ]
            ],
            'harga_jual' => [
                'rules' => 'required|numeric|trim',
                'label' => 'Harga Jual',
                'errors' => [
                    'required' => 'Input {field} harus di isi',
                    'numeric' => 'Input {field} harus berupa angka'
                ]
            ],
        ])) {
            return redirect()->to('/barang/tambah')->withInput();
        }
        $data =
            [
                'barang' => $this->request->getVar('barang'),
                'stok' => $this->request->getVar('stok'),
                'harga_beli' => str_replace('.', '', $this->request->getVar('harga_beli')),
                'harga_jual' => str_replace('.', '', $this->request->getVar('harga_jual'))
            ];
        $this->barang->save($data);
        session()->setFlashdata('pesan', 'Data barang berhasil di tambahkan');
        return redirect()->to('/barang');
    }
    public function delete($id)
    {
        $this->barang->delete($id);
        session()->setFlashdata('pesan', 'Data barang berhasil di hapus');
        return redirect()->to('/barang');
    }
    public function edit($id)
    {
        $data =
            [
                'title' => 'Edit Barang',
                'active' => 'barang',
                'barang' => $this->barang->where('id', $id)
                    ->first(),
                'validation' => \Config\Services::validation()
            ];
        return view('barang/edit', $data);
    }
    public function update()
    {
        if (!$this->validate([
            'barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Input {field} harus di isi',
                    'numeric' => 'Input {field} harus berupa angka'
                ]
            ],
            'harga_beli' => [
                'rules' => 'required|numeric|trim',
                'label' => 'Harga Beli',
                'errors' => [
                    'required' => 'Input {field} harus di isi',
                    'numeric' => 'Input {field} harus berupa angka'
                ]
            ],
            'harga_jual' => [
                'rules' => 'required|numeric|trim',
                'label' => 'Harga Jual',
                'errors' => [
                    'required' => 'Input {field} harus di isi',
                    'numeric' => 'Input {field} harus berupa angka'
                ]
            ],
        ])) {
            return redirect()->to('/barang/edit' . $this->request->getVar('id'))->withInput();
        }
        $data =
            [
                'id' => $this->request->getVar('id'),
                'barang' => $this->request->getVar('barang'),
                'stok' => $this->request->getVar('stok'),
                'harga_beli' => str_replace('.', '', $this->request->getVar('harga_beli')),
                'harga_jual' => str_replace('.', '', $this->request->getVar('harga_jual'))
            ];
        $this->barang->save($data);
        session()->setFlashdata('pesan', 'Data barang berhasil di Edit');
        return redirect()->to('/barang');
    }
}
