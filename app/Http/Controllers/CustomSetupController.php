<?php

namespace App\Http\Controllers;

use App\Models\CustomSetup;
use Illuminate\Http\Request;

class CustomSetupController extends Controller
{
    public function index()
    {
        $custom = CustomSetup::orderBy('custom_type')->get();
        return view('admin.custom_types', ['customs' => $custom]);
    }

    public function store(Request $request)
    {
        if($request->has('id')){
            $custom = CustomSetup::find($request->id);
        } else {
            $custom = new CustomSetup;
        }
        
        $custom->custom_type = $request->custom_type;
        $custom->custom_name = $request->custom_name;

        if($request->has('id')){
            $custom->update();

            return redirect('custom_setups')->with('success', 'Custom Type Updated Successfully!!!');
        } else {
            $custom->save();

            return redirect('custom_setups')->with('success', 'Custom Type Saved Successfully!!!');
        }
        
    }

    public function destroy($id)
    {
        $custom = CustomSetup::find($id);

        $custom->delete();

        return redirect('custom_setups')->with('success', 'Custom Type Deleted Successfully!!!');
    }
}
