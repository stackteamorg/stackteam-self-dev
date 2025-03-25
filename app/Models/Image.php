<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Image extends Model
{
    use HasFactory;

    /**
     * فیلدهای مجاز برای تغییر دسته‌جمعی
     *
     * @var array
     */
    protected $fillable = [
        'filename',
        'path',
        'original_filename',
        'mime_type',
        'size',
        'imageable_type',
        'imageable_id',
        'is_thumbnail',
        'is_primary',
        'alt_text',
    ];

    /**
     * فیلدهای با نوع متنی که باید به boolean تبدیل شوند
     *
     * @var array
     */
    protected $casts = [
        'is_thumbnail' => 'boolean',
        'is_primary' => 'boolean',
    ];

    /**
     * رابطه با مدل‌های مختلف که می‌توانند تصویر داشته باشند
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * آدرس کامل تصویر را برمی‌گرداند
     *
     * @return string
     */
    public function getFullPathAttribute(): string
    {
        return $this->path . '/' . $this->filename;
    }

    /**
     * تغییر اندازه تصویر با استفاده از پکیج Intervention Image
     *
     * @param int $width
     * @param int $height
     * @param string|null $destinationPath
     * @param string|null $newFilename
     * @return \App\Models\Image|null
     */
    
    public function resize(int $width, int $height, string $destinationPath = null, string $newFilename = null): ?self
    {
        try {
            $manager = new ImageManager(new Driver());
            
            // بارگذاری تصویر
            $img = $manager->read(storage_path('app/' . $this->full_path));
            
            // تغییر اندازه تصویر
            $img->resize($width, $height);
            
            // تعیین نام فایل جدید
            $filename = $newFilename ?? 'thumb_' . $this->filename;
            
            // تعیین مسیر ذخیره
            $path = $destinationPath ?? $this->path;
            $fullPath = storage_path('app/' . $path . '/' . $filename);
            
            // ذخیره تصویر
            $img->save($fullPath);
            
            // ایجاد رکورد جدید برای تصویر thumbnail
            return self::create([
                'filename' => $filename,
                'path' => $path,
                'original_filename' => $this->original_filename,
                'mime_type' => $this->mime_type,
                'size' => filesize($fullPath),
                'imageable_type' => $this->imageable_type,
                'imageable_id' => $this->imageable_id,
                'is_thumbnail' => true,
                'is_primary' => false,
                'alt_text' => $this->alt_text,
            ]);
        } catch (\Exception $e) {
            Log::error('Error resizing image: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * آپلود تصویر و ایجاد رکورد جدید
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $model
     * @param int $modelId
     * @param string $path
     * @param bool $isPrimary
     * @param string|null $altText
     * @return \App\Models\Image|null
     */
    public static function upload($file, string $model, int $modelId, string $path = 'images', bool $isPrimary = false, ?string $altText = null): ?self
    {
        try {
            // ایجاد نام فایل یکتا
            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // ذخیره فایل
            $file->storeAs($path, $filename);
            
            // ایجاد رکورد در دیتابیس
            return self::create([
                'filename' => $filename,
                'path' => $path,
                'original_filename' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'imageable_type' => $model,
                'imageable_id' => $modelId,
                'is_thumbnail' => false,
                'is_primary' => $isPrimary,
                'alt_text' => $altText,
            ]);
        } catch (\Exception $e) {
            Log::error('Error uploading image: ' . $e->getMessage());
            return null;
        }
    }
}
