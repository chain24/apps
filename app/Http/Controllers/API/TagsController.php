<?php

namespace App\Http\Controllers\API;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function getTags(Request $request)
    {
        $keyword = $request->get('search');
        if ($keyword == null || $keyword == ''){
            $tags = Tag::all();
        }else{
            $tags = Tag::where('name','like', $keyword.'%')->get();
        }
        return response()->json($tags);
    }
}
