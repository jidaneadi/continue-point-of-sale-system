<?php

namespace Database\Seeders;

use App\Models\PhotoSession;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductHasPhotoSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeed extends Seeder
{
    public function run(): void
    {
        $photoSessions = PhotoSession::get();
        $productCategories = ProductCategory::get();
        $products = [
            [
                'product_category_id' => $productCategories[0]->id,
                'name' => 'Graduation Bronze',
                'type' => 1,
                'description' => '1 Background Set, 5 Pose dan 5 File Edit, 5 Print Foto, Maksimal 6 Orang, File Kirim Gdrive',
                'price' => 315000,
                'photo' => 'images/product/grad_bronze.jpg',
            ],
            [
                'product_category_id' => $productCategories[0]->id,
                'name' => 'Graduation Gold',
                'type' => 1,
                'description' => '2 Background Set, 7 Pose dan File Edit, 7 Print Foto, Maksimal 10 orang, File Kirim GDrive',
                'price' => 399000,
                'photo' => 'images/product/grad_gold.jpg',
            ],
            [
                'product_category_id' => $productCategories[0]->id,
                'name' => 'Graduation Platinum',
                'type' => 1,
                'description' => '2 Background Set, 10 Pose dan File Edit, 10 Print Foto, Maksimal 12 Orang, File Kirim GDrive',
                'price' => 770000,
                'photo' => 'images/product/grad_platinum.jpg',
            ],
            [
                'product_category_id' => $productCategories[1]->id,
                'name' => 'Prewedding Bronze',
                'type' => 1,
                'description' => '1 Lokasi, 20 Edit Foto, File Original GDrive',
                'price' => 500000,
                'photo' => 'images/product/prewed_bronze.jpg',
            ],
            [
                'product_category_id' => $productCategories[1]->id,
                'name' => 'Prewedding Gold',
                'type' => 1,
                'description' => '2 Lokasi, 25 Edit Foto, File Original GDrive',
                'price' => 800000,
                'photo' => 'images/product/prewed_gold.jpg',
            ],
            [
                'product_category_id' => $productCategories[1]->id,
                'name' => 'Prewedding Platinum',
                'type' => 1,
                'description' => '3 Lokasi, 50 Edit Foto, Video Behind the Scene, File Original GDrive',
                'price' => 950000,
                'photo' => 'images/product/prewed_platinum.jpg',
            ],
            [
                'product_category_id' => $productCategories[1]->id,
                'name' => 'Wedding Bronze',
                'type' => 1,
                'description' => '200 Foto Edit, 1 Album (20 Halaman), Semua Foto Flashdisk dan GDrive',
                'price' => 5000000,
                'photo' => 'images/product/wedding_bronze.jpg',
            ],
            [
                'product_category_id' => $productCategories[1]->id,
                'name' => 'Wedding Gold',
                'type' => 1,
                'description' => '300 Foto Edit, 1 Album (30 Halaman), Semua Foto Flashdisk dan GDrive, 1 Print Foto (Ukuran 50x75 cm)',
                'price' => 8000000,
                'photo' => 'images/product/wedding_gold.jpg',
            ],
            [
                'product_category_id' => $productCategories[1]->id,
                'name' => 'Wedding Platinum',
                'type' => 1,
                'description' => '500 Foto Edit, 2 Album (40 Halaman), Semua Foto dan Video Flashdisk dan GDrive, 2 Print Foto (ukuran 50x75 cm), Video Highlight 5 Menit',
                'price' => 15000000,
                'photo' => 'images/product/wedding_platinum.jpg',
            ],
            [
                'product_category_id' => $productCategories[2]->id,
                'name' => 'Family Bronze',
                'type' => 1,
                'description' => '1 Background Set, 3 Pose dan Edit, 3 Print Foto, File Kirim Email, Maksimal 12 Orang',
                'price' => 315000,
                'photo' => 'images/product/group_bronze.jpg',
            ],
            [
                'product_category_id' => $productCategories[2]->id,
                'name' => 'Family Gold',
                'type' => 1,
                'description' => '2 Background, 6 Pose dan Edit, 6 Print Foto, File Kirim Email, Maksimal 12 Orang',
                'price' => 399000,
                'photo' => 'images/product/group_gold.jpg',
            ],
            [
                'product_category_id' => $productCategories[2]->id,
                'name' => 'Family Platinum',
                'type' => 1,
                'description' => '2 Background Set, 10 Pose dan Edit, 1O Print Foto, File Kirim Email, Maksimal 12 Orang',
                'price' => 550000,
                'photo' => 'images/product/group_platinum.jpg',
            ],
            [
                'product_category_id' => $productCategories[3]->id,
                'name' => 'Food dan Product Studio',
                'type' => 1,
                'description' => '1 File Edit, 1 Foto Angle, File Kirim Email',
                'price' => 29000,
                'photo' => 'images/product/food_studio.jpg',
            ],
            [
                'product_category_id' => $productCategories[3]->id,
                'name' => 'Food dan Product Studio Detail',
                'type' => 1,
                'description' => '2 File Edit, 2 Foto Angle, File Kirim Email',
                'price' => 29000,
                'photo' => 'images/product/food_studiodetail.jpg',
            ],
            [
                'product_category_id' => $productCategories[3]->id,
                'name' => 'Food dan Product Outside',
                'type' => 1,
                'description' => '3 File Edit, 3 Foto Angle, File Kirim Email',
                'price' => 59000,
                'photo' => 'images/product/food_outside.jpg',
            ],
            [
                'product_category_id' => $productCategories[4]->id,
                'name' => 'Maternity Studio',
                'type' => 1,
                'description' => '2 Background, 6 File Edit, 6 Print Foto, File Kirim Email',
                'price' => 390000,
                'photo' => 'images/product/maternitiy_studio.jpg',
            ],
            [
                'product_category_id' => $productCategories[4]->id,
                'name' => 'Maternity Outside',
                'type' => 1,
                'description' => '2 Background, 10 File Edit, 6 Print Foto, Semua Original File, File Kirim Email',
                'price' => 690000,
                'photo' => 'images/product/maternity_outside.jpg',
            ],
            [
                'product_category_id' => $productCategories[4]->id,
                'name' => 'Newborn Studio',
                'type' => 1,
                'description' => '2 Background, 6 File Edit, 6 Print Foto, File Kirim Email',
                'price' => 390000,
                'photo' => 'images/product/newborn_studio.jpeg',
            ],
            [
                'product_category_id' => $productCategories[4]->id,
                'name' => 'Newborn Outside',
                'type' => 1,
                'description' => '2 Background, 10 File Edit, 6 Print Foto, Semua Original File, File Kirim Email',
                'price' => 690000,
                'photo' => 'images/product/newborn_outside.jpeg',
            ],
            [
                'product_category_id' => $productCategories[5]->id,
                'name' => 'Rental Studio 1 Jam',
                'type' => 1,
                'description' => '3 Pilihan Background Studio, 4 Lighting Godox, 1 Set Softbox, 4 Lighstand, 1 Set Trigger',
                'price' => 150000,
                'photo' => 'images/product/rent_1jam.jpg',
            ],
            [
                'product_category_id' => $productCategories[5]->id,
                'name' => 'Rental Studio 2 Jam',
                'type' => 1,
                'description' => '7 Pilihan Background Studio, 4 Lighting Godox, 1 Set Softbox, 4 Lighstand, 1 Set Trigger',
                'price' => 250000,
                'photo' => 'images/product/rent_2jam.jpg',
            ],
        ];

        foreach ($products as $p) {
            $createProducts = Product::firstOrCreate([
                'product_category_id' => $p['product_category_id'],
                'name' => $p['name'],
                'type' => $p['type'],
                'description' => $p['description'],
                'price' => $p['price'],
                'photo' => $p['photo'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // foreach ($photoSessions as $ps) {
            //     dd("ID UUI Product : ",$createProducts->id ," ID Category Product For Create Products : ",$createProducts->product_category_id, " ID Category Product : 4-",$productCategories[3]->id," - 5-", $productCategories[4]->id);
            //     if ($createProducts->product_category_id == $productCategories[3]->id  || $createProducts->product_category_id == $productCategories[4]->id) {
            //         ProductHasPhotoSession::create([
            //             'product_id' => $createProducts->id,
            //             'photo_session_id' => $ps->id,
            //         ]);
            //     }
            //     if (($createProducts->product_category_id != $productCategories[1] || $createProducts->product_category_id == $productCategories[3]->id || $createProducts->product_category_id == $productCategories[4]->id) && $ps->name != 'Outdoor Session 01') {
            //         ProductHasPhotoSession::create([
            //             'product_id' => $createProducts->id,
            //             'photo_session_id' => $ps->id,
            //         ]);
            //     }
            //     ProductHasPhotoSession::create([
            //         'product_id' => $createProducts->id,
            //         'photo_session_id' => $ps->id,
            //     ]);
            // }
        }
    }
}
