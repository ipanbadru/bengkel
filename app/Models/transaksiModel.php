<?php

namespace App\Models;

use CodeIgniter\Model;

class transaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $allowedFields = ['no_transaksi', 'tanggal', 'keterangan', 'pengeluaran_barang', 'kendala', 'waktu_servis', 'total', 'montir_id', 'merk_id', 'pelanggan_id', 'customer_id', 'kasir_id'];
}
