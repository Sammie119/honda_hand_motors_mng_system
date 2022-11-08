<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exp = Expenditure::orderByDesc('exp_id')->get();
        return view('users.services.expenditures_list', ['expenditures' => $exp]);
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
            $exp = Expenditure::find($request->id);
        } else {
            $exp = new Expenditure;
        }

        $exp->details = $request->details;
        $exp->portfolio = $request->portfolio;
        $exp->amount = $request->amount;
        $exp->exp_date = $request->exp_date;
        $exp->engineer = $request->engineer;
        $exp->car_no = $request->car_no;
        
        if($request->has('id')){
            $exp->updated_by = Auth()->user()->user_id;

            $exp->update();

            return back()->with('success', 'Expenditure Updated Successfully!!!');
        } else {
            $exp->created_by = Auth()->user()->user_id;
            $exp->updated_by = Auth()->user()->user_id;

            $exp->save();

            return back()->with('success', 'Expenditure Saved Successfully!!!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function destroy($expenditure)
    {
        $exp = Expenditure::find($expenditure);

        $exp->delete();

        return back()->with('success', 'Expenditure Deleted Successfully!!!');
    }
}
