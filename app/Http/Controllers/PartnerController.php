<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function newItem(Request $request){

        $item = new Item();
        $item->name = $request->get('name');
        $item->description = $request->get('description');
        $user = auth()->user();
        $item->user()->associate( $user);

        if ($item->save())
            return response()->json(['data'=>$item], 201);

        return response()->json(['data'=>null, 'message'=>'Item not created'], 401);

    }

    public function updateItem(Request $request, $itemId){

        try {
            $item = Item::findOrFail($itemId);
        }catch (\Exception $exception)
        {
            return response()->json(['message' => 'Item not found'], 401);
        }
        foreach ($request->all() as $key => $value)
        {
            $item[$key] = $value;
        }

        if ($item->save())
            return response()->json(['data'=> $item], 200);

        return response()->json(['message'=> "Item can't be updated"], 401);

    }

    public function itemList(){
        return response()->json(['data'=>Item::all()->where('user_id', auth()->user()->id)]);
    }

    public function itemDetails($id){
        try {
            $item = Item::findOrFail($id);

            if ($item->isOwnedBy(auth()->user()->id))
                return response()->json(['data'=>$item], 200);

            return response()->json(['message' => 'Item not found'], 400);
        }catch (\Exception $exception)
        {
            return response()->json(['message' => 'Item not found'], 401);
        }
    }

    public function deleteItem($id){
        try {
            $item = Item::findOrFail($id);
            if ($item->isOwnedBy(auth()->user()->id))
            {
                if (Item::destroy($item->id))
                    return response()->json(['message'=>['Item deleted successfully']], 202);

                return response()->json(['message'=>['An error has occured, try later']], 401);
            }
            return response()->json(['message' => 'Item not found'], 400);
        }catch (\Exception $exception)
        {
            return response()->json(['message' => 'Item not found'], 400);
        }
    }
}
