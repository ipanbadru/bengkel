<?php

namespace App\Controllers;

use App\Models\barangModel;
use App\Models\pelangganModel;
use App\Models\transaksiModel;
use CodeIgniter\I18n\Time;
use Dompdf\Dompdf;

class Admin extends BaseController
{
    protected $barang, $pelanggan, $transaksi, $detail_transaksi;
    public function __construct()
    {
        $this->barang = new barangModel();
        $this->pelanggan =  new pelangganModel();
        $this->transaksi = new transaksiModel();
        $this->detail_transaksi = db_connect()->table('detail_transaksi');
    }
    public function index()
    {
        foreach ($this->barang->findAll() as $b) {
            $nama_barang[] = $b['barang'];
        }
        foreach ($nama_barang as $b) {
            $jumlah_barang[] = $this->barang->where('barang', $b)->first()['stok'];
        }
        if (strlen(Time::now('Asia/Jakarta')->getMonth()) == 1) {
            $bulan = '0' . Time::now('Asia/Jakarta')->getMonth();
        } else {
            $bulan = Time::now('Asia/Jakarta')->getMonth();
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
                'transaksi_today' => $this->transaksi->where('tanggal', Time::now('Asia/Jakarta')->toDateString())->countAllResults(),
                'jumlah_pelanggan_bulan_ini' => $this->transaksi->like('tanggal', Time::now('Asia/Jakarta')->getYear() . '-' . $bulan . '-')->countAllResults()
            ];
        return view('admin/dashboard', $data);
    }
    public function dataTransaksi()
    {
        $currentPage = $this->request->getVar('page_transaksi') ? $this->request->getVar('page_transaksi') : 1;
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $transaksi = $this->transaksi->select('transaksi.id, pelanggan.nama_pelanggan, transaksi.tanggal, transaksi.waktu_servis, transaksi.total')
                ->join('pelanggan', 'pelanggan.id = transaksi.pelanggan_id')
                ->join('merk', 'merk.id = transaksi.merk_id')
                ->orderBy('transaksi.tanggal', 'DESC')
                ->like('nama_pelanggan', $keyword)
                ->orLike('tanggal', $keyword)
                ->paginate(7, 'transaksi');
        } else {
            $transaksi = $this->transaksi->select('transaksi.id, pelanggan.nama_pelanggan, transaksi.tanggal, transaksi.waktu_servis, transaksi.total')
                ->join('pelanggan', 'pelanggan.id = transaksi.pelanggan_id')
                ->join('merk', 'merk.id = transaksi.merk_id')
                ->orderBy('transaksi.tanggal', 'DESC')
                ->paginate(7, 'transaksi');
        }
        $data =
            [
                'title' => 'Data Transaksi',
                'active' => 'dashboard',
                'jumlah' => $this->transaksi->countAll(),
                'transaksi' => $transaksi,
                'pager' => $this->transaksi->pager,
                'currentPage' => $currentPage,
            ];
        return view('admin/dataTransaksi', $data);
    }
    public function detailTransaksi()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $result = $this->transaksi
                ->join('pelanggan', 'pelanggan.id = transaksi.pelanggan_id')
                ->join('merk', 'merk.id = transaksi.merk_id')
                ->join('montir', 'montir.id = transaksi.montir_id')
                ->where('transaksi.id', $id)
                ->first();
            return json_encode($result);
        }
    }
    public function dataPerbulan()
    {
        $waktu = Time::now('Asia/Jakarta');
        $currentPage = $this->request->getVar('page_transaksi') ? $this->request->getVar('page_transaksi') : 1;
        $getBulan = $this->request->getVar('bulan');
        if ($getBulan) {
            $bulan = strlen($getBulan) == 1 ? '0' . $getBulan : $getBulan;
        } else {
            $bulan = strlen($waktu->getMonth()) == 1 ? '0' . $waktu->getMonth() : $waktu->getMonth();
        }
        $data =
            [
                'active' => 'dashboard',
                'title' => 'Data perbulan',
                'jumlah_barang' => $this->detail_transaksi->selectSum('jumlah_barang')->join('transaksi', 'transaksi.id = detail_transaksi.transaksi_id')->like('transaksi.tanggal', $waktu->getYear() . '-' . $bulan . '-')->get()->getRowArray(),
                'total_pendapatan' => $this->transaksi->selectSum('total')->like('tanggal', $waktu->getYear() . '-' . $bulan . '-')->first(),
                'jumlah' => $this->transaksi->like('tanggal', $waktu->getYear() . '-' . $bulan . '-')->countAllResults(),
                'transaksi' => $this->transaksi->select('transaksi.id, pelanggan.nama_pelanggan, transaksi.tanggal, transaksi.waktu_servis, transaksi.total')
                    ->join('pelanggan', 'pelanggan.id = transaksi.pelanggan_id')
                    ->join('merk', 'merk.id = transaksi.merk_id')
                    ->orderBy('transaksi.tanggal', 'DESC')
                    ->like('transaksi.tanggal', $waktu->getYear() . '-' . $bulan . '-')
                    ->paginate(5, 'transaksi'),
                'pager' => $this->transaksi->pager,
                'currentPage' => $currentPage,
                'bulan' => $getBulan ? $getBulan : $waktu->getMonth()
            ];
        return view('admin/data_perbulan', $data);
    }

    public function cetakDataPerbulan()
    {
        $getBulan = $this->request->getVar('bulan');
        switch ($getBulan) {
            case 1:
                $namaBulan = 'Januari';
                break;
            case 2:
                $namaBulan = 'Februari';
                break;
            case 3:
                $namaBulan = 'Maret';
                break;
            case 4:
                $namaBulan = 'April';
                break;
            case 5:
                $namaBulan = 'Mei';
                break;
            case 6:
                $namaBulan = 'Juni';
                break;
            case 7:
                $namaBulan = 'Juli';
                break;
            case 8:
                $namaBulan = 'Agustus';
                break;
            case 9:
                $namaBulan = 'September';
                break;
            case 10:
                $namaBulan = 'Oktober';
                break;
            case 11:
                $namaBulan =  'November';
                break;
            case 12:
                $namaBulan =  'Desember';
                break;
        }
        $bulan = strlen($getBulan) == 1 ? '0' . $getBulan : $getBulan;
        $data = [
            'nama_bulan' => $namaBulan,
            'transaksi' => $this->transaksi->join('pelanggan', 'pelanggan.id = transaksi.pelanggan_id')->join('merk', 'merk.id = transaksi.merk_id')->join('montir', 'montir.id = transaksi.montir_id')->like('transaksi.tanggal', Time::now()->getYear() . '-' . $bulan)->findAll()
        ];
        $dompdf = new Dompdf();
        $html = view('admin/cetak_data_perbulan', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('Laporan Data bulan ' . $namaBulan . '.pdf', ['Attachment' => false]);
    }
}
