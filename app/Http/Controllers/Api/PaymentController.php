<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Gsuite\GMail;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Refferrals;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    function callback()
    {
        $settings = Setting::first();

        $status = request()->status;

        if ($status == "cancelled") {
            return response()->json(['success' => false, 'message' => 'Payment Cancelled'], 402);
        } else if ($status == "failed") {
            return response()->json(['success' => false, 'message' => 'Payment Failed']);
        } else if ($status == "successful") {
            $transaction = Transaction::where('id', request()->tx_ref)->first();

            $transaction->status = 1;

            $transaction->save();

            $user = User::where('id',$transaction->user_id)->first();

            if ($transaction->type == "order") {

                // get order
                $order = Order::where('id', $transaction->order_id)->first();

                // update order payment status
                $order->payment_status ="paid";

                $order->save();

                $gsuite = new GMail();

                $gsuite->sendEmail(
                    $user->email,
                    'Order recieved',
                    'Your order is place successfuly, and we are processing it. You will be notified when your order is ready for delivery.'
                );

                return response()->json(['success'=>true,'message'=>'order is completed'],201);


            } else if ($transaction->type == "vendor") {

                $user->paid = 1;
                $user->save();

                if($user->isRefered)
                {
                    // get referral
                    $referral = Refferrals::where('user_id',$user->id)->first();

                    // get parent wallet
                    $wallet = Wallet::where('user_id',$referral->parent_id)->first();

                    // update parent wallet
                    $wallet->balance = $wallet->balance + $settings->referral_bonus;
                    $wallet->save();

                    //update referral status
                    $referral->status = 1;
                    $referral->save();

                    // send mail to amdin

                }

                return response()->json(['success'=>true,'message'=>'payment is completed'],201);
            }


        }
    }
}
