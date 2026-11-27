<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $projects = [
            [
                'title' => 'Sistem Informasi Akademik',
                'description' => 'Aplikasi berbasis web untuk pengelolaan data mahasiswa, jadwal kuliah dan nilai perkuliahan',
                'teknologi' => 'Laravel & bootstrap',
                'images' => 'project1.jpg',
                'status' => 'Selesai',
            ],
            [
                'title' => 'E-Commerce SEO Optimization',
                'description' => 'Aplikasi optimalisasi struktur heading dan indexing halaman web toko online.',
                'teknologi' => 'PHP & Google Search Console',
                'images' => 'project2.jpg',
                'status' => 'Selesai',
            ],
            [
                'title' => 'Redesign Cover & Branding',
                'description' => 'Perancangan elemen grafis personal branding dan desain sampul buku Rekayasa Web.',
                'teknologi' => 'Figma & Canva',
                'images' => 'project3.jpg',
                'status' => 'Selesai',
            ],
            [
                'title' => 'Portal Berita Mahasiswa',
                'description' => 'Platform publikasi artikel dan kegiatan kampus berbasis web interaktif.',
                'teknologi' => 'Laravel & Bootstrap',
                'images' => 'project4.jpg',
                'status' => 'In Progress',
            ],
            [
                'title' => 'Aplikasi E-Perpustakaan',
                'description' => 'Sistem manajemen peminjaman buku digital dan pengarsipan katalog online.',
                'teknologi' => 'CodeIgniter & Bootstrap',
                'images' => 'project5.jpg',
                'status' => 'Selesai',
            ],
            [
                'title' => 'Dashboard Landing Page UMKM',
                'description' => 'Pembuatan profil usaha dan katalog produk lokal berbasis responsif mobile.',
                'teknologi' => 'HTML, CSS, JS & Bootstrap',
                'images' => 'project6.jpg',
                'status' => 'Selesai',
            ],
            [
                'title' => 'Sistem Kasir (POS) Toko',
                'description' => 'Aplikasi pencatatan transaksi penjualan dan manajemen stok barang harian.',
                'teknologi' => 'Java Swing & MySQL',
                'images' => 'project7.jpg',
                'status' => 'Selesai',
            ],
            [
                'title' => 'Audit & Monitoring SEO Web',
                'description' => 'Analisis performa halaman web dan peningkatan lalu lintas pencarian organik.',
                'teknologi' => 'Ahrefs & Google Analytics',
                'images' => 'project8.jpg',
                'status' => 'Selesai',
            ],
            [
                'title' => 'Desain Prototipe Mobile App',
                'description' => 'Perancangan wireframe dan UI kit untuk aplikasi pengingat jadwal kuliah.',
                'teknologi' => 'Figma & Adobe XD',
                'images' => 'project9.jpg',
                'status' => 'In Progress',
            ],
            [
                'title' => 'Sistem Inventaris Kampus',
                'description' => 'Pengelolaan sarana dan prasarana barang inventaris di lingkungan laboratorium.',
                'teknologi' => 'Laravel & Livewire',
                'images' => 'project10.jpg',
                'status' => 'Selesai',
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
