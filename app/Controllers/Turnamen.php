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
        $tournamentModel = new TournamentModel();

        $userId = session()->get('user_id'); // ID pemain yang sedang login
        $tournamentId = $this->request->getPost('tournament_id'); // ID turnamen dari form

        // --- 1. PROSES SATPAM (PENGECEKAN BATAS SLOT) ---
        $turnamen = $tournamentModel->find($tournamentId);
        $batas_slot = $turnamen['max_slots'] ?? 1; // Default 1 jika data kosong

        // Hitung jumlah tim yang sudah didaftarkan user ini di turnamen ini
        $jumlah_terdaftar = $teamModel->where('tournament_id', $tournamentId)
                                      ->where('user_id', $userId)
                                      ->countAllResults();

        // Cek apakah sudah melebihi batas max_slots
        if ($jumlah_terdaftar >= $batas_slot) {
            session()->setFlashdata('error', 'Pendaftaran ditolak! Kamu sudah mencapai batas maksimal (' . $batas_slot . ' Slot) untuk turnamen ini.');
            return redirect()->back(); // Kembalikan ke halaman form
        }
        // -----------------------------------------------

        // --- 2. JIKA LOLOS PENGECEKAN, SIMPAN DATA TIM ---
        $data = [
            'user_id'       => $userId,
            'tournament_id' => $tournamentId,
            'team_name'     => $this->request->getPost('team_name'),
            'status'        => 'pending' 
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

    public function batalDaftar($team_id)
    {
        $teamModel = new TeamModel();
        $tournamentModel = new TournamentModel();

        // 1. Ambil data tim untuk mengecek status turnamennya
        $team = $teamModel->find($team_id);

        if (!$team) {
            return redirect()->back()->with('error', 'Data tim tidak ditemukan.');
        }

        // 2. Keamanan: Pastikan yang menghapus adalah pemilik akun tim tersebut
        if ($team['user_id'] != session()->get('user_id')) {
            return redirect()->back()->with('error', 'Kamu tidak punya akses untuk membatalkan tim ini.');
        }

        // 3. Cek status turnamen. Hanya boleh batal jika status masih 'open' (DIBUKA)
        $turnamen = $tournamentModel->find($team['tournament_id']);
        if ($turnamen['status'] != 'open') {
            return redirect()->back()->with('error', 'Pendaftaran tidak bisa dibatalkan karena turnamen sudah berjalan/selesai.');
        }

        // 4. Proses hapus dari database
        $teamModel->delete($team_id);

        return redirect()->to('/tim-saya')->with('success', 'Pendaftaran tim berhasil dibatalkan.');
    }

}