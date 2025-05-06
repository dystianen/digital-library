<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\MemberModel;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Jika belum login, coba cek cookie
        if (!$session->get('username')) {
            $username = $_COOKIE['remember_username'] ?? null;
            $token = $_COOKIE['remember_token'] ?? null;

            if ($username && $token) {
                $model = new MemberModel();
                $user = $model->where('username', $username)->first();

                // Verifikasi token dan auto-login
                if ($user && password_verify($user['password_hash'], $token)) {
                    $session->set([
                        'member_id' => $user['member_id'],
                        'username' => $user['username'],
                        'full_name' => $user['full_name'],
                        'role' => $user['role'],
                    ]);
                } else {
                    return redirect()->to(base_url('/login'));
                }
            } else {
                return redirect()->to(base_url('/login'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
