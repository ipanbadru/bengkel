<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Kasir implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('/');
        }
        if (session()->get('role') != 'kasir' || session()->get('role') != 'admin') {
            return redirect()->to('/pelanggan');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
