<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sekolah.test'],
            [
                'name' => 'Administrator',
                'password' => 'admin123',
                'role' => 'admin',
                'nis' => null,
                'kelas' => null,
            ]
        );

        User::updateOrCreate(
            ['email' => 'siswa@sekolah.test'],
            [
                'name' => 'Siswa Contoh',
                'password' => '123456',
                'role' => 'siswa',
                'nis' => '12345',
                'kelas' => 'XII RPL 1',
            ]
        );
    }
}