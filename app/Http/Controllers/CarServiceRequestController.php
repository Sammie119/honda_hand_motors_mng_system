<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarServiceRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class CarServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = CarServiceRequest::selectRaw("customer_id,car_no, ser_charge, engineer, sum(amount_paid) as amount_paid, service_date, service_no, user")
                    ->orderByDesc('service_id')
                    ->groupBy('customer_id', 'car_no', 'ser_charge', 'engineer', 'service_date', 'service_no', 'user')
                    ->limit(500)
                    ->get();
        return view('users.services.services_list', ['services' => $services]);
    }

    public function serviceTransactions()
    {
        $services = CarServiceRequest::orderByDesc('service_id')->limit(500)->get();
        return view('users.services.services_transactions', ['services' => $services]); 
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
            'fault' => 'required',
            'item_in_car' => 'required',
            'ser_charge' => 'required',
            'engineer' => 'required',
            'amount_paid' => 'required',
            'service_date' => 'required',
        ]);
        if($request->has('id')){
            $service = CarServiceRequest::find($request->id);

            $receipt = $service->receipt_no;

            $service_no = $service->service_no;
        } else {
            $service = new CarServiceRequest;

            $receipt = CarServiceRequest::count();
            if($receipt === 0){
                $receipt = 1;
            } else {
                $receipt = CarServiceRequest::select('receipt_no')->orderByDesc('receipt_no')->first()->receipt_no + 1;  
            }

            $service_no = time();
            
        }

        $service->customer_id = $request->customer_id;
        $service->car_no = strtoupper($request->car_no);
        $service->fault = $request->fault;
        $service->item_in_car = $request->item_in_car;
        $service->other_item_car = $request->other_item_car;
        $service->ser_charge = $request->ser_charge;
        $service->engineer = $request->engineer;
        $service->amount_paid = $request->amount_paid;
        $service->balance = (float)$request->ser_charge - (float)$request->amount_paid;
        $service->service_date = $request->service_date;
        $service->receipt_no = $receipt;//$request->receipt_no;
        $service->service_no = $service_no;//$request->service_no;
        $service->received_by = $request->received_by;
        $service->user = Auth()->user()->user_id;
        

        if($request->has('id')){
            $service->updated_by = Auth()->user()->user_id;

            $service->update();

            if($service->balance == 0){
                CarServiceRequest::where('service_no', $service->service_no)->update(array(
                    'status' => 1, 
                ));
            }

            Session::flash('success', 'Service Request Updated Successfully!!!');
            // return redirect('services')->with('success', 'Service Request Updated Successfully!!!');
        } else {
            $service->created_by = Auth()->user()->user_id;
            $service->updated_by = Auth()->user()->user_id;

            $service->save();

            if($service->balance == 0){
                CarServiceRequest::where('service_no', $service->service_no)->update(array(
                    'status' => 1, 
                ));
            }

            Session::flash('success', 'Service Request Saved Successfully!!!');
            // return redirect('services')->with('success', 'Service Request Saved Successfully!!!');
        }

        $data = json_encode([
            'customer' => Customer::find($service->customer_id),
            'service' => CarServiceRequest::selectRaw("car_no, fault, ser_charge, sum(amount_paid) as amount_paid, service_no")
                        ->where('service_no', $service->service_no)
                        ->groupBy('car_no', 'ser_charge', 'fault', 'service_no')
                        ->first(),
            'paid_amount' => $service->amount_paid,
            'receipt_no' => CarServiceRequest::select('receipt_no')->where('service_no', $service->service_no)->orderByDesc('service_id')->first()->receipt_no,
        ]);

        echo "<script type='text/javascript'>
                window.open('receipt/service/$data','','left=0,top=0,width=900,height=600,toolbar=0,scrollbars=0,status =0');
                window.location = 'service_transactions';
            </script>";
    }

    public function servicePayment(Request $request)
    {
        request()->validate([
            'amount' => 'lte:balance',
        ]);

        $servicereq = CarServiceRequest::where('service_no', $request->service_no)->first();
        // dd($servicereq);

        if($request->has('id')){
            $service = CarServiceRequest::find($request->id);

            $receipt = $service->receipt_no;
        } else {
            $service = new CarServiceRequest;
            
            $receipt = CarServiceRequest::select('receipt_no')->orderByDesc('receipt_no')->first()->receipt_no + 1;   
        }

        $service->customer_id = $servicereq->customer_id;
        $service->car_no = strtoupper($servicereq->car_no);
        $service->fault = $servicereq->fault;
        $service->item_in_car = $servicereq->item_in_car;
        $service->other_item_car = $servicereq->other_item_car;
        $service->ser_charge = $servicereq->ser_charge;
        $service->engineer = $servicereq->engineer;
        $service->amount_paid = $request->amount;
        $service->balance = (float)$servicereq->ser_charge - ((float)$request->amount_paid + (float)$request->amount);
        $service->service_date = $servicereq->service_date;
        $service->receipt_no = $receipt;//$request->receipt_no;
        $service->service_no = $request->service_no;
        $service->received_by = $request->received_by;
        $service->user = $servicereq->user;
        

        if($request->has('id')){
            $service->updated_by = Auth()->user()->user_id;

            $service->update();

            if($service->balance == 0){
                CarServiceRequest::where('service_no', $service->service_no)->update(array(
                    'status' => 1, 
                ));
            }
            Session::flash('success', 'Transaction Updated Successfully!!!');
            // return redirect('service_transactions')->with('success', 'Service Request Updated Successfully!!!');
        } else {
            $service->created_by = Auth()->user()->user_id;
            $service->updated_by = Auth()->user()->user_id;

            $service->save();

            if($service->balance == 0){
                CarServiceRequest::where('service_no', $service->service_no)->update(array(
                    'status' => 1, 
                ));
            }
            
            Session::flash('success', 'Transaction Saved Successfully!!!');
            // return redirect('service_transactions')->with('success', 'Service Request Saved Successfully!!!');
        }

        $data = json_encode([
            'customer' => Customer::find($service->customer_id),
            'service' => CarServiceRequest::selectRaw("car_no, fault, ser_charge, sum(amount_paid) as amount_paid, service_no")
                        ->where('service_no', $service->service_no)
                        ->groupBy('car_no', 'ser_charge', 'fault', 'service_no')
                        ->first(),
            'paid_amount' => $service->amount_paid,
            'receipt_no' => CarServiceRequest::select('receipt_no')->where('service_no', $service->service_no)->orderByDesc('service_id')->first()->receipt_no,
        ]);

        echo "<script type='text/javascript'>
                window.open('receipt/service/$data','','left=0,top=0,width=900,height=600,toolbar=0,scrollbars=0,status =0');
                window.location = 'service_transactions';
            </script>";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarServiceRequest  $carServiceRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($carServiceRequest)
    {
        $service = CarServiceRequest::find($carServiceRequest);

        $count = CarServiceRequest::where('service_no', $service->service_no)->count();

        if($count > 1){
            CarServiceRequest::where('service_no', $service->service_no)->update(array(
                'status' => 0, 
            ));
        }

        $service->delete();

        return back()->with('success', 'Service Request Deleted Successfully!!!');
    }

    public function getReceipt($request, $data)
    {
        $data = json_decode($data);
        return view('receipt',['request' => $request, 'data' => $data]);
    }

    public function reprintReceipt($id)
    {
        $service = CarServiceRequest::find($id);

       

        $data = json_encode([
            'customer' => Customer::find($service->customer_id),
            'service' => CarServiceRequest::selectRaw("car_no, fault, ser_charge, sum(amount_paid) as amount_paid, service_no")
                        ->where('service_no', $service->service_no)
                        ->groupBy('car_no', 'ser_charge', 'fault', 'service_no')
                        ->first(),
            'paid_amount' => $service->amount_paid,
            'receipt_no' => $service->receipt_no,
        ]);

        echo "<script type='text/javascript'>
                window.open('../receipt/service/$data','','left=0,top=0,width=900,height=600,toolbar=0,scrollbars=0,status =0');
                window.location = '../service_transactions';
            </script>";
    }
}
