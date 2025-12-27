<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MedicineCategory;
use App\Models\Supplier;
use App\Models\Medicine;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@apotek.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Kasir User',
            'email' => 'kasir@apotek.com',
            'password' => bcrypt('password'),
            'role' => 'staff',
        ]);

        // Create medicine categories
        $categories = [
            ['name' => 'Obat Sakit Kepala', 'slug' => 'obat-sakit-kepala'],
            ['name' => 'Obat Demam', 'slug' => 'obat-demam'],
            ['name' => 'Obat Maag', 'slug' => 'obat-maag'],
            ['name' => 'Vitamin', 'slug' => 'vitamin'],
        ];

        foreach ($categories as $cat) {
            MedicineCategory::create($cat);
        }

        // Create suppliers
        $suppliers = [
            [
                'name' => 'PT Kimia Pharma',
                'contact_person' => 'Budi Santoso',
                'phone' => '021-1234567',
                'email' => 'sales@kimiapharma.com',
                'address' => 'Jakarta Pusat',
            ],
            [
                'name' => 'Supplier Medan Jaya',
                'contact_person' => 'Siti Nurhaliza',
                'phone' => '061-9876543',
                'email' => 'info@medanjaya.com',
                'address' => 'Medan',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }

        // Create medicines
        $medicines = [
            [
                'code' => 'M001',
                'name' => 'Paracetamol 500mg',
                'medicine_category_id' => 1,
                'unit' => 'Box',
                'price_purchase' => 10000,
                'price_sale' => 15000,
                'stock' => 50,
                'min_stock' => 10,
                'description' => 'Obat demam dan sakit kepala',
            ],
            [
                'code' => 'M002',
                'name' => 'Ibuprofen 400mg',
                'medicine_category_id' => 1,
                'unit' => 'Box',
                'price_purchase' => 12000,
                'price_sale' => 18000,
                'stock' => 40,
                'min_stock' => 8,
                'description' => 'Analgesik dan antiinflamasi',
            ],
            [
                'code' => 'M003',
                'name' => 'Paracetamol Sirup',
                'medicine_category_id' => 2,
                'unit' => 'Botol',
                'price_purchase' => 15000,
                'price_sale' => 22000,
                'stock' => 30,
                'min_stock' => 5,
                'description' => 'Sirup demam untuk anak-anak',
            ],
            [
                'code' => 'M004',
                'name' => 'Obat Maag Lambucin',
                'medicine_category_id' => 3,
                'unit' => 'Box',
                'price_purchase' => 18000,
                'price_sale' => 25000,
                'stock' => 35,
                'min_stock' => 7,
                'description' => 'Obat maag dan asam lambung',
            ],
            [
                'code' => 'M005',
                'name' => 'Vitamin C 500mg',
                'medicine_category_id' => 4,
                'unit' => 'Box',
                'price_purchase' => 8000,
                'price_sale' => 12000,
                'stock' => 100,
                'min_stock' => 20,
                'description' => 'Vitamin C untuk imunitas',
            ],
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }
    }
}
