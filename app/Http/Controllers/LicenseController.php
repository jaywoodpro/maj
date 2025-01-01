<?php

namespace App\Http\Controllers;

use App\Models\Product\License;
use App\Models\Product\ProductLabel;
use App\Models\Product\TradingBot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LicenseController extends Controller
{
    public function checkLicense(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'account_number' => 'required',
            'label' => 'required',
            'type' => 'required|in:indicator,bot',
        ]);

        // احراز هویت کاربر
        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['invalid' => 'The login information is incorrect.'], 401);
        }

        //dd($user->licenses);

        // یافتن لیبل
        $labelRecord = ProductLabel::where('title', $data['label'])
            ->where('type',$data['type'])
            ->first();

        if (!$labelRecord) {
            return response()->json(['forbidden' => 'This product is no longer supported by Modern Andishan.'], 404);
        }

        // یافتن لایسنس
        $license = License::where('user_id', $user->id)
            ->where('label_id', $labelRecord->id)
            ->where('is_live',false)
            ->first();

        if ($license) {
            $expired = now()->greaterThan($license->expiration_date);
            return response()->json([
                'exists' => true,
                'expired' => $expired,
                'active' => (bool)$license->is_active,
                'expiration_date' => $license->expiration_date->toDateString(),
            ]);
        } else {
            return response()->json(['exists' => false]);
        }
    }

    public function createLicense(Request $request)
    {

        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'account_number' => 'required',
            'label' => 'required',
            'type' => 'required|in:indicator,bot',
            'account_type' => 'required',
            'application_name' => 'required',
            'user_nickname' => 'required',
            'broker_name' => 'required',
            'is_live' => 'required|boolean',
        ]);

        // احراز هویت کاربر
        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['invalid' => 'The login information is incorrect.'], 401);
        }

        // یافتن لیبل
        $labelRecord = ProductLabel::where('title', $data['label'])
            ->where('type',$data['type'])
            ->first();
        if (!$labelRecord) {
            return response()->json(['forbidden' => 'This product is no longer supported by Modern Andishan.'], 404);
        }

        $license = License::where('user_id', $user->id)
            ->where('label_id', $labelRecord->id)
            ->where('is_live',false)
            ->first();

        if($license){
            return response()->json(['exists' => true], 404);
        }else{
            $license = License::create([
                'user_id' => $user->id,
                'label_id' => $labelRecord->id,
                'type' => $data['type'],
                'key' => Str::random(16),
                'application_name' => $data['application_name'],
                'user_nickname' => $data['user_nickname'], // مقدار user_nickname
                'account_number' => $data['account_number'],
                'account_type' => $data['account_type'],
                'broker_name' => $data['broker_name'],
                'is_live' => $data['is_live'],
                'is_active' => true,
                'expiration_date' => now()->addDays(14),
            ]);
            $tradingBot = TradingBot::where('label_id', $labelRecord->id)->first();

            if ($tradingBot) {
                $license->tradingBots()->attach($tradingBot->id, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            return response()->json([
                'success' => true,
                'active' => true,
                'expiration_date' => $license->expiration_date->toDateString()
            ]);
        }
    }

}
