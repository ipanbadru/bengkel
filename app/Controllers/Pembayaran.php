<?php

namespace App\Controllers;

use App\Models\barangModel;
use App\Models\montirModel;
use App\Models\notificationsModel;
use App\Models\transaksiModel;
use CodeIgniter\I18n\Time;
use Dompdf\Dompdf;

class Pembayaran extends BaseController
{
    protected $notifications, $montir, $barang, $transaksi;
    public function __construct()
    {
        $this->notifications = new notificationsModel();
        $this->montir = new montirModel();
        $this->barang = new barangModel();
        $this->transaksi = new transaksiModel();
    }
    public function index()
    {
        $data =
            [
                'title' => 'Pembayaran',
                'active' => 'pembayaran',
                'notifications' => $this->notifications->select('notifications.id, pelanggan.nama_pelanggan, merk.detail_merk, notifications.kendala')
                    ->join('pelanggan', 'pelanggan.id = notifications.pelanggan')
                    ->join('merk', 'merk.id = notifications.motor')
                    ->findAll()
            ];
        return view('user/pembayaran', $data);
    }
    public function notifications()
    {
        if ($this->request->isAJAX()) {
            $result = $this->notifications->countAll();
            echo json_encode($result);
        }
    }
    public function dataNotifications()
    {
        $result = $this->notifications->select('notifications.id, pelanggan.nama_pelanggan, merk.detail_merk, notifications.kendala')
            ->join('pelanggan', 'pelanggan.id = notifications.pelanggan')
            ->join('merk', 'merk.id = notifications.motor')
            ->findAll();
        echo json_encode($result);
    }
    public function bayar($id)
    {
        $this->notifications->select('notifications.id, nama_pelanggan, detail_merk, kendala');
        $this->notifications->join('pelanggan', 'pelanggan.id = notifications.pelanggan');
        $this->notifications->join('merk', 'merk.id = notifications.motor');
        $this->notifications->where('notifications.id', $id);
        $notif = $this->notifications->first();
        $data =
            [
                'title' => 'Bayar',
                'active' => 'pembayaran',
                'notification' => $notif,
                'montir' => $this->montir->findAll(),
                'barang' => $this->barang->findAll(),
                'validation' => \Config\Services::validation()
            ];
        return view('user/bayar', $data);
    }
    public function tampilHarga()
    {
        $barang = $this->request->getPost('barang');
        $jumlah = $this->request->getPost('jumlah');
        $result = $this->barang->where('id', $barang)->findAll()[0]['harga_jual'] * $jumlah;
        echo json_encode($result);
    }
    public function transaksi()
    {
        if (!$this->validate([
            'nama_montir' => [
                'rules' => 'required',
                'label' => 'Nama Montir',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input {field} harus di isi'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input {field} harus di isi',
                ]
            ],
        ])) {
            return redirect()->to('/pembayaran/bayar/' . $this->request->getVar('id'))->withInput();
        }
        $tb_detail = \Config\Database::connect()->table('detail_transaksi');
        $jumlah_pengeluaran = [];
        $pengeluaran = $this->request->getVar('pengeluaran_barang');
        for ($i = 1; $i <= $pengeluaran; $i++) {
            //Mengurangi jumlah Barang x
            $barang = $this->request->getVar("barang$i");
            $jumlah = $this->request->getVar("jumlah_barang$i");
            $result = $this->barang->where('id', $barang)->first();
            $jumlah_pengeluaran[] .= $result['barang'];
            $result = $result['stok'] - $jumlah;
            $this->barang->set('stok', $result);
            $this->barang->where('id', $barang);
            $this->barang->update();

            //Menambahkan detal trransaksi
            $data = [
                'transaksi_id' => $this->transaksi->selectMax('id')->first()['id'] + 1,
                'barang_id' => $barang,
                'jumlah_barang' => $jumlah,
            ];
            $tb_detail->insert($data);
        }
        $notif = $this->notifications->where('id', $this->request->getVar('id'))->first();
        $user = \Config\Database::connect()->table('user');
        $user = $user->where('username', session()->get('username'))->get()->getRowArray();
        if ($jumlah_pengeluaran == []) {
            $jumlah_pengeluaran = 'Tidak ada pengeluaran barang';
        } else {
            $jumlah_pengeluaran = implode(", ", $jumlah_pengeluaran);
        }
        $kolom = $this->transaksi->countAll() + 1;
        $data =
            [
                'no_transaksi' => "Transaksi ke $kolom",
                'tanggal' => Time::now('Asia/Jakarta')->toDateString(),
                'keterangan' => $this->request->getVar('keterangan'),
                'pengeluaran_barang' => $jumlah_pengeluaran,
                'kendala' => $notif['kendala'],
                'waktu_servis' => $notif['time'] . " - " . Time::now('Asia/Jakarta')->toTimeString(),
                'total' => str_replace('.', '', $this->request->getVar('harga')),
                'montir_id' => $this->request->getVar('nama_montir'),
                'merk_id' => $notif['motor'],
                'pelanggan_id' => $notif['pelanggan'],
                'customer_id' => $notif['customer_id'],
                'kasir_id' => $user['id']
            ];
        $this->transaksi->save($data);
        $this->notifications->delete($this->request->getVar('id'));
        session()->setFlashdata('pesan', 'Pembayaran berhasil di lakukan');
        return redirect()->to('/pembayaran');
    }
    public function history()
    {
        $data =
            [
                'title' => 'History',
                'active' => 'history',
                'jumlah' => $this->transaksi->where('tanggal', Time::now('Asia/Jakarta')->toDateString())
                    ->countAllResults(),
                'transaksi' => $this->transaksi->select('pelanggan.nama_pelanggan, merk.merk_motor, transaksi.waktu_servis, transaksi.total, transaksi.id')
                    ->join('pelanggan', 'pelanggan.id = transaksi.pelanggan_id')
                    ->join('merk', 'merk.id = transaksi.merk_id')
                    ->where('tanggal', Time::now('Asia/Jakarta')->toDateString())
                    ->orderBy('no_transaksi', 'DESC')
                    ->findAll()
            ];
        return view('user/history', $data);
    }
    public function tampilTotal()
    {
        if ($this->request->isAJAX()) {
            $barang = $this->request->getPost('barang');
            $jumlah = $this->request->getPost('jumlah');
            $result = $this->barang->where('id', $barang)->first()['harga_jual'] * $jumlah;
            return json_encode($result);
        }
    }

    public function cetakDataHariIni()
    {
        $tanggal = Time::now('Asia/Jakarta')->toDateString();
        $data['transaksi'] = $this->transaksi->where('tanggal', $tanggal)->join('pelanggan', 'pelanggan.id = transaksi.pelanggan_id')->join('merk', 'merk.id = transaksi.merk_id')->join('montir', 'montir.id = transaksi.montir_id')->findAll();
        $data['tanggal'] = $tanggal;
        $dompdf = new Dompdf();
        $html = view('user/cetak_data_hari_ini', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('Laporan Data tanggal ' . $tanggal . '.pdf', ['Attachment' => false]);
    }
}
