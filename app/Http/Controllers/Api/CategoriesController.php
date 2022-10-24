<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();

        return response()->json([
            'success'=>true,
            'data'=>$data
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
        $request->validate([
            'name'=>'required'
        ]);

        $Categorys = Category::create([
            'name'=>$request->name
        ]);

        return response()->json([
            'success'=>true,
            'message'=>'Category added successfully',
            'data'=>$Categorys
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
        $Category = Category::find($id);

        // check if product exists
        if (!$Category) {
            return response()->json(['success' => false, 'message' => 'Category not found'], 404);
        }

        return response()->json([
            'success'=>true,
            'data'=>$Category
        ]);
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
        $request->validate([
            'name'=>'required'
        ]);

        $Category = Category::find($id);

        // check if product exists
        if (!$Category) {
            return response()->json(['success' => false, 'message' => 'Category not found'], 404);
        }

        $Category->name = $request->name;

        $Category->save();

        return response()->json([
            'success'=>true,
            'message'=>'Category updated successfully',
            'data'=>$Category
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
        $Category = Category::find($id);

        // check if product exists
        if (!$Category) {
            return response()->json(['success' => false, 'message' => 'Category not found'], 404);
        }

        $Category->delete();

        return response()->json([
            'success'=>true,
            'message'=>'Category deleted successfully',
        ]);
    }
}
