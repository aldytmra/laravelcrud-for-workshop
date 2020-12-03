<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'nama' => 'RAM VGEN 16GB',
            'deskripsi' => 'Ini adalah ram terbaik',
            'berat' => '1kg',
            'harga' => 500000,
            'foto' => 'testing.jpg'
        ]);

        \App\Models\Product::factory(10)->create();
    }
}
