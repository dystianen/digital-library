<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('username')) {
            return redirect()->to(base_url('/login'));
        }
        !session()->get('username');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
