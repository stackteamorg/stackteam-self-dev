<?php

namespace App\Http\Controllers;

use App\Models\Brief as BriefModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Brief extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('brief');
    }

    /**
     * Store a new brief in the database.
     */
    public function store(Request $request)
    {
        // Validate form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|min:10|max:20|regex:/^[0-9\+\-\(\)]+$/',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create new brief
        BriefModel::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'message' => $request->message,
            'ip_address' => $request->ip(),
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'اطلاعات شما با موفقیت ثبت شد. به زودی با شما تماس خواهیم گرفت.');
    }
}
