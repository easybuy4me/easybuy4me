<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AddressBook;
use Faker\Provider\ar_EG\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $address = AddressBook::where('user_id',$request->user()->id)->get();

        return response()->json([
            'success'=>true,
            'data'=>$address
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
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        $addressbook = AddressBook::create([
            'user_id'=>$request->user()->id,
            'address'=>$request->address,
            'is_default'=>$request->is_primary == "on" ? 1 : 0
        ]);


        return response()->json([
            'success'=>true,
            'message'=>'addreess book added successfully',
            'data'=>$addressbook
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get product
        $addressbook = AddressBook::find($id);

        // check if product exists
        if (!$addressbook) {
            return response()->json(['success' => false, 'message' => 'Address not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $addressbook
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
        // api request valiadtion for products
        $validator = Validator::make($request->all(), [
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

         // get product
         $addressbook = AddressBook::find($id);

         // check if product exists
         if (!$addressbook) {
             return response()->json(['success' => false, 'message' => 'Address not found'], 404);
         }

         $addressbook->address = $request->addres;
         $addressbook->is_default = $request->is_primary == "on"? 1:0;
         $addressbook->save();

         return response()->json([
            'success'=>true,
            'message'=>'addreess book updated successfully',
            'data'=>$addressbook
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // get product
         $addressbook = AddressBook::find($id);

         // check if product exists
         if (!$addressbook) {
             return response()->json(['success' => false, 'message' => 'Address not found'], 404);
         }

         $addressbook->delete();

         return response()->json([
            'success'=>true,
            'message'=>'address deleted successfully',
        ]);
    }
}
