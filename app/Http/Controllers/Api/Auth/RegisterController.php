<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Refferrals;
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
        // api request valiadtion for products
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email'=>'nullable|unique:users',
            'password' => 'required|confirmed',
            'phone_number_one'=>'required',
            'phone_number_two'=>'nullable',
            'contact_name'=>'required',
            'operation_days'=>'required'
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
            'isRefered'=> $request->referral_code ? 1:0,
            'phone_number'=>$request->phone_number_one
        ]);

        Wallet::create([
            'user_id'=>$user->id
        ]);

        $user->assignRole('vendor');

        Vendor::create([
            'user_id'=>$user->id,
            'operation_day'=>json_encode($request->operation_days),
            'address'=>$request->address,
            'phone_number2'=>$request->phone_number_two,
            'contact_name'=>$request->contact_name
        ]);

        $payment = Payment::create([
            'user_id'=>$user->id,
            'amount'=>'0.00'
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
            'data' => $user,
            'payment'=>$payment,
            "token"=>$token,
        ], 201);
    }
}
