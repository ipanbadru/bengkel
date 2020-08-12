<?php

namespace App\Models;

use CodeIgniter\Model;

class barangModel extends Model
{
    protected $table = 'barang';
    protected $allowedFields = ['barang', 'stok', 'harga_beli', 'harga_jual'];
}
