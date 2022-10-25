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
        $sup = SupplyReceived::selectRaw('supply_no, supplier_id, amount, total_amount, sum(paid) as paid, receipt_no')->orderByDesc('supply_id')->groupBy('supply_no', 'supplier_id','amount','total_amount','receipt_no')->limit(1000)->get();
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
        request()->validate([
            'supplier_id' => 'required',
            'items_id' => 'required',
            'old_stock' => 'required',
            'new_stock' => 'required',
            'amount' => 'required',
            'total_amount' => 'required',
            'amount_paid' => 'required',
        ]);
        //  dd($request->all());
        if($request->has('id')){
            $sup = SupplyReceived::find($request->id);

            foreach ($sup->item_id as $key => $item_id) {
                $this->updateItemStock($item_id, $sup->new_stock[$key], 'Substract');
            }

        } else {
            $sup = new SupplyReceived;
        }

        $sup->supplier_id = $request->supplier_id;
        $sup->item_id = $request->items_id;
        $sup->old_stock = $request->old_stock;
        $sup->new_stock = $request->new_stock;
        $sup->amount = $request->amount;
        $sup->total_amount = $request->total_amount;
        $sup->paid = $request->amount_paid;
        $sup->receipt_no = $request->receipt_no;
        $sup->sup_date = $request->sup_date;
        $sup->supply_no = time();

        if($request->has('id')){
            $sup->updated_by = Auth()->user()->user_id;

            $sup->update();

            foreach ($request->items_id as $key => $item_id) {
                $this->updateItemStock($item_id, $request->new_stock[$key], 'Add');
            }
            
            return back()->with('success', 'Restock Updated Successfully!!!');
        } else {
            $sup->created_by = Auth()->user()->user_id;
            $sup->updated_by = Auth()->user()->user_id;

            $sup->save();

            foreach ($request->items_id as $key => $item_id) {
                $this->updateItemStock($item_id, $request->new_stock[$key], 'Add');
            }

            return back()->with('success', 'Restock Saved Successfully!!!');
        }
    }

    public function supplyPayment(Request $request)
    {
        // dd($request->all());

        $supply = SupplyReceived::where('supply_no', $request->id)->first();

        // dd($supply);
    
        $sup = new SupplyReceived;

        $sup->supplier_id = $supply->supplier_id;
        $sup->item_id = $supply->item_id;
        $sup->old_stock = $supply->old_stock;
        $sup->new_stock = $supply->new_stock;
        $sup->amount = $supply->amount;
        $sup->total_amount = $supply->total_amount;
        $sup->receipt_no = $supply->receipt_no;
        $sup->created_by = Auth()->user()->user_id;
        $sup->updated_by = Auth()->user()->user_id;

        $sup->paid = $request->amount;
        $sup->sup_date = $request->sup_date;
        $sup->supply_no = $request->id;

        $sup->save();

        return back()->with('success', 'Payment Made Successfully!!!');
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

        $count = SupplyReceived::where('supply_no', $sup->supply_no)->count();

        if($count >= 2){
            return back()->with('error', 'Deleting this record cannot be done!!!');
        }

        foreach ($sup->item_id as $key => $item_id) {
            $this->updateItemStock($item_id, $sup->new_stock[$key], 'Substract');
        }

        $sup->delete();

        return back()->with('success', 'Restock Deleted Successfully!!!');
    }

    public function destroyPayment($id)
    {
        $sup = SupplyReceived::find($id);

        $sup->delete();

        return back()->with('success', 'Payment Deleted Successfully!!!');
    }
}
