<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $data =
            [
                'active' => 'dashboard',
                'title' => 'Dashboard'
            ];
        return view('admin', $data);
    }
}
