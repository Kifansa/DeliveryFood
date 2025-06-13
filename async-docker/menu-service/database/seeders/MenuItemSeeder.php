<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuItem::create([
            'name' => 'Nasi Goreng Spesial',
            'description' => 'Nasi goreng dengan telur, ayam, dan sayuran segar.',
            'price' => 25000,
            'category' => 'Makanan Utama',
        ]);

        MenuItem::create([
            'name' => 'Mie Ayam Bakso',
            'description' => 'Mie ayam dengan bakso sapi dan kuah kaldu ayam.',
            'price' => 30000,
            'category' => 'Makanan Utama',
        ]);

        MenuItem::create([
            'name' => 'Es Teh Manis',
            'description' => 'Minuman teh manis yang segar dan menyegarkan.',
            'price' => 5000,
            'category' => 'Minuman',
        ]);

        MenuItem::create([
            'name' => 'Sate Ayam',
            'description' => 'Sate ayam dengan bumbu kacang yang lezat.',
            'price' => 20000,
            'category' => 'Makanan Pembuka',
        ]);
    }
}
