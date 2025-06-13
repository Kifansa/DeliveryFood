<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'order_id' => 1,
            'amount' => 50000,
            'status' => 'paid',
        ]);

        Payment::create([
            'order_id' => 2,
            'amount' => 30000,
            'status' => 'pending',
        ]);

        Payment::create([
            'order_id' => 3,
            'amount' => 15000,
            'status' => 'paid',
        ]);
    }
}
