<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

    public function processRegister()
    {
        $rules = [
            'name'      => 'required',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'password'  => 'required'
        ];

        $messages = [
            'email' => [
                'is_unique' => 'Maaf, Email Ini Sudah Terdaftar. Silakan Gunakan Email Lain'
            ]
        ];

        if (!$this->validate($rules,$messages)) {
            return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
        }


        $userModel = new UserModel();
        
        // Mengambil data dari form dan mengenkripsi password
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role'     => 'player' // Otomatis menjadi pemain biasa
        ];
        
        $userModel->save($data);
        
        // Simpan pesan sukses dan arahkan ke halaman login
        session()->setFlashdata('success', 'Akun berhasil dibuat! Silakan login.');
        return redirect()->to('/login');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $userModel = new UserModel();
        $email     = $this->request->getPost('email');
        $password  = $this->request->getPost('password');
        
        $user = $userModel->where('email', $email)->first();
        
        if ($user) {
            // Cek apakah ketikan form SAMA PERSIS dengan teks di database
            if ($password === $user['password']) { // <- Ubah baris ini
                
                session()->set([
                    'user_id'   => $user['id'],
                    'user_name' => $user['name'],
                    'user_role' => $user['role'],
                    'logged_in' => TRUE
                ]);
                return redirect()->to('/'); 
            } else {
                session()->setFlashdata('error', 'Password salah!');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('error', 'Email tidak ditemukan!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy(); // Hancurkan session / KTP sementara
        return redirect()->to('/login');
    }
}