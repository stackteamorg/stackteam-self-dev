<?php

namespace App\Console\Commands;

use App\Models\Image;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageUploader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    
    protected $signature = 'image:upload 
                          {path : Path to the image file}
                          {--model= : The model type (e.g., Article, Product)}
                          {--model-id= : The ID of the model}
                          {--imageable-type= : The full class name for polymorphic relation}
                          {--imageable-id= : The ID for polymorphic relation}
                          {--alt= : Alternative text for the image}
                          {--is-primary : Set as primary image}
                          {--create-thumbnail : Create thumbnail version}
                          {--interactive : Ask for missing parameters interactively}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload an image and store its information in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $imagePath = $this->argument('path');
        
        // Check if file exists
        if (!file_exists($imagePath)) {
            $this->error("File not found: {$imagePath}");
            return 1;
        }

        // Validate required parameters
        if (!$this->option('imageable-type') && !$this->option('model') || 
            !$this->option('imageable-id') && !$this->option('model-id')) {
            $this->error("You must provide either --imageable-type and --imageable-id OR --model and --model-id parameters");
            return 1;
        }

        try {
            // Get file information
            $originalFilename = basename($imagePath);
            $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
            $mimeType = mime_content_type($imagePath);
            $size = filesize($imagePath);

            // Generate unique filename
            $filename = Str::uuid() . '.' . $extension;
            
            // Initialize image manager
            $manager = new ImageManager(new Driver());
            
            // Load and process image
            $image = $manager->read($imagePath);
            
            // Store original image
            $storagePath = 'public/images/' . $filename;
            Storage::put($storagePath, $image->toJpeg());

            // Create database record with default values
            $imageData = [
                'filename' => $filename,
                'original_filename' => $originalFilename,
                'mime_type' => $mimeType,
                'size' => $size,
                'path' => 'images/' . $filename,
                'alt_text' => $this->option('alt'),
                'is_primary' => $this->option('is-primary', false),
                'is_thumbnail' => false
            ];

            // Set polymorphic relationship
            // First check for direct imageable type and id
            if ($this->option('imageable-type') && $this->option('imageable-id')) {
                $imageData['imageable_type'] = $this->option('imageable-type');
                $imageData['imageable_id'] = $this->option('imageable-id');
                $this->info("Using direct imageable type: {$imageData['imageable_type']}");
            } 
            // Fallback to model and model-id
            elseif ($this->option('model') && $this->option('model-id')) {
                $imageData['imageable_type'] = 'App\\Models\\' . $this->option('model');
                $imageData['imageable_id'] = $this->option('model-id');
                $this->info("Using model-based imageable type: {$imageData['imageable_type']}");
            }

            // Create and save the image model
            $imageModel = new Image($imageData);
            $imageModel->save();

            // Create thumbnail if requested
            if ($this->option('create-thumbnail')) {
                $thumbnailFilename = 'thumb_' . $filename;
                $thumbnail = $manager->read($imagePath);
                $thumbnail->scale(width: 300);
                
                $thumbnailPath = 'public/images/' . $thumbnailFilename;
                Storage::put($thumbnailPath, $thumbnail->toJpeg());

                // Create thumbnail record
                $thumbnailData = [
                    'filename' => $thumbnailFilename,
                    'original_filename' => $originalFilename,
                    'mime_type' => $mimeType,
                    'size' => $size,
                    'path' => 'images/' . $thumbnailFilename,
                    'alt_text' => $this->option('alt'),
                    'is_primary' => false,
                    'is_thumbnail' => true,
                    'imageable_type' => $imageData['imageable_type'],
                    'imageable_id' => $imageData['imageable_id']
                ];

                $thumbnailModel = new Image($thumbnailData);
                $thumbnailModel->save();
            }

            $this->info('Image uploaded successfully!');
            $this->info("Image ID: {$imageModel->id}");
            if ($this->option('create-thumbnail')) {
                $this->info("Thumbnail ID: {$thumbnailModel->id}");
            }

            return 0;
        } catch (\Exception $e) {
            $this->error('Error uploading image: ' . $e->getMessage());
            return 1;
        }
    }
}
