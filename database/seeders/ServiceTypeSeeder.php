<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        ServiceType::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
        DB::table('service_types')->insert(
            [
                [
                    'name' => 'Digital printing',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Indoor Printing',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Lamination',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Envelope printing',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Offset printing',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Roll-up',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Poster',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Scanning',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Id card',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Business card',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Letterhead',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Banner',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Autocad Plotting',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Bill book',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Canvas',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Mug',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Canvas',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ]
            ]

        );
    }
}
