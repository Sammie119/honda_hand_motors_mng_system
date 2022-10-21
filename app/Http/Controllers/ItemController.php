<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderByDesc('item_id')->get();
        return view('users.stores.items', ['items' => $items]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('id')){
            $item = Item::find($request->id);
        } else {
            $item = new Item;
        }
        $item->item = $request->item;
        $item->stock = $request->stock;
        $item->price = $request->price;

        if($request->has('id')){
            $item->update();

            return back()->with('success', 'Item Updated Successfully');
        } else {
            $item->save();

            return back()->with('success', 'Item Added Successfully');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($item)
    {
        $item = Item::find($item);

        $item->delete();
        
        return back()->with('success', 'Item Deleted Successfully');
    }
}
