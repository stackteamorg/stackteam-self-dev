<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateCategory extends Command
{

    protected $signature = 'category:create'; // Define the Artisan command signature

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new category using Artisan CLI'; // Description of the command
    protected $categoryService;


    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
