<?php

namespace App\Controllers;

use App\Models\montirModel;

class Montir extends BaseController
{
    protected $montir;
    public function __construct()
    {
        $this->montir = new montirModel();
    }
    public function index()
    {
        $currentPage = $this->request->getVar('page_montir') ? $this->request->getVar('page_montir') : 1;
        $keyword = $this->request->getVar('keyword');
        $data =
            [
                'title' => 'Montir',
                'active' => 'montir',
                'jumlah' => $this->montir->countAll(),
                'montir' => $keyword ? $this->montir->like('nama_montir', $keyword)->paginate(5, 'montir') : $this->montir->paginate(5, 'montir'),
                'pager' => $this->montir->pager,
                'currentPage' => $currentPage
            ];
        return view('montir/index', $data);
    }
    public function tambah()
    {
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        if ($id == '') {
            $data =
                [
                    'nama_montir' => $nama,
                    'alamat_montir' => $alamat
                ];
            $this->montir->save($data);
            session()->setFlashdata('pesan', 'Data Montir berhasil di Tambahkan');
            echo json_encode('success');
        } else {
            $data =
                [
                    'id' => $id,
                    'nama_montir' => $nama,
                    'alamat_montir' => $alamat
                ];
            $this->montir->save($data);
            session()->setFlashdata('pesan', 'Data Montir berhasil di Ubah');
            echo json_encode('success');
        }
    }
    public function delete($id)
    {
        $this->montir->delete($id);
        session()->setFlashdata('pesan', 'Data Montir berhasil di hapus');
        return redirect()->to('/montir');
    }
    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $result = $this->montir->where('id', $id)
                ->first();
            echo json_encode($result);
        }
    }
}
