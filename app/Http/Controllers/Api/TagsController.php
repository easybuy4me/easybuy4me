<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tag::all();

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

        $tags = Tag::create([
            'tag_name'=>$request->name
        ]);

        return response()->json([
            'success'=>true,
            'message'=>'tag added successfully',
            'data'=>$tags
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
        $tag = Tag::find($id);

        // check if product exists
        if (!$tag) {
            return response()->json(['success' => false, 'message' => 'tag not found'], 404);
        }

        return response()->json([
            'success'=>true,
            'data'=>$tag
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

        $tag = Tag::find($id);

        // check if product exists
        if (!$tag) {
            return response()->json(['success' => false, 'message' => 'tag not found'], 404);
        }

        $tag->tag_name = $request->name;

        $tag->save();

        return response()->json([
            'success'=>true,
            'message'=>'tag updated successfully',
            'data'=>$tag
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
        $tag = Tag::find($id);

        // check if product exists
        if (!$tag) {
            return response()->json(['success' => false, 'message' => 'tag not found'], 404);
        }

        $tag->delete();

        return response()->json([
            'success'=>true,
            'message'=>'tag deleted successfully',
        ]);
    }
}
