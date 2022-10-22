<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\SupplyReceived;

class SupplyReceivedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sup = SupplyReceived::orderByDesc('supply_id')->limit(1000)->get();
        return view('users.stores.supplies_received', ['supplies' => $sup]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(time());
        if($request->has('id')){
            $sup = SupplyReceived::find($request->id);

            $this->updateItemStock($sup->item_id, $sup->new_stock, 'Substract');

        } else {
            $sup = new SupplyReceived;
        }

        $sup->supplier_id = $request->supplier_id;
        $sup->item_id = $this->getItemId($request->item);
        $sup->old_stock = $request->old_stock;
        $sup->new_stock = $request->new_stock;
        $sup->amount = $request->amount;
        $sup->paid = $request->amount_paid;
        $sup->receipt_no = $request->receipt_no;
        $sup->sup_date = $request->sup_date;
        $sup->supply_no = time();

        if($request->has('id')){
            $sup->updated_by = Auth()->user()->user_id;

            $sup->update();

            $this->updateItemStock($this->getItemId($request->item), $request->new_stock, 'Add');

            return back()->with('success', 'Restock Updated Successfully!!!');
        } else {
            $sup->created_by = Auth()->user()->user_id;
            $sup->updated_by = Auth()->user()->user_id;

            $sup->save();

            $this->updateItemStock($this->getItemId($request->item), $request->new_stock, 'Add');

            return back()->with('success', 'Restock Saved Successfully!!!');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplyReceived  $supplyReceived
     * @return \Illuminate\Http\Response
     */
    public function destroy($supplyReceived)
    {
        $sup = SupplyReceived::find($supplyReceived);

        $this->updateItemStock($sup->item_id, $sup->new_stock, 'Substract');

        $sup->delete();

        return back()->with('success', 'Restock Deleted Successfully!!!');
    }
}
