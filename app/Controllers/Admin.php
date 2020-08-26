<?php

namespace App\Controllers;

use App\Models\barangModel;
use App\Models\pelangganModel;
use App\Models\transaksiModel;
use CodeIgniter\I18n\Time;

class Admin extends BaseController
{
    protected $barang, $pelanggan, $transaksi;
    public function __construct()
    {
        $this->barang = new barangModel();
        $this->pelanggan =  new pelangganModel();
        $this->transaksi = new transaksiModel();
    }
    public function index()
    {
        foreach ($this->barang->findAll() as $b) {
            $nama_barang[] = $b['barang'];
        }
        foreach ($nama_barang as $b) {
            $jumlah_barang[] = $this->barang->where('barang', $b)->first()['stok'];
        }
        $data =
            [
                'active' => 'dashboard',
                'title' => 'Dashboard',
                'transaksi' => $this->transaksi->findAll(),
                'nama_barang' => $nama_barang,
                'pelanggan' => $this->pelanggan->orderBy('jml_datang', 'DESC')->get(5)->getResultArray(),
                'jumlah_barang' => $jumlah_barang,
                'jumlah_pelanggan' => $this->pelanggan->countAll(),
                'jumlah_stok' => $this->barang->selectSum('stok')->first(),
                'jumlah_transaksi' => $this->transaksi->countAll(),
                'transaksi_today' => $this->transaksi->where('tanggal', Time::now('Asia/Jakarta')->toDateString())->countAllResults()
            ];
        return view('admin/dashboard', $data);
    }
    public function dataTransaksi()
    {
        $data =
            [
                'title' => 'Data Transaksi',
                'active' => 'dashboard',
                'jumlah' => $this->transaksi->countAll(),
                'transaksi' => $this->transaksi->select('*')
                    ->join('pelanggan', 'pelanggan.id = transaksi.pelanggan_id')
                    ->join('merk', 'merk.id = transaksi.merk_id')
                    ->orderBy('tanggal', 'DESC')
                    ->findAll()
            ];
        return view('admin/dataTransaksi', $data);
    }
}
