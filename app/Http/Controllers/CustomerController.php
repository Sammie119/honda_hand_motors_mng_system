<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderByDesc('customer_id')->get();
        return view('users.services.customer_list', ['customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'car_no' => 'required|max:10',
            'customer_name' => 'required',
            'driver_name' => 'required',
            'car_model' => 'required',
            'fuel' => 'required',
            'customer_contact' => 'required',
            'driver_contact' => 'required',
        ]);

        if($request->has('id')){
            $customer = Customer::find($request->id);
        } else {
            $customer = new Customer;
        }
        
        $customer->car_no = $request->car_no;
        $customer->customer_name = $request->customer_name;
        $customer->driver_name = $request->driver_name;
        $customer->car_model = $request->car_model;
        $customer->fuel = $request->fuel;
        $customer->customer_contact = $request->customer_contact;
        $customer->driver_contact = $request->driver_contact;

        if($request->has('id')){
            $customer->update();

            return redirect('customers')->with('success', 'Customer Updated Successfully!!!');
        } else {
            $customer->save();

            return redirect('customers')->with('success', 'Customer Saved Successfully!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($customer)
    {
        $customer = Customer::find($customer);

        $customer->delete();

        return redirect('customers')->with('success', 'Customer Deleted Successfully!!!');
    }
}
