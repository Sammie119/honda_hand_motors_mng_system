<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CarServiceRequest;
use App\Models\Item;

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
                'customer_contact' => $car->customer_contact,
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

    public function getCarInfoServices(Request $request)
    {
        $cars = CarServiceRequest::selectRaw("customer_id, car_no, fault, ser_charge, engineer, sum(amount_paid) as amount_paid, service_date, service_no")
                    ->where('car_no', $request->car_no)
                    ->groupBy('customer_id', 'car_no', 'ser_charge', 'engineer', 'fault', 'service_date', 'service_no')
                    ->get();
        
        $car_info = json_encode($cars);

        if($cars){
            $i = 0;
            foreach ($cars as $key => $car) {
                echo '
                    <tr style="border-bottom: 1px solid;" class="tab">
                        <td>'.++$i.'</td>
                        <td>'.formatDate($car->service_date).'</td>
                        <td>'.$car->car_no.'</td>
                        <td>'.$car->customer->customer_name.'</td>
                        <td>'.$car->engineer.'</td>
                        <td>'.number_format($car->ser_charge, 2).'</td>
                        <td>'.number_format($car->amount_paid, 2).'</td>
                        <td>'.number_format(($car->ser_charge - $car->amount_paid), 2).'</td>
                    </tr>
                ';
            }

        }
        else {
            echo "
                <tr>
                    <td colspan='8'>No Data Found</td>
                </tr>
            ";
        }
        
    }

   public function getItemInfo(Request $request)
   {
        $item = Item::where('item', $request->items)->first();

        if($item){
            $results = [
                'stock' => $item->stock,
                'unit_price' => $item->price,
            ];
        }
        else{
            $results = [
                'stock' => 'No_data'
            ];
        }

        return response()->json($results);
   }
}
