<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class EditCategories extends Command
{
    protected $signature = 'categories:edit {id} {name}';
    protected $description = 'Edit an existing category';

    public function handle()
    {
        $id = $this->argument('id');
        $name = $this->argument('name');

        $category = Category::find($id);

        if (!$category) {
            $this->error('Category not found.');
            return 1;
        }

        $category->name = $name;
        $category->save();

        $this->info('Category updated successfully.');
        return 0;
    }
}