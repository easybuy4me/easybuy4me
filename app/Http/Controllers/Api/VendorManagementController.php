<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = User::role('vendor')->get();

        return response()->json(['success'=>true,'data'=>$vendors],201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        $vendor = Vendor::where('user_id',$id)->first();

        $operation_days = json_decode($vendor->operation_day);

        $data = [
            'name'=>$user->name,
            'address'=>$vendor->address,
            'email'=>$user->email,
            'phone_number'=>$user->phone_number,
            'phone_number2'=>$vendor->phone_number2,
            'operation_days'=>$operation_days,
            'contact_person_name'=>$vendor->contact_person,
            'paid'=>$user->paid
        ];

        return response()->json(['message'=>'true','data'=>$data],201);
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
