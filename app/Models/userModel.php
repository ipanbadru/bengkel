<?php

namespace App\Models;

use CodeIgniter\Model;

class userModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['nama', 'username', 'role', 'password'];
}
