<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This method creates the 'article_tags' pivot table which establishes a many-to-many relationship
     * between articles and tags. Each article can have multiple tags and each tag can be associated with multiple articles.
     */
    public function up(): void
    {
        Schema::create('article_tags', function (Blueprint $table) {
            // Foreign key to the articles table
            $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();
            
            // Foreign key to the tags table
            $table->foreignId('tag_id')->constrained('tags')->cascadeOnDelete();
            
            // Composite primary key to ensure each article-tag pair is unique
            $table->primary(['article_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     * This method drops the 'article_tags' table if it exists.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_tags');
    }
};