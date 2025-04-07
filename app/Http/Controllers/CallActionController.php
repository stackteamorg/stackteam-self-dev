<?php

namespace App\Http\Controllers;

use App\Models\CallAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CallActionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // اعتبارسنجی داده‌های ورودی
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string|min:10|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'شماره موبایل معتبر نیست',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // ذخیره شماره موبایل در دیتابیس
            CallAction::create([
                'mobile' => $request->mobile,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'درخواست همکاری شما با موفقیت ثبت شد. به زودی با شما تماس خواهیم گرفت.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'مشکلی در ثبت درخواست شما پیش آمد. لطفا دوباره تلاش کنید.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
