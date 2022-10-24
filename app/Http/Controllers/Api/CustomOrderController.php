<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Gsuite\GMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // api request validation
         $validator = Validator::make($request->all(), [
            'customer_name'=>'required',
            'customer_email'=>'required|email',
            'customer_phone'=>'required',
            'customer_address'=>'required',
            'order_body'=>'required'
        ]);

        // validation
        if ($validator->fails()) {
            return response()->json([
                'success'=>false,
                'message' => $validator->errors()
            ], 400);
        }

        // send mail to admin
        $data = array(
            'customer_name'=>$request->customer_name,
            'customer_email'=>$request->customer_email,
            'customer_phone'=>$request->customer_phone,
            'customer_address'=>$request->customer_address,
            'order_body'=>$request->order_body
        );

        $message = 'Name: '.$request->customer_name.'<br>';
        $message .= 'Phone: '.$request->customer_phone.'<br>';
        $message .= 'Address: '.$request->customer_address.'<br>';
        $message .= 'Order: '.$request->order_body.'<br>';
        $message .= 'Email: '.$request->customer_email.'<br>';

        $gsuite = new GMail();

        $gsuite->sendEmail(
            settings()->smtp->from,
            'New Custom Order Placed',
            $message
        );

        $gsuite->sendEmail(
            $request->customer_email,
            'Custom Placed',
            'This is to confirm receipt of your custom order. Our representative will be with you shortly. Kindly be patient'
        );

        return response()->json(['success'=>true,'message'=>'Order Sent Successfully'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
