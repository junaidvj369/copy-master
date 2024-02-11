<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        User::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@copymaster.com',
            'password' => Hash::make('admin@129'),
            'user_type' => '1',
            'status' => '1',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
