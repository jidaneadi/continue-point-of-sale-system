<?php

namespace Database\Seeders;

use App\Models\PhotoSession;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhotoSessionsSeeder extends Seeder
{
    public function run(): void
    {
        $photoSessions = [
            ['code' => 'IS-01', 'name' => 'Indoor Session 01', 'type' => '1', 'start_time' => '11:00:00', 'end_time' => '12:00:00'],
            ['code' => 'IS-02', 'name' => 'Indoor Session 02', 'type' => '1', 'start_time' => '12:00:00', 'end_time' => '13:00:00'],
            ['code' => 'IS-03', 'name' => 'Indoor Session 03', 'type' => '1', 'start_time' => '13:00:00', 'end_time' => '14:00:00'],
            ['code' => 'IS-04', 'name' => 'Indoor Session 04', 'type' => '1', 'start_time' => '14:00:00', 'end_time' => '15:00:00'],
            ['code' => 'IS-05', 'name' => 'Indoor Session 05', 'type' => '1', 'start_time' => '15:00:00', 'end_time' => '16:00:00'],
            ['code' => 'IS-06', 'name' => 'Indoor Session 06', 'type' => '1', 'start_time' => '16:00:00', 'end_time' => '17:00:00'],
            ['code' => 'IS-07', 'name' => 'Indoor Session 07', 'type' => '1', 'start_time' => '18:00:00', 'end_time' => '19:00:00'],
            ['code' => 'IS-08', 'name' => 'Indoor Session 08', 'type' => '1', 'start_time' => '19:00:00', 'end_time' => '20:00:00'],
            ['code' => 'OS-01', 'name' => 'Outdoor Session 01', 'type' => '0', 'start_time' => '11:00:00', 'end_time' => '20:00:00'],
        ];

        $products = [
            [
                'product_category_id' => '0197a4be-d745-733a-9155-be20d8d518f1',
                'name' => 'Graduation Bronze',
                'type' => 1,
                'description' => '1 Background Set, 5 Pose dan 5 File Edit, 5 Print Foto, Maksimal 6 Orang, File Kirim Gdrive',
                'price' => 315000,
                'photo' => 'images/product/grad_bronze.jpg',
            ],
            [
                'product_category_id' => '0197a4be-d745-733a-9155-be20d8d518f1',
                'name' => 'Graduation Gold',
                'type' => 1,
                'description' => '2 Background Set, 7 Pose dan File Edit, 7 Print Foto, Maksimal 10 orang, File Kirim GDrive',
                'price' => 399000,
                'photo' => 'images/product/grad_gold.jpg',
            ],
            [
                'product_category_id' => '0197a4be-d745-733a-9155-be20d8d518f1',
                'name' => 'Graduation Platinum',
                'type' => 1,
                'description' => '2 Background Set, 10 Pose dan File Edit, 10 Print Foto, Maksimal 12 Orang, File Kirim GDrive',
                'price' => 770000,
                'photo' => 'images/product/grad_platinum.jpg',
            ],
            [
                'product_category_id' => '0197a4be-d748-70fe-937b-575b443d0113',
                'name' => 'Prewedding Bronze',
                'type' => 1,
                'description' => '1 Lokasi, 20 Edit Foto, File Original GDrive',
                'price' => 500000,
                'photo' => 'images/product/prewed_bronze.jpg',
            ],
            [
                'product_category_id' => '0197a4be-d748-70fe-937b-575b443d0113',
                'name' => 'Prewedding Gold',
                'type' => 1,
                'description' => '2 Lokasi, 25 Edit Foto, File Original GDrive',
                'price' => 800000,
                'photo' => 'images/product/prewed_gold.jpg',
            ],
            [
                'product_category_id' => '0197a4be-d748-70fe-937b-575b443d0113',
                'name' => 'Prewedding Platinum',
                'type' => 1,
                'description' => '3 Lokasi, 50 Edit Foto, Video Behind the Scene, File Original GDrive',
                'price' => 950000,
                'photo' => 'images/product/prewed_platinum.jpg',
            ],
            [
                'product_category_id' => '0197a4be-d74b-715f-9f39-b4b664993a35',
                'name' => 'Family Bronze',
                'type' => 1,
                'description' => '1 Background Set, 6 Pose dan File Edit, 6 Print Foto, Maksimal 6 Orang, File Kirim Gdrive',
                'price' => 280000,
                'photo' => 'images/product/family_bronze.jpg',
            ],
            [
                'product_category_id' => '0197a4be-d74b-715f-9f39-b4b664993a35',
                'name' => 'Family Gold',
                'type' => 1,
                'description' => '2 Background Set, 8 Pose dan File Edit, 8 Print Foto, Maksimal 8 orang, File Kirim GDrive',
                'price' => 500000,
                'photo' => 'images/product/family_gold.jpg',
            ],
            [
                'product_category_id' => '0197a4be-d74b-715f-9f39-b4b664993a35',
                'name' => 'Family Platinum',
                'type' => 1,
                'description' => '2 Background Set, 10 Pose dan File Edit, 10 Print Foto, Maksimal 12 Orang, File Kirim GDrive',
                'price' => 750000,
                'photo' => 'images/product/family_platinum.jpg',
            ],
            [
                'product_category_id' => '0197a4be-d74e-7343-9cb9-b330d5b4a626',
                'name' => 'Personal Bronze',
                'type' => 1,
                'description' => '1 Background Set, 4 Pose dan File Edit, 4 Print Foto, File Kirim Gdrive',
                'price' => 150000,
                'photo' => 'images/product/personal_bronze.jpg',
            ],
            [
                'product_category_id' => '0197a4be-d74e-7343-9cb9-b330d5b4a626',
                'name' => 'Personal Gold',
                'type' => 1,
                'description' => '2 Background Set, 6 Pose dan File Edit, 6 Print Foto, File Kirim GDrive',
                'price' => 275000,
                'photo' => 'images/product/personal_gold.jpg',
            ],
            [
                'product_category_id' => '0197a4be-d74e-7343-9cb9-b330d5b4a626',
                'name' => 'Personal Platinum',
                'type' => 1,
                'description' => '2 Background Set, 8 Pose dan File Edit, 8 Print Foto, File Kirim GDrive',
                'price' => 350000,
                'photo' => 'images/product/personal_platinum.jpg',
            ],
            [
                'product_category_id' => '0197a4be-d753-725c-968b-ab78ca14bc37',
                'name' => 'Rental Studio 2 Jam',
                'type' => 1,
                'description' => '7 Pilihan Background Studio, 4 Lighting Godox, 1 Set Softbox, 4 Lighstand, 1 Set Trigger',
                'price' => 250000,
                'photo' => 'images/product/rent_2jam.jpg',
            ],
            [
                'product_category_id' => '0197a4be-d753-725c-968b-ab78ca14bc37',
                'name' => 'Rental Studio 5 Jam',
                'type' => 1,
                'description' => '7 Pilihan Background Studio, 4 Lighting Godox, 1 Set Softbox, 4 Lighstand, 1 Set Trigger',
                'price' => 500000,
                'photo' => 'images/product/rent_5jam.jpg',
            ],
            [
                'product_category_id' => '0197a4be-d753-725c-968b-ab78ca14bc37',
                'name' => 'Rental Studio 12 Jam',
                'type' => 1,
                'description' => '7 Pilihan Background Studio, 4 Lighting Godox, 1 Set Softbox, 4 Lighstand, 1 Set Trigger',
                'price' => 1200000,
                'photo' => 'images/product/rent_12jam.jpg',
            ],
        ];

        foreach ($photoSessions as $photoSession) {
            $createPhotoSessions = PhotoSession::firstOrCreate(['code' => $photoSession['code'], 'name' => $photoSession['name'], 'type' => $photoSession['type'], 'start_time' => $photoSession['start_time'], 'end_time' => $photoSession['end_time']]);
            if($createPhotoSessions){
                foreach($products as $p){
                    Product::firstOrCreate([

                    ]);
                }
            }
        }
    }
}
