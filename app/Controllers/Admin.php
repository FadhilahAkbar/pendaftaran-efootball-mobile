<?php

namespace App\Controllers;

use App\Models\TournamentModel;
use App\Models\TeamModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function index()
    {
        // Menampilkan halaman form tambah turnamen
        return view('admin/create_tournament');
    }

    public function store()
    {
        
        //panggil model tournament 
        $tournamentModel = new TournamentModel();


        // ambil data yang diketik admin di formulir
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
            'max_slots'   => $this->request->getPost('max_slots'),
            'quota'       => $this->request->getPost('quota'),
            'rules'       => $this->request->getPost('rules')
        ];


        // simpan ke database
        $tournamentModel->save($data);


        // kembalikan ke view home
        return redirect()->to('/');
    }

    public function teams($tournament_id)
    {
        $tournamentModel = new TournamentModel();
        $teamModel       = new TeamModel();

        $data['turnamen'] = $tournamentModel->find($tournament_id);
        
        // Hapus users.whatsapp dari baris select ini
        $data['teams'] = $teamModel->select('teams.*, users.name as player_name')
                                   ->join('users', 'users.id = teams.user_id')
                                   ->where('tournament_id', $tournament_id)
                                   ->findAll();

        return view('admin/teams', $data);
    }

    public function updateStatus($team_id, $status)
    {
        $teamModel = new TeamModel();
        
        // Ubah status tim menjadi 'approved' atau 'rejected'
        $teamModel->update($team_id, ['status' => $status]);
        
        session()->setFlashdata('success', 'Status tim berhasil diperbarui!');
        return redirect()->back(); // Kembalikan ke halaman sebelumnya
    }

    public function updateTournamentStatus($id)
    {
        $tournamentModel = new TournamentModel();
        
        // Ambil status baru yang dipilih admin dari dropdown
        $status_baru = $this->request->getPost('status');
        
        // Update tabel turnamen
        $tournamentModel->update($id, ['status' => $status_baru]);
        
        session()->setFlashdata('success', 'Status turnamen berhasil diubah!');
        return redirect()->back();
    }

    public function edit($id)
    {
        $tournamentModel = new TournamentModel();
        $data['turnamen'] = $tournamentModel->find($id);
        
        return view('admin/edit_tournament', $data);
    }

    public function update($id)
    {
        $tournamentModel = new TournamentModel();
        
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
            'max_slots'   => $this->request->getPost('max_slots'),
            'quota'   => $this->request->getPost('quota'),
            'rules' => $this->request->getPost('rules'),
        ];

        $tournamentModel->update($id, $data);
        
        session()->setFlashdata('success', 'Turnamen berhasil diperbarui!');
        return redirect()->to('/');
    }

    public function delete($id)
    {
        $tournamentModel = new TournamentModel();
        
        // Opsional: Hapus juga tim yang terdaftar di turnamen ini agar database bersih
        $teamModel = new \App\Models\TeamModel();
        $teamModel->where('tournament_id', $id)->delete();
        
        $tournamentModel->delete($id);
        
        session()->setFlashdata('success', 'Turnamen berhasil dihapus!');
        return redirect()->to('/');
    }
}
