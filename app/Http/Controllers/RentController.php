<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rents = Rent::orderByDesc('rent_id')->get();
        return view('users.services.rent_episodes', ['rents' => $rents]);
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
        if($request->has('id')){
            $rent = Rent::find($request->id);
        } else {
            $rent = new Rent;
        }

        $rent->master_id = $request->master_id;
        $rent->amount = $request->amount;
        $rent->month_year = $request->month. ', '.$request->year;
        $rent->rent_date = $request->rent_date;
        
        if($request->has('id')){
            $rent->updated_by = Auth()->user()->user_id;

            $rent->update();

            return back()->with('success', 'Rent Updated Successfully');
        } else {
            $rent->created_by = Auth()->user()->user_id;
            $rent->updated_by = Auth()->user()->user_id;

            $rent->save();

            return back()->with('success', 'Rent Saved Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy($rent)
    {
        $rent = Rent::find($rent);

        $rent->delete();
        
        return back()->with('success', 'Rent Deleted Successfully');
    }
}
