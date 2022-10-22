<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ReturnItems;
use Illuminate\Http\Request;

class ReturnItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = ReturnItems::orderByDesc('return_id')->get();

        $item = Item::all();
        $item_array = [];
        foreach ($item as $item) {
            $item_array[] = $item->item;
        }
        
        return view('users.stores.return_items', ['items' => $items, 'item_array' => $item_array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        request()->validate([
            'car_no' => 'required|max:10|exists:stores_transactions,car_no',
            'invoice_no' => 'required|exists:stores_transactions,invoice_no',
            'items_list' => 'required',
            'quantity' => 'required',
        ]);

        // dd($request->all());
        $item = new ReturnItems;

        $item->customer_id = $request->customer_id;
        $item->car_no = $request->car_no;
        $item->items = $request->items_list;
        $item->quantity = $request->quantity;
        $item->unit_price = $request->unit_price;
        $item->total_amount = array_sum($request->amount);
        $item->invoice_no = $request->invoice_no;
        $item->transaction_date = $request->trans_date;
        $item->created_by = Auth()->user()->user_id;
        $item->updated_by = Auth()->user()->user_id;

        $item->save();

        foreach ($request->items_list as $key => $item) {
                
            $this->updateItemStock($this->getItemId($item), $request->quantity[$key], 'Add');
        }
        
        return back()->with('success', 'Items Returned Saved Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnItems  $returnItems
     * @return \Illuminate\Http\Response
     */
    public function destroy($returnItems)
    {
        $getitem = ReturnItems::find($returnItems);

        foreach ($getitem->items as $key => $item) {
                
            $this->updateItemStock($this->getItemId($item), $getitem->quantity[$key], 'Substract');
        }

        $getitem->delete();

        return back()->with('success', 'Items Returned Deleted Successfully!!!');
    }
}
