<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supp = Supplier::orderByDesc('supplier_id')->get();
        return view('users.stores.suppliers', ['suppliers' => $supp]);
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
            $sup = Supplier::find($request->id);
        } else {
            $sup = new Supplier;
        }
        

        $sup->supplier_name = $request->supplier_name;
        $sup->address = $request->address;
        $sup->contact = $request->contact;
        $sup->item_supply = $request->item_supply;

        if($request->has('id')){
            $sup->update();

            return back()->with('success', 'Supplier updated Successfully!!!');
        } else {
            $sup->save();

            return back()->with('success', 'Supplier added Successfully!!!');
        }
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($supplier)
    {
        $sup = Supplier::find($supplier);

        $sup->delete();
        
        return back()->with('success', 'Supplier Deleted Successfully');
    }
}
