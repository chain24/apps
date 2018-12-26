<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCafeRequest;
use App\Models\Cafe;
use App\Utilities\GaodeMaps;
use App\Utilities\Tagger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CafesController extends Controller
{
    /*
     |-------------------------------------------------------------------------------
     | Get All Cafes
     |-------------------------------------------------------------------------------
     | URL:            /api/v1/cafes
     | Method:         GET
     | Description:    Gets all of the cafes and brewMethods in the application
    */
    public function getCafes()
    {
        $cafes = Cafe::with('brewMethods')->get();
        return response()->json($cafes);
    }
    /*
     |-------------------------------------------------------------------------------
     | Get An Individual Cafe
     |-------------------------------------------------------------------------------
     | URL:            /api/v1/cafes/{id}
     | Method:         GET
     | Description:    Gets an individual cafe and brewMethod
     | Parameters:
     |   $id   -> ID of the cafe we are retrieving
    */
    public function getCafe($id)
    {
        $cafe = Cafe::where('id', '=', $id)->with('brewMethods')->withCount('userLike')->withCount('likes')->with('tags')->first();
        return response()->json($cafe);
    }
    /*
     |-------------------------------------------------------------------------------
     | Adds a New Cafe
     |-------------------------------------------------------------------------------
     | URL:            /api/v1/cafes
     | Method:         POST
     | Description:    Adds a new cafe to the application
    */
    public function postNewCafe(StoreCafeRequest $request)
    {
        //已添加的咖啡店
        $addedCafes = [];
        //所有位置信息
        $locations = $request->input('locations');

        //总店
        $parentCafe = new Cafe();
        $parentCafe->name     = $request->get('name');
        //分店位置信息
        $parentCafe->location_name  = $locations[0]['name']?:'';
        $parentCafe->address     = $locations[0]['address'];
        $parentCafe->city     = $locations[0]['city'];
        $parentCafe->state    = $locations[0]['state'];
        $parentCafe->zip      = $locations[0]['zip'];
        $coordinates = GaodeMaps::geocodeAddress($parentCafe->address,$parentCafe->city,$parentCafe->state);
        $parentCafe->latitude       = $coordinates['lat'];
        $parentCafe->longitude      = $coordinates['lng'];
        $parentCafe->roaster        = $request->input('roaster') ? 1 : 0;
        $parentCafe->description = $request->input('description') ?: '';
        $parentCafe->website = $request->input('website') ?: '';
        $parentCafe->added_by = $request->user()->id;
        $parentCafe->save();
        //冲泡方法
        $brewMethods = $locations[0]['methodsAvailable'];
        //标签信息
        $tags = $locations[0]['tags'];
        //保存咖啡店的所有的冲泡方法
        $parentCafe->brewMethods()->sync($brewMethods);
        Tagger::tagCafe($parentCafe,$tags,Auth::user()->id);
        //保存已添加的咖啡店信息
        array_push($addedCafes,$parentCafe->toArray());
        // 第一个索引的位置信息已经使用，从第 2 个位置开始
        if (count($locations) > 1) {
            // 从索引值 1 开始，以为第一个位置已经使用了
            for ($i = 1; $i < count($locations); $i++) {
                // 其它分店信息的获取和保存，与总店共用名称、网址、描述、烘焙师等信息，其他逻辑与总店一致
                $cafe = new Cafe();

                $cafe->parent = $parentCafe->id;
                $cafe->name = $request->input('name');
                $cafe->location_name = $locations[$i]['name'] ?: '';
                $cafe->address = $locations[$i]['address'];
                $cafe->city = $locations[$i]['city'];
                $cafe->state = $locations[$i]['state'];
                $cafe->zip = $locations[$i]['zip'];
                $coordinates = GaodeMaps::geocodeAddress($cafe->address, $cafe->city, $cafe->state);
                $cafe->latitude = $coordinates['lat'];
                $cafe->longitude = $coordinates['lng'];
                $cafe->roaster = $request->input('roaster') != '' ? 1 : 0;
                $cafe->website = $request->input('website');
                $cafe->description = $request->input('description') ?: '';
                $cafe->added_by = $request->user()->id;
                $cafe->save();

                $cafe->brewMethods()->sync($locations[$i]['methodsAvailable']);
                Tagger::tagCafe($cafe,$locations[$i]['tags'],Auth::user()->id);
                array_push($addedCafes, $cafe->toArray());
            }
        }
        return response()->json($addedCafes, 201);
    }
    public function postLikeCafe($cafeID)
    {
       $cafe = Cafe::where('id','=',$cafeID)->with('likes')->first();
       $cafe->likes()->attach(Auth::user()->id,[
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now(),
       ]);
       return response()->json(['cafe_liked' => true],201);
    }
    public function deleteLikeCafe($cafeID)
    {
        $cafe = Cafe::where('id','=',$cafeID)->with('likes')->first();
        $cafe->likes()->detach(Auth::user()->id);
        return response(null,204);
    }
    public function postAddTags(Request $request,$cafeID)
    {
        $tags = $request->input('tags');
        $cafe = Cafe::find($cafeID);
        Tagger::tagCafe($cafe,$tags,Auth::user()->id);
        $cafe = Cafe::where('id','=',$cafeID)->with('brewMethods')->with('userLike')->with('tags')->first();
        return response()->json($cafe,201);
    }
    public function deleteCafeTag($cafeID,$tagID)
    {
        DB::table('cafes_users_tags')
            ->where('cafe_id','=', $cafeID)
            ->where('tag_id','=',$tagID)
            ->where('user_id','=',Auth::user()->id)
        ->delete();
        return response(null,204);
    }
}
