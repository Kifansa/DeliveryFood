<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Delivery;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Delivery::create([
            'order_id' => 1,
            'status' => 'shipped',
            'delivery_address' => 'Jl. Patimura No. 1, Jakarta',
            'delivery_date' => '2025-06-12',
        ]);

        Delivery::create([
            'order_id' => 2,
            'status' => 'pending',
            'delivery_address' => 'Jl. Kebon Jeruk No. 5, Bandung',
            'delivery_date' => '2025-06-15',
        ]);

        Delivery::create([
            'order_id' => 3,
            'status' => 'delivered',
            'delivery_address' => 'Jl. Merdeka No. 10, Surabaya', 
            'delivery_date' => '2025-06-10',
        ]);
    }
}
