<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $model = new UserModel();

        $data = [
            'title' => 'Daftar User',
            'users' => $model->findAll()
        ];

        return view('user/index', $data);
    }

    public function login()
    {
        helper(['form']);

        // Ambil input
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Kalau belum submit, tampilkan form
        if (!$this->request->is('post')) {
            return view('user/login');
        }

        $session = session();
        $model = new UserModel();

        // Cari user berdasarkan email
        $user = $model->where('useremail', $email)->first();

        if (!$user) {
            $session->setFlashdata('flash_msg', 'Email tidak terdaftar.');
            return redirect()->to('/user/login');
        }

        // Cek password
        if (!password_verify($password, $user['userpassword'])) {
            $session->setFlashdata('flash_msg', 'Password salah.');
            return redirect()->to('/user/login');
        }

        // Set session kalau login berhasil
        $session->set([
            'user_id'     => $user['id'],
            'user_name'   => $user['username'],
            'user_email'  => $user['useremail'],
            'logged_in'   => true,
        ]);

        return redirect()->to('/admin/artikel');
    }
}