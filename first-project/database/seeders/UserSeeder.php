<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\user;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      user::create([
        'name' => 'md nayem',
        'phone' => '01751805060',
        'email' => 'nayemtp@gmail.com',
        'city' => 'dhaka'
      ]);
    }
}
