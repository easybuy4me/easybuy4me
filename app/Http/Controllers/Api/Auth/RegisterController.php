<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Refferrals;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    function register(Request $request)
    {
        // api request valiadtion for products
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email'=>'nullable|unique:users',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'id'=>mt_rand(11111,99999),
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'isRefered'=> $request->referral_code ? 1:0
        ]);

        Wallet::create([
            'user_id'=>$user->id
        ]);

        $user->assignRole('customer');

        if($request->referral_code)
        {
            Refferrals::create([
                'user_id'=>$user->id,
                'parent_id'=>$request->referral_code
            ]);
        }

        $token = $user->createToken('AUTH-TOKEN')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'registered successfully',
            "token"=>$token,
            'data' => $user
        ], 201);
    }

    function vendorRegister(Request $request)
    {
        $setting = Setting::find(1);

        // api request valiadtion for products
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email'=>'nullable|unique:users',
            'password' => 'required|confirmed',
            'phone_number'=>'required',
            'phone_number2'=>'nullable',
            'contact_person'=>'required',
            'operation_days'=>'nullable',
            'address'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'=>false,
                'message' => json_encode($validator->errors())
            ], 422);
        }

        // check if referral exist
        if($request->referral_code)
        {
            $parent = User::find($request->referral_code);

            if(!$parent)
            {
                return response()->json([
                    'success'=>false,
                    'message'=>'invalid referral code'
                ], 422);
            }
        }

        $user = User::create([
            'id'=>mt_rand(11111,99999),
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'isRefered'=> $request->referral_code ? 1:0,
            'phone_number'=>$request->phone_number
        ]);

        Wallet::create([
            'user_id'=>$user->id
        ]);

        $user->assignRole('vendor');

        Vendor::create([
            'user_id'=>$user->id,
            'operation_day'=>json_encode($request->operation_days),
            'address'=>$request->address,
            'phone_number2'=>$request->phone_number2,
            'contact_person'=>$request->contact_person
        ]);

        $reference = 'EB4M-xx' . rand(23899873802, 12938919009);

       $transaction = Transaction::create([
        'id'=>$reference,
        'user_id'=>$user->id,
        'amount'=>$setting->vendor_payment_amount,
        'type'=>'vendor',
       ]);

        if($request->referral_code)
        {
            Refferrals::create([
                'user_id'=>$user->id,
                'parent_id'=>$request->referral_code
            ]);
        }

        $token = $user->createToken('AUTH-TOKEN')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'vendor registered successfully',
            'user' => $user,
            'transaction'=>$transaction,
            "token"=>$token,
        ], 201);
    }
}
