<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call the Category seeder to seed categories
        $this->call(CategorySeeder::class);
        
        // You can add more seeders here as needed
    }
}