<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::orderByDesc('staff_id')->get();
        return view('admin.staff_list', ['staffs' => $staff]);
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
            'name' => 'required',
            'position' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);

        if($request->has('id')){
            $staff = Staff::find($request->id);
        } else {
            $staff = new Staff;
        }

        $staff->name = $request->name;
        $staff->position = $request->position;
        $staff->mobile = $request->mobile;
        $staff->address = $request->address;

        if($request->has('id')){
            $staff->update();

            return redirect('staffs')->with('success', 'Staff Details Updated Successfully!!');
        } else {
            $staff->save();

            return redirect('staffs')->with('success', 'Staff Details Saved Successfully!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($staff)
    {
       $staff = Staff::find($staff);

       $staff->delete();

       return redirect('staffs')->with('success', 'Staff Record Deleted Successfully!!');
    }
}
