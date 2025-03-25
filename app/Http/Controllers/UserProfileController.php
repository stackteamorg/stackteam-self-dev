<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{
    /**
     * آپلود تصویر پروفایل کاربر
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadProfileImage(Request $request)
    {
        // اعتبارسنجی درخواست
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'image' => 'required|image|max:5120', // حداکثر 5 مگابایت
            'alt_text' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // دریافت کاربر
            $user = User::findOrFail($request->user_id);
            
            // دریافت فایل آپلود شده
            $uploadedFile = $request->file('image');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $mimeType = $uploadedFile->getMimeType();
            $size = $uploadedFile->getSize();
            $extension = $uploadedFile->getClientOriginalExtension();
            
            // ایجاد نام فایل یکتا
            $filename = Str::uuid() . '.' . $extension;
            
            // ذخیره تصویر اصلی
            $uploadedFile->storeAs('profile-user', $filename);
            
            // ایجاد رکورد تصویر
            $imageModel = new Image([
                'filename' => $filename,
                'original_filename' => $originalFilename,
                'mime_type' => $mimeType,
                'size' => $size,
                'path' => 'profile-user/' . $filename,
                'alt_text' => $request->alt_text,
            ]);

        
            
            // حذف تصویر پروفایل قبلی (اگر وجود داشته باشد)
            if ($user->profileImage) {
                Storage::delete($user->profileImage->path);
                $user->profileImage->delete();
            }
            
            
            // ارتباط با کاربر
            // حذف استفاده از رابطه polymorphic اتوماتیک
            // $user->profileImage()->save($imageModel);
            
            // ذخیره دستی با نام کامل کلاس
            $imageModel->imageable_type = 'App\\Models\\User';
            $imageModel->imageable_id = $user->id;
            $imageModel->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Profile image uploaded successfully',
                'data' => [
                    'image_id' => $imageModel->id,
                    'user_id' => $user->id,
                    'filename' => $filename,
                    'url' => asset('storage/profile-user/' . $filename),
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error uploading profile image',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 