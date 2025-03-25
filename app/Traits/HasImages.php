<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\UploadedFile;

trait HasImages
{
    /**
     * رابطه چندتایی با مدل Image
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * دریافت تصویر اصلی
     *
     * @return \App\Models\Image|null
     */
    public function getPrimaryImage(): ?Image
    {
        return $this->images()->where('is_primary', true)->first();
    }

    /**
     * دریافت تصویر بندانگشتی
     *
     * @return \App\Models\Image|null
     */
    public function getThumbnail(): ?Image
    {
        return $this->images()->where('is_thumbnail', true)->first();
    }

    /**
     * افزودن تصویر جدید به مدل
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @param bool $isPrimary
     * @param string|null $altText
     * @return \App\Models\Image|null
     */
    public function addImage(UploadedFile $file, string $path = 'images', bool $isPrimary = false, ?string $altText = null): ?Image
    {
        return Image::upload($file, get_class($this), $this->id, $path, $isPrimary, $altText);
    }

    /**
     * افزودن تصویر اصلی (primary) به مدل
     * این متد تصویرهای قبلی را از حالت primary خارج می‌کند
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @param string|null $altText
     * @return \App\Models\Image|null
     */
    public function addPrimaryImage(UploadedFile $file, string $path = 'images', ?string $altText = null): ?Image
    {
        // ابتدا تمام تصاویر اصلی را از حالت اصلی خارج می‌کنیم
        $this->images()->where('is_primary', true)->update(['is_primary' => false]);
        
        // سپس تصویر جدیدی را به عنوان تصویر اصلی اضافه می‌کنیم
        return $this->addImage($file, $path, true, $altText);
    }

    /**
     * ایجاد یک تصویر thumbnail از روی تصویر اصلی
     *
     * @param int $width
     * @param int $height
     * @param string|null $path
     * @return \App\Models\Image|null
     */
    public function createThumbnail(int $width = 200, int $height = 200, ?string $path = null): ?Image
    {
        $primaryImage = $this->getPrimaryImage();
        
        if (!$primaryImage) {
            return null;
        }
        
        return $primaryImage->resize($width, $height, $path);
    }

    /**
     * حذف تمام تصاویر مرتبط با این مدل
     *
     * @return bool
     */
    public function deleteAllImages(): bool
    {
        $images = $this->images;
        
        foreach ($images as $image) {
            // حذف فایل تصویر از دیسک
            $filePath = storage_path('app/' . $image->full_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            
            // حذف رکورد تصویر
            $image->delete();
        }
        
        return true;
    }
} 