<?php

namespace App\Models;

use CodeIgniter\Model;

class notificationsModel extends Model
{
    protected $table = 'notifications';
    protected $allowedFields = ['time', 'pelanggan', 'motor', 'kendala', 'customer_id'];
}
