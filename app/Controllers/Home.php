<?php

namespace App\Controllers;

// Panggil Model yang akan kita gunakan
use App\Models\TournamentModel;

class Home extends BaseController
{
    public function index()
    {
        // 1. Inisiasi Model
        $tournamentModel = new TournamentModel();

        // 2. Ambil semua data turnamen dari database
        // dan simpan ke dalam variabel (array) bernama $data
        $data = [
            'tournaments' => $tournamentModel->findAll()
        ];

        // 3. Kirim $data tersebut ke tampilan (View) bernama 'home'
        return view('home', $data);
    }
}