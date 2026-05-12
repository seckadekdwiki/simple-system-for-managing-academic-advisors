<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Dosen
        $dosens = [
            [
                'nama' => 'Dr. Budi Santoso, S.Kom., M.Sc.',
                'nip' => '197501121999031001',
                'keahlian' => 'Sistem Basis Data',
            ],
            [
                'nama' => 'Prof. Siti Nurhaliza, S.T., M.T., Ph.D.',
                'nip' => '196812051992032001',
                'keahlian' => 'Kecerdasan Buatan & Machine Learning',
            ],
            [
                'nama' => 'Drs. Ahmad Riyanto, M.Kom.',
                'nip' => '198203141998021001',
                'keahlian' => 'Web Development & Cloud Computing',
            ],
            [
                'nama' => 'Ir. Dewi Lestari, M.Eng.',
                'nip' => '197910052001032002',
                'keahlian' => 'Jaringan Komputer & Cybersecurity',
            ],
            [
                'nama' => 'Dr. Rudi Hermawan, S.Kom., M.Cs.',
                'nip' => '198507162003121001',
                'keahlian' => 'Software Engineering & DevOps',
            ],
        ];

        foreach ($dosens as $dosen) {
            Dosen::create($dosen);
        }

        // Seed Mahasiswa with relations to Dosen
        $mahasiswas = [
            [
                'nama' => 'Muhammad Rizki Fauzi',
                'nim' => '2024001001',
                'jurusan' => 'Sistem Informasi',
                'dosen_id' => 1,
            ],
            [
                'nama' => 'Siti Nur Azizah',
                'nim' => '2024001002',
                'jurusan' => 'Sistem Informasi',
                'dosen_id' => 2,
            ],
            [
                'nama' => 'Adi Pratama',
                'nim' => '2024001003',
                'jurusan' => 'Sistem Informasi',
                'dosen_id' => 1,
            ],
            [
                'nama' => 'Indah Kusuma Dewi',
                'nim' => '2024001004',
                'jurusan' => 'Sistem Informasi',
                'dosen_id' => 3,
            ],
            [
                'nama' => 'Bambang Kurniawan',
                'nim' => '2024001005',
                'jurusan' => 'Sistem Informasi',
                'dosen_id' => 4,
            ],
            [
                'nama' => 'Nanda Putri Ramadani',
                'nim' => '2024001006',
                'jurusan' => 'Sistem Informasi',
                'dosen_id' => 5,
            ],
            [
                'nama' => 'Yusuf Hidayatullah',
                'nim' => '2024001007',
                'jurusan' => 'Sistem Informasi',
                'dosen_id' => 2,
            ],
            [
                'nama' => 'Rahma Arifah Putri',
                'nim' => '2024001008',
                'jurusan' => 'Sistem Informasi',
                'dosen_id' => 3,
            ],
        ];

        foreach ($mahasiswas as $mahasiswa) {
            Mahasiswa::create($mahasiswa);
        }
    }
