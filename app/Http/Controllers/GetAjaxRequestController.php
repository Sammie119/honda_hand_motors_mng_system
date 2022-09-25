<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class GetAjaxRequestController extends Controller
{
    public function getCarInfo(Request $request)
    {
        $car = Customer::where('car_no', $request->car_no)->first();

        if($car){
            $results = [
                'car_model' => $car->car_model,
                'customer_name' => $car->customer_name,
                'driver_name' => $car->driver_name,
                'customer_id' => $car->customer_id,
                'fuel' => $car->fuel
            ];
        }
        else{
            $results = [
                'customer_id' => 'No_data'
            ];
        }

        return response()->json($results);
    }
}
