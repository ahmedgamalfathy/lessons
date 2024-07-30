<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\Tag as TagResource;
class TagController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->except(['index','show']);
      }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tag=TagResource::collection(Tag::all());
         return response()->json($tag, 200)->header('Additional Header' ,'True');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $tag= new TagResource(Tag::create($request->all()));
            return response()->json($tag, 200)->header('Additional Header' ,'True');
        } catch (\Throwable $th) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tag = new TagResource(Tag::findOrFail($id));
        return response()->json($tag, 200)->header('Additional Header','True');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tag= new LessonResource(Tag::findOrFail($id));
        $tag->update($request->all());
        return response()->json($tag, 200)->header('Additional Header','True');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       Tag::findOrFail($id)->delete();
       return 204;
    }
}
