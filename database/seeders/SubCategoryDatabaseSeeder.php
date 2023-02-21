<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class SubCategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(20)->create([
            'parent_id' => $this->getRandomParentID()
        ]);
    }

    private function getRandomParentID()
    {
        return Category::inRandomOrder()->first();
    }
}
