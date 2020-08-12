<?php

namespace App\Models;

use CodeIgniter\Model;

class pelangganModel extends Model
{
    protected $table = 'pelanggan';
    protected $allowedFields = ['nama_pelanggan', 'alamat', 'no_hp'];
}
