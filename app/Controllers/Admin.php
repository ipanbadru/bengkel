<?php

namespace App\Controllers;

use App\Models\barangModel;
use App\Models\pelangganModel;
use App\Models\transaksiModel;
use CodeIgniter\I18n\Time;

class Admin extends BaseController
{
    public function index()
    {
        $barang = new barangModel();
        $pelanggan =  new pelangganModel();
        $transaksi = new transaksiModel();
        $trns = $transaksi->orderBy('tanggal', 'ASC')->findAll();
        foreach ($trns as $t) {
            $tanggal[] = $t['tanggal'];
            $tanggal = array_unique($tanggal);
        }
        foreach ($tanggal as $tgl) {
            $jumlah_transaksi[] = $transaksi->where('tanggal', $tgl)->countAllResults();
        }
        $data =
            [
                'active' => 'dashboard',
                'title' => 'Dashboard',
                'transaksi' => $transaksi->findAll(),
                'jumlah_transaksi_perhari' => $jumlah_transaksi,
                'tanggal' => array_unique($tanggal),
                'jumlah_pelanggan' => $pelanggan->countAll(),
                'jumlah_stok' => $barang->selectSum('stok')->first(),
                'jumlah_transaksi' => $transaksi->countAll(),
                'transaksi_today' => $transaksi->where('tanggal', Time::now('Asia/Jakarta')->toDateString())->countAllResults()
            ];
        return view('admin', $data);
    }
}
