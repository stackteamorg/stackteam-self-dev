<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class TagCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:tag';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new tag to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ask user for tag details
        $name = $this->ask('Enter the tag name');
        $title = $this->ask('Enter the tag title');
        $description = $this->ask('Enter the tag description (optional)', null);
        $icon = $this->ask('Enter the tag icon (optional)', null);
                
        // Validate user input
        $validator = Validator::make([
            'name' => $name,
            'title' => $title,
            'slug' => Str::slug($name),
            'description' => $description,
            'icon' => $icon,
        ], [
            'name' => 'required|string|unique:tags,name|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'unique:tags,slug',
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

        // Create new tag record in the database
        $tag = Tag::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'title' => $title,
            'description' => $description,
            'icon' => $icon,
        ]);

        // Display success message with tag details
        $this->info("Tag has been added successfully!");
        $this->info("Tag ID: #{$tag->id}");
        $this->info("Tag Name: {$tag->name}");
    }
}
