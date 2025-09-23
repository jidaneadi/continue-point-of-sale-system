<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeed extends Seeder
{
    public function run(): void
    {
        function createProduct($id_category, $name, $type, $desc, $price, $photo)
        {
            $products = Product::create([
                'product_category_id' => $id_category,
                'name' => $name,
                'type' => $type,
                'description' => $desc,
                'price' => $price,
                'photo' => $photo,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return $products;
        }
        createProduct('0197a4be-d745-733a-9155-be20d8d518f1', 'Graduation Bronze', 1, '1 Background Set, 5 Pose dan 5 File Edit, 5 Print Foto, Maksimal 6 Orang, File Kirim Gdrive', 315000, '');
        createProduct('0197a4be-d745-733a-9155-be20d8d518f1', 'Graduation Gold', 1, '2 Background Set, 7 Pose dan File Edit, 7 Print Foto, Maksimal 10 orang, File Kirim GDrive', 399000, '');
        createProduct('0197a4be-d745-733a-9155-be20d8d518f1', 'Graduation Platinum', 1, '2 Background Set, 10 Pose dan File Edit, 10 Print Foto, Maksimal 12 Orang, File Kirim GDrive', 770000, '');

        createProduct('0197a4be-d748-70fe-937b-575b443d0113', 'Prewedding Bronze', 1, '1 Lokasi, 20 Edit Foto, File Original GDrive', 500000, '');
        createProduct('0197a4be-d748-70fe-937b-575b443d0113', 'Prewedding Gold', 1, '2 Lokasi, 25 Edit Foto, File Original GDrive', 800000, '');
        createProduct('0197a4be-d748-70fe-937b-575b443d0113', 'Prewedding Platinum', 1, '3 Lokasi, 50 Edit Foto, Video Behind the Scene, File Original GDrive', 950000, '');
        createProduct('0197a4be-d748-70fe-937b-575b443d0113', 'Wedding Bronze', 1, '200 Foto Edit, 1 Album (20 Halaman), Semua Foto Flashdisk dan GDrive', 5000000, '');
        createProduct('0197a4be-d748-70fe-937b-575b443d0113', 'Wedding Gold', 1, '300 Foto Edit, 1 Album (30 Halaman), Semua Foto Flashdisk dan GDrive, 1 Print Foto (Ukuran 50x75 cm)', 8000000, '');
        createProduct('0197a4be-d748-70fe-937b-575b443d0113', 'Wedding Platinum', 1, '500 Foto Edit, 2 Album (40 Halaman), Semua Foto dan Video Flashdisk dan GDrive, 2 Print Foto (ukuran 50x75 cm), Video Highlight 5 Menit', 15000000, '');
        createProduct('0197a4be-d74b-7218-a2f5-9f3bcd41c4a1', 'Family Bronze', 1, '1 Background Set, 3 Pose dan Edit, 3 Print Foto, File Kirim Email, Maksimal 12 Orang', 315000, '');
        createProduct('0197a4be-d74b-7218-a2f5-9f3bcd41c4a1', 'Family Gold', 1, '2 Background, 6 Pose dan Edit, 6 Print Foto, File Kirim Email, Maksimal 12 Orang', 399000, '');
        createProduct('0197a4be-d74b-7218-a2f5-9f3bcd41c4a1', 'Family Platinum', 1, '2 Background Set, 10 Pose dan Edit, 1O Print Foto, File Kirim Email, Maksimal 12 Orang', 550000, '');
        createProduct('0197a4be-d74d-73ba-9c53-6534ddaab3f4', 'Food dan Product Studio', 1, '1 File Edit, 1 Foto Angle, File Kirim Email', 29000, '');
        createProduct('0197a4be-d74d-73ba-9c53-6534ddaab3f4', 'Food dan Product Studio Detail', 1, '2 File Edit, 2 Foto Angle, File Kirim Email', 29000, '');
        createProduct('0197a4be-d74d-73ba-9c53-6534ddaab3f4', 'Food dan Product Outside', 1, '3 File Edit, 3 Foto Angle, File Kirim Email', 59000, 'outside_food.jpg');
        createProduct('0197a4be-d750-736c-a601-0294199cc98c', 'Maternity Studio', 1, '2 Background, 6 File Edit, 6 Print Foto, File Kirim Email', 390000, 'maternity_studio.jpg');
        createProduct('0197a4be-d750-736c-a601-0294199cc98c', 'Maternity Outside', 1, '2 Background, 10 File Edit, 6 Print Foto, Semua Original File, File Kirim Email', 690000, 'maternity_outside.jpg');
        createProduct('0197a4be-d750-736c-a601-0294199cc98c', 'Newborn Studio', 1, '2 Background, 6 File Edit, 6 Print Foto, File Kirim Email', 390000, 'newborn_studio.jpg');
        createProduct('0197a4be-d750-736c-a601-0294199cc98c', 'Newborn Outside', 1, '2 Background, 10 File Edit, 6 Print Foto, Semua Original File, File Kirim Email', 690000, 'newborn_outside.jpg');
        createProduct('0197a4be-d753-725c-968b-ab78ca14bc37', 'Rental Studio 1 Jam', 1, '3 Pilihan Background Studio, 4 Lighting Godox, 1 Set Softbox, 4 Lighstand, 1 Set Trigger', 150000, 'background_options.jpg');
        createProduct('0197a4be-d753-725c-968b-ab78ca14bc37', 'Rental Studio 2 Jam', 1, '7 Pilihan Background Studio, 4 Lighting Godox, 1 Set Softbox, 4 Lighstand, 1 Set Trigger', 250000, 'background_options');
    }
}
