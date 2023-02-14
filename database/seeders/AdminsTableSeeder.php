<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Samuel Gerges',
            'email' => 'admin@gmail.com',
            'password' => bcrypt("sasa"),
        ]);
    }
}
