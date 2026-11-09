<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Ruang Kelas',
            'Toilet',
            'Laboratorium',
            'Lapangan',
        ];

        foreach ($categories as $nama) {
            Category::firstOrCreate([
                'nama' => $nama,
            ]);
        }
    }
}
