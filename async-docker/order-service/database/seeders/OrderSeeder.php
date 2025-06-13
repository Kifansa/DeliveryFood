<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'user_id' => 1,
            'menu_item_id' => 1,
            'quantity' => 2,
            'status' => 'pending',
        ]);

        Order::create([
            'user_id' => 2,
            'menu_item_id' => 2,
            'quantity' => 1,
            'status' => 'confirmed',
        ]);

        Order::create([
            'user_id' => 3,
            'menu_item_id' => 3,
            'quantity' => 3,
            'status' => 'shipped',
        ]);
    }
}
