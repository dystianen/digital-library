<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MemberModel;
use CodeIgniter\API\ResponseTrait;

class AuthController extends BaseController
{
    use ResponseTrait;
    protected $memberModel;

    public function __construct()
    {
        $this->memberModel = new MemberModel();
    }

    public function loginView()
    {
        return view("auth/v_login");
    }

    public function loginStore()
    {
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password_hash');

        $data = $this->memberModel
            ->where('username', $username)->first();

        if ($data) {
            $pass = $data['password_hash'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'member_id' => $data['member_id'],
                    'username' => $data['username'],
                    'full_name' => $data['full_name'],
                    'role' => $data['role'],
                ];

                $session->set($ses_data);

                if ($data['role'] == 'admin') {
                    return redirect()->to(base_url('/admin/books'));
                } else {
                    return redirect()->to(base_url('/'));
                }
            } else {
                $session->setFlashdata('failed', 'Password is incorrect.');
                return redirect()->to(base_url('/login'));
            }
        } else {
            $session->setFlashdata('failed', 'Username does not exist.');
            return redirect()->to(base_url('/login'));
        }
    }

    public function registerView()
    {
        return view("auth/v_register");
    }

    public function registerStore()
    {
        helper(['form']);

        $rules = [
            'username' => 'required|min_length[2]|max_length[50]|is_unique[members.username]',
            'full_name' => 'required|min_length[2]|max_length[50]',
            'password_hash' => 'required|min_length[3]|max_length[50]',
        ];

        if ($this->validate($rules)) {
            $data = [
                'username' => $this->request->getVar('username'),
                'full_name' => $this->request->getVar('full_name'),
                'password_hash' => password_hash($this->request->getVar('password_hash'), PASSWORD_DEFAULT),
                'role' => 'admin',
            ];

            $this->memberModel->save($data);
            session()->setFlashdata('success', 'Registration Successfully.');
            return redirect()->to(base_url("/login"));
        } else {
            return redirect()
                ->to(base_url('/register'))
                ->withInput()
                ->with('validation', $this->validator)
                ->with('failed', 'Please check the form and correct the errors.');
        }
    }

    function logout()
    {
        $session = session();
        $session->set(array(
            'user_id' => '',
            'user_name' => '',
            'email' => '',
            'role' => '',
            'is_logged_in' => FALSE
        ));
        $session->destroy();
        return redirect()->to(base_url('/login'));
    }
}
