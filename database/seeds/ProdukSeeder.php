<?php

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Iluminate\Support\Str;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produk')->insert(
            [
                'nama_menu' => 'Cappuccino',
                'harga_produk' => 25000,
                'stok' => 50,
                'diskon' => 10,
                'kategori' => 'Minuman',
                'gambar_produk' => 'public/images/cappuccino.jpg',
            ]
        );
        $faker = Faker::create('id_ID');
        $data=[];
        $menuItems = [
            ['nama' => 'Espresso', 'kategori' => 'Minuman', 'harga' => 18000],
            ['nama' => 'Americano', 'kategori' => 'Minuman', 'harga' => 22000],
            ['nama' => 'Latte', 'kategori' => 'Minuman', 'harga' => 25000],
            ['nama' => 'Matcha Latte', 'kategori' => 'Minuman', 'harga' => 28000],
            ['nama' => 'Iced Lemon Tea', 'kategori' => 'Minuman', 'harga' => 18000],
            ['nama' => 'Chocolate Frappe', 'kategori' => 'Minuman', 'harga' => 30000],
            ['nama' => 'Blueberry Muffin', 'kategori' => 'Makanan', 'harga' => 15000],
            ['nama' => 'Croissant', 'kategori' => 'Makanan', 'harga' => 16000],
            ['nama' => 'Red Velvet Cake', 'kategori' => 'Makanan', 'harga' => 30000],
            ['nama' => 'Nasi Goreng Kafe', 'kategori' => 'Makanan', 'harga' => 35000],
            ['nama' => 'Chicken Katsu', 'kategori' => 'Makanan', 'harga' => 38000],
            ['nama' => 'Sandwich Tuna', 'kategori' => 'Makanan', 'harga' => 32000],
            ['nama' => 'Donat Coklat', 'kategori' => 'Makanan', 'harga' => 12000],
            ['nama' => 'Pancake Syrup', 'kategori' => 'Makanan', 'harga' => 25000],
            ['nama' => 'Caesar Salad', 'kategori' => 'Makanan', 'harga' => 28000],
            ['nama' => 'Fruit Smoothie', 'kategori' => 'Minuman', 'harga' => 27000],
            ['nama' => 'Tiramisu', 'kategori' => 'Makanan', 'harga' => 32000],
            ['nama' => 'Caramel Macchiato', 'kategori' => 'Minuman', 'harga' => 29000],
            ['nama' => 'Veggie Wrap', 'kategori' => 'Makanan', 'harga' => 30000],
            ['nama' => 'Iced Mocha', 'kategori' => 'Minuman', 'harga' => 28000],
            ['nama' => 'Banana Bread', 'kategori' => 'Makanan', 'harga' => 20000],
        ];
        foreach ($menuItems as $item) {
            $data[] = [
                'nama_menu'     => $item['nama'],
                'harga_produk'  => $item['harga'],
                'stok'          => $faker->numberBetween(20, 100), // Stok acak antara 20 - 100
                'diskon'        => $faker->randomElement([0, 0, 0, 5, 10, 15]),
                'kategori'      => $item['kategori'],
            ];
        }
        DB::table('produk')->insert($data);
    }
}
