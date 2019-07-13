<?php

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            [
                'name' => 'Admin',
                'email' => 'dev@port.mv',
                'password' => \Hash::make('password'),
                'is_seller' => 1,
                'contact_number' => '9999999',
                'wallet_balance' => 0,
            ],[
                'name' => 'Adam Dawood',
                'email' => 'adam.dawood@port.mv',
                'password' => \Hash::make('password'),
                'is_seller' => 0,
                'contact_number' => '9128363',
                'wallet_balance' => 0,
            ],[
                'name' => 'Mamdhooh Mohamed',
                'email' => 'mamdhooh@port.mv',
                'password' => \Hash::make('password'),
                'is_seller' => 1,
                'contact_number' => '7827570',
                'wallet_balance' => 0,
            ],
        ]);

        \App\Models\Category::insert([
            [
                'name' => 'Reef Fish',
            ],
        ]);

        \App\Models\Product::insert([
            [
                'name' => 'Red Snapper',
                'category_id' => 1,
            ]
        ]);

//        \App\Models\ProductName::create([
//            [
//                'name' => 'Raiy Mas',
//                'product_id' => 1
//            ]
//        ]);
    }
}
