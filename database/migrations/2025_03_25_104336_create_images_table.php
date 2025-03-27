<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('filename'); // Image filename
            $table->string('path')->nullable(); // Image storage path
            $table->string('original_filename')->nullable(); // Original filename
            $table->string('mime_type')->nullable(); // File type
            $table->integer('size')->nullable(); // File size (bytes)
            $table->enum('imageable_type', ['App\Models\Article', 'App\Models\User']); // Model name (target table)
            $table->unsignedBigInteger('imageable_id'); // Record ID in target table
            $table->string('alt_text')->nullable(); // Alternative text
            $table->timestamps();
            
            // Create index for polymorphic relationship
            $table->index(['imageable_type', 'imageable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
