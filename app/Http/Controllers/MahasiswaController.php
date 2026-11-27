<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    //
    public function index()
    {
        $mahasiswa = [
            'nim' => '251011700264',
            'nama' => 'Muhammad zhafkaviandra bastyan',
            'prodi' => 'Sistem Informasi',
            'kampus' => 'Universitas Pamulang',
            'email' => 'zhafkaviandra@gmail.com',
            'status' => 'Aktif',
        ];
        return view('page.profile', compact('mahasiswa'));
    }
}
