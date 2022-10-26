<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // get list of products that belong to the loggedin vendor
        $products = Product::with('images')->with('tags')->with('vendor')->where('user_id', $request->user()->id)->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // api request valiadtion
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'images' => 'required',
            'tags' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        // create product
        $form_data = array(
            'id' => mt_rand(11111, 99999),
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
            'user_id' => $request->user()->id,
            'category_id' => $request->category
        );

        $data = Product::create($form_data);

        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $uploadedFileUrl = Cloudinary::upload($image->getRealPath())->getSecurePath();
                $data->images()->create([
                    'image' => $uploadedFileUrl
                ]);
            }
        }

        // create product tags
        if (count($request->tags) > 0) {
            $data->tags()->createMany($request->tags);
        }

        return response()->json([
            'success' => true,
            'data' => $data
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
        // get product
        $product = Product::with('images')->with('tags')->with('vendor')->find($id);

        // check if product exists
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product
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
        //api validation for product
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'images' => 'nullable|array',
            'images.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'tags' => 'required|array',
            // 'tags.*.name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        // get product
        $product = Product::find($id);

        // check if product exists
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        // update product
        $product->update([
            'product_name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $uploadedFileUrl = Cloudinary::upload($image->getRealPath())->getSecurePath();
                $product->images()->create([
                    'image' => $uploadedFileUrl
                ]);
            }
            // update product images
            $product->images()->delete();
        }

        // update product tags
        if (count($request->tags) > 0) {
            $product->tags()->delete();

            $product->tags()->createMany($request->tags);
        }

        return response()->json([
            'success' => true,
            'data' => $product
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
        //delete product
        $product = Product::find($id);

        // check if product exists
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ], 201);
    }
}
