<?php

namespace App\Controllers;

use App\Models\notificationsModel;
use App\Models\pelangganModel;
use App\Models\userModel;
use CodeIgniter\I18n\Time;

class Transaksi extends BaseController
{
    protected $notifications, $pelanggan, $merk, $user;
    public function __construct()
    {
        $this->notifications = new notificationsModel();
        $this->pelanggan = new pelangganModel();
        $this->merk = \Config\Database::connect()->table('merk');
        $this->user = new userModel();
    }
    public function index()
    {
        $data =
            [
                'title' => 'Transaksi',
                'active' => 'transaksi',
                'pelanggan' => $this->pelanggan->findAll(),
                'validation' => \Config\Services::validation(),
            ];
        return view('user/transaksi', $data);
    }
    public function transaksion()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
            'merk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
            'merk_motor' => [
                'rules' => 'required',
                'label' => 'merk motor',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
            'jenis_motor' => [
                'rules' => 'required',
                'label' => 'jenis motor',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
            'kendala' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
        ])) {
            return redirect()->to('/transaksi')->withInput();
        }
        $user = $this->user->where('username', session()->get('username'))->first();
        $data =
            [
                'time' => Time::now('Asia/Jakarta')->toTimeString(),
                'pelanggan' => $this->request->getVar('nama'),
                'motor' => $this->request->getVar('jenis_motor'),
                'kendala' => $this->request->getVar('kendala'),
                'customer_id' => $user['id']
            ];
        $this->notifications->save($data);
        session()->setFlashdata('pesan', 'Transaksi berhasil di tambahkan');
        return redirect()->to('/transaksi');
    }
    public function tampilMerk()
    {
        if ($this->request->isAJAX()) {
            $merk = $this->request->getPost('merk');
            $this->merk->select('merk_motor');
            $result = $this->merk->getWhere(['merk' => $merk])->getResultArray();
            $newResult = [];
            foreach ($result as $r) {
                if ($newResult == []) {
                    $newResult[] = $r;
                }
                if (end($newResult) != $r) {
                    $newResult[] = $r;
                }
            }
            echo json_encode($newResult);
        }
    }
    public function tampilJenis()
    {
        if ($this->request->isAJAX()) {
            $merk_motor = $this->request->getPost('merk_motor');
            $result = $this->merk->getWhere(['merk_motor' => $merk_motor])->getResultArray();
            echo json_encode($result);
        }
    }
}
