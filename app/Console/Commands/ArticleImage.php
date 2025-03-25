<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class ArticleImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:image
                          {--path= : Path to the image file}
                          {--article-id= : ID of the article to attach the image to}
                          {--alt= : Alternative text for the image}
                          {--debug : Show detailed debug information}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload an image for an article using the API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get or ask for the image path
        $imagePath = $this->option('path');
        if (!$imagePath) {
            $imagePath = $this->ask('Enter the path to the image file');
        }

        // Check if file exists
        if (!File::exists($imagePath)) {
            $this->error("File not found: {$imagePath}");
            return 1;
        }

        // Validate file is an image
        $mimeType = mime_content_type($imagePath);
        if (!str_starts_with($mimeType, 'image/')) {
            $this->error("File is not an image: {$imagePath} (Mime type: {$mimeType})");
            return 1;
        }

        // Get or ask for the article ID
        $articleId = $this->option('article-id');
        if (!$articleId) {
            $articleId = $this->ask('Enter the article ID');
        }

        // Get or ask for alt text
        $altText = $this->option('alt');
        if (!$altText) {
            $altText = $this->ask('Enter alternative text for the image (optional)', '');
        }

        $this->info('Uploading image...');
        $apiUrl = 'http://localhost:8000/api/blog/upload-image';
        
        if ($this->option('debug')) {
            $this->info("Debug info:");
            $this->info("- API URL: {$apiUrl}");
            $this->info("- Image path: {$imagePath}");
            $this->info("- Image size: " . filesize($imagePath) . " bytes");
            $this->info("- Image mime type: {$mimeType}");
            $this->info("- Article ID: {$articleId}");
            $this->info("- Alt text: {$altText}");
        }

        try {
            // Prepare multipart form data for file upload
            $response = Http::attach(
                'image', 
                file_get_contents($imagePath), 
                basename($imagePath)
            )->post($apiUrl, [
                'article_id' => $articleId,
                'alt_text' => $altText,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $this->info('Image uploaded successfully!');
                $this->info("Image ID: {$result['data']['image_id']}");
                $this->info("URL: {$result['data']['url']}");
                
                return 0;
            } else {
                $this->error('Error uploading image:');
                $this->error("Status code: " . $response->status());
                
                $responseContent = $response->body();
                $this->error("Response body: " . ($responseContent ?: 'Empty response'));
                
                if ($response->json()) {
                    $this->error(json_encode($response->json(), JSON_PRETTY_PRINT));
                }
                
                if ($this->option('debug')) {
                    $this->error("Full response object:");
                    $this->error(print_r($response, true));
                }
                
                return 1;
            }
        } catch (\Exception $e) {
            $this->error('Exception: ' . $e->getMessage());
            $this->error('Exception class: ' . get_class($e));
            $this->error('Stack trace: ' . $e->getTraceAsString());
            return 1;
        }
    }
}
