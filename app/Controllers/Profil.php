<?php

namespace App\Controllers;
use App\Models\UserModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Profil extends BaseController
{
    public function index()
    {
        // Pastikan user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userModel = new UserModel();
        $userId = session()->get('user_id');

        $data = [
            'user' => $userModel->find($userId)
        ];

        return view('user/profil', $data);
    }

    public function updateProfil()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id');

        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email')
        ];

        $userModel->update($userId, $data);

        // Update session nama agar di header langsung berubah
        session()->set('user_name', $data['name']);

        return redirect()->to('/profil')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id');
        $user = $userModel->find($userId);

        $oldPassword = (string) $this->request->getPost('old_password');
        $newPassword = (string) $this->request->getPost('new_password');

        // Cek password lama (Karena plain text, kita cek langsung teksnya)
        if ($oldPassword !== $user['password']) {
            return redirect()->to('/profil')->with('error', 'Password lama salah!');
        }

        // Simpan password baru (Disimpan sebagai plain text juga)
        $userModel->update($userId, [
            'password' => $newPassword
        ]);

        return redirect()->to('/profil')->with('success', 'Password berhasil diubah!');
    }
}
