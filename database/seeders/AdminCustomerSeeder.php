<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;


class AdminCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Customer::create([
            'user_id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
}
