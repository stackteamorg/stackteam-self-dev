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
            $table->string('filename'); // نام فایل تصویر
            $table->string('path')->nullable(); // مسیر ذخیره تصویر
            $table->string('original_filename')->nullable(); // نام اصلی فایل
            $table->string('mime_type')->nullable(); // نوع فایل
            $table->integer('size')->nullable(); // حجم فایل (بایت)
            $table->enum('imageable_type', ['Article', 'User']); // نام مدل (جدول مقصد)
            $table->unsignedBigInteger('imageable_id'); // شناسه رکورد در جدول مقصد
            $table->string('alt_text')->nullable(); // متن جایگزین
            $table->timestamps();
            
            // ایجاد ایندکس برای رابطه polymorphic
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
