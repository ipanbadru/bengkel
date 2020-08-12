<?php

namespace App\Models;

use CodeIgniter\Model;

class montirModel extends Model
{
    protected $table = 'montir';
    protected $allowedFields = ['nama_montir', 'alamat_montir'];
}
