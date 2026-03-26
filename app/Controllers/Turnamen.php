<?php

namespace App\Controllers;

use App\Models\TournamentModel;
use App\Models\TeamModel;

class Turnamen extends BaseController
{
    public function daftar($id)
    {
        // 1. Cek apakah pengguna sudah login? Kalau belum, suruh login dulu!
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu untuk mendaftar turnamen.');
            return redirect()->to('/login');
        }

        // 2. Ambil data turnamen berdasarkan ID yang diklik
        $tournamentModel = new TournamentModel();
        $data['turnamen'] = $tournamentModel->find($id);

        // 3. Tampilkan halaman form pendaftaran
        return view('turnamen/daftar', $data);
    }

    public function simpan()
    {
        $teamModel = new TeamModel();

        // Ambil data dari form dan dari session (Gelang VIP)
        $data = [
            'user_id'       => session()->get('user_id'), // ID pemain yang sedang login
            'tournament_id' => $this->request->getPost('tournament_id'), // ID turnamen yang diikuti
            'team_name'     => $this->request->getPost('team_name'), // Nama tim yang diketik
            'status'        => 'pending' // Status awal selalu pending
        ];

        // Simpan ke tabel teams
        $teamModel->save($data);

        // Beri pesan sukses dan kembalikan ke beranda
        session()->setFlashdata('success', 'Tim kamu berhasil didaftarkan! Menunggu persetujuan Admin.');
        return redirect()->to('/');
    }

    public function timSaya() {
        // 1. Pastikan yang mengakses sudah login
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu.');
            return redirect()->to('/login');
        }

        $teamModel = new TeamModel();
        $userId    = session()->get('user_id');

        // 2. Ambil data tim milik pemain ini, gabungkan dengan tabel turnamen untuk ambil nama turnamennya
        $data['my_teams'] = $teamModel->select('teams.*, tournaments.name as turnamen_name')
                                      ->join('tournaments', 'tournaments.id = teams.tournament_id')
                                      ->where('teams.user_id', $userId)
                                      ->orderBy('teams.id', 'DESC') // Urutkan dari yang terbaru
                                      ->findAll();

        return view('turnamen/tim_saya', $data);
    }

    public function bagan($id)
    {
        $tournamentModel = new TournamentModel();
        $teamModel       = new TeamModel();

        $data['turnamen'] = $tournamentModel->find($id);
        
        // Ambil HANYA tim yang statusnya 'approved' (disetujui admin)
        $data['approved_teams'] = $teamModel->where('tournament_id', $id)
                                            ->where('status', 'approved')
                                            ->findAll();

        return view('turnamen/bagan', $data);
    }
}