<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CreateCategory extends Command
{
/**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new category to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ask user for category details
        $name = $this->ask('Enter the category name');
        $title = $this->ask('Enter the category title');
        $description = $this->ask('Enter the category description (optional)', null);
        $icon = $this->ask('Enter the category icon (optional)', null);
        
        // Ask user to select the language
        $lang = $this->choice('Select the category language', ['fa' => 'Persian', 'en' => 'English'], 'fa');
        
        // Validate user input
        $validator = Validator::make([
            'name' => $name,
            'title' => $title,
            'slug' => Str::slug($name),
            'description' => $description,
            'icon' => $icon,
        ], [
            'name' => 'required|string|unique:categories,name|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'unique:categories,slug',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ]);

        // If validation fails, show errors and stop execution
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return;
        }

        // Create new category record in the database
        $category = Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'title' => $title,
            'description' => $description,
            'icon' => $icon,
            'lang' => $lang,
        ]);

        // Display success message with category details
        $this->info("Category has been added successfully! 🚀");
        $this->info("Category ID: #{$category->id}");
        $this->info("Category Name: {$category->name}");
    }
}
