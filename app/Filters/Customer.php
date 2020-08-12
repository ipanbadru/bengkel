<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Customer implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('/');
        }
        if (session()->get('role') == 'kasir') {
            return redirect()->to('/pembayaran');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
