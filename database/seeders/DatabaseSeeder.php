<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Isi User Admin
        DB::table('users')->insert([
            'name' => 'Admin Gudang',
            'email' => 'admin@wms.com',
            'password' => Hash::make('password123'),
        ]);

        // 2. Isi Kategori
        DB::table('categories')->insert([
            ['name' => 'Elektronik'],
            ['name' => 'Perabotan'],
        ]);

        // 3. Isi Supplier
        $supplierId = DB::table('suppliers')->insertGetId([
            'name' => 'PT Sumber Tekno', 
            'phone' => '08123456789'
        ]);

        // 4. Isi Produk (Sudah ditambah kolom price)
        DB::table('products')->insert([
            [
                'name' => 'Laptop Asus TUF', 
                'sku' => 'LAP-001', 
                'stock' => 50, 
                'price' => 15000000, 
                'category_id' => 1, 
                'supplier_id' => $supplierId
            ],
            [
                'name' => 'Meja Kerja', 
                'sku' => 'MEJ-001', 
                'stock' => 20, 
                'price' => 500000, 
                'category_id' => 2, 
                'supplier_id' => $supplierId
            ],
        ]);
    }
}