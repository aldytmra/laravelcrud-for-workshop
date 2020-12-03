<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'first_name' => 'Aldy',
            'last_name' => 'Tamara',
            'address' => 'buaran',
            'foto' => 'testing.jpg'
        ]);

        \App\Models\Customer::factory(10)->create();
    }
}
