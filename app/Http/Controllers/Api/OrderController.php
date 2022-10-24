<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::with('products')->with('deliveryAddress')->with('location')->where('user_id', $request->user()->id)->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // api request valiadtion for products
        $validator = Validator::make($request->all(), [
            'products' => 'required',
            'delivery_address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()
            ], 400);
        }

        // create order
        $order = Order::create([
            'id' => sprintf("%06d", mt_rand(1, 999999)),
            'user_id' => $request->user()->id,
            'delivery_address' => $request->delivery_address,
        ]);

        // calculate total price
        $total_price = 0;

        foreach ($request->products as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }

        // create order items
        $order->items()->createMany($request->products);

        // update order total price and delivery fee
        $order->update([
            'total_price' => $total_price,
            // 'delivery_fee' => $delivery_fee,
        ]);

        // create transaction
        $reference = 'EB4M-xx' . rand(23899873802, 12938919009);

        // create new order transaction if not exists else retrieve it
        // $transaction = $order->transaction()->firstOrCreate([
        //     'user_id' => $request->user()->id,
        //     'order_id' => $order->id,
        //     'amount' => $order->total_amount,
        //     'status' => 'pending',
        //     'id' => $reference,
        // ]);

        // send notification to admin
        // $gsuite = new GMail();

        // $gsuite->sendEmail(
        //     settings()->smtp->from,
        //     'New Order Placed',
        //     'A new order with the id'. $order->id .'has been placed.'
        // );


        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            // 'data' => $transaction
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get order details
        $order = Order::with('products')->with('deliveryAddress')->with('location')->find($id);

        // check if order exists
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ], 201);
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
        // api validation for order
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        //update order
        $order = Order::find($id);

        // check if order exists
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        // update order
        $order->update($request->all());

        return response()->json([
            'success' => false,
            'message' => 'Order updated successfully'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //cancel order
        $order = Order::find($id);

        // check if order exists
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        // cancel order
        $order->update([
            'status' => 'cancelled'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order cancelled successfully'
        ], 201);
    }
}
