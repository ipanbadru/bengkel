<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Noauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->has('isLoggedIn')) {
            if (session()->get('role') == 'admin') {
                return redirect()->to('/admin');
            } elseif (session()->get('role') == 'customer') {
                return redirect()->to('/pelanggan');
            } elseif (session()->get('role') == 'kasir') {
                return redirect()->to('/pembayaran');
            }
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
