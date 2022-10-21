<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\User;
use App\Models\Staff;
use App\Models\Customer;
use App\Models\CustomSetup;
use Illuminate\Http\Request;
use App\Models\CarServiceRequest;
use App\Models\Expenditure;
use App\Models\Item;
use App\Models\StoresTransaction;
use App\Models\Supplier;

class FormRequestController extends Controller
{
    public function getCreateModalData($data)
    {
        switch ($data) {
            case 'new_user':
                return view('forms.input-forms.user_form');
                break;

            case 'user_profile':
                return view('forms.input-forms.user_profile');
                break;

            case 'new_custom':
                return view('forms.input-forms.custom_type_form');
                break;

            case 'new_staff':
                return view('forms.input-forms.staff_form');
                break;

            case 'new_customer':
                return view('forms.input-forms.customer_form');
                break;

            case 'new_service':
                return view('forms.input-forms.service_request_form');
                break;

            case 'new_rent':
                return view('forms.input-forms.rent_form');
                break;

            case 'new_expenditure':
                return view('forms.input-forms.expenditure_form');
                break;

            case 'new_supplier':
                return view('forms.input-forms.supplier_form');
                break;

            case 'new_item':
                return view('forms.input-forms.item_form');
                break;

            case 'new_transaction':
                $item = Item::orderByDesc('item')->get();
                return view('forms.input-forms.transaction_form', ['items' => $item]);
                break;

            default:
                return "No Form Selected";
                break;
        }
    }

   public function getEditModalData($data, $id)
   {
        switch ($data) {
            case 'edit_user':
                $user = User::find($id);
                return view('forms.input-forms.user_form', ['user' => $user]);
                break;

            case 'edit_custom':
                $custom = CustomSetup::find($id);
                return view('forms.input-forms.custom_type_form', ['custom' => $custom]);
                break;

            case 'edit_staff':
                $staff = Staff::find($id);
                return view('forms.input-forms.staff_form', ['staff' => $staff]);
                break;

            case 'edit_customer':
                $customer = Customer::find($id);
                return view('forms.input-forms.customer_form', ['customer' => $customer]);
                break;

            case 'edit_service':
                $service = CarServiceRequest::find($id);
                $customer = Customer::where('car_no', $service->car_no)->first();
                return view('forms.input-forms.service_request_form', ['service' => $service, 'customer' => $customer]);
                break;

            case 'service_payment':
                $service = CarServiceRequest::selectRaw("customer_id, car_no, fault, ser_charge, engineer, sum(amount_paid) as amount_paid, service_date, service_no")
                            ->where('service_no', $id)
                            ->groupBy('customer_id', 'car_no', 'ser_charge', 'engineer', 'fault', 'service_date', 'service_no')
                            ->first();
                $customer = Customer::where('car_no', $service->car_no)->first();
                return view('forms.input-forms.service_payment_form', ['service' => $service, 'customer' => $customer]);
                break;

            case 'edit_service_payment':
                $amount = CarServiceRequest::select('amount_paid', 'service_no', 'service_id', 'updated_at')->where('service_id', $id)->first();
                $service = CarServiceRequest::selectRaw("customer_id, car_no, fault, ser_charge, engineer, sum(amount_paid) as amount_paid, service_date, service_no")
                            ->where('service_no', $amount->service_no)
                            ->groupBy('customer_id', 'car_no', 'ser_charge', 'engineer', 'fault', 'service_date', 'service_no')
                            ->first();
                $customer = Customer::where('car_no', $service->car_no)->first();
                return view('forms.input-forms.service_payment_form', ['service' => $service, 'customer' => $customer, 'amount' => $amount]);
                break;

            case 'edit_rent':
                $rent = Rent::find($id);
                return view('forms.input-forms.rent_form', ['rent' => $rent]);
                break;

            case 'edit_expenditure':
                $exp = Expenditure::find($id);
                return view('forms.input-forms.expenditure_form', ['expenditure' => $exp]);
                break;

            case 'edit_supplier':
                $sup = Supplier::find($id);
                return view('forms.input-forms.supplier_form', ['supplier' => $sup]);
                break;

            case 'edit_item':
                $item = Item::find($id);
                return view('forms.input-forms.item_form', ['item' => $item]);
                break;

            case 'edit_transaction':
                $trans = StoresTransaction::find($id);
                $item = Item::orderByDesc('item')->get();
                return view('forms.input-forms.transaction_form', ['transaction' => $trans, 'items' => $item]);
                break;

            case 'store_payment':
                $trans = StoresTransaction::where('invoice_no', $id)->get();
                $balance = (float)$trans->first()->total_amount - $trans->sum('amount_paid');

                // dd($balance);
                if($balance == 0){
                    return 'Full Payment Made';
                }
                return view('forms.input-forms.stores_payment_form', ['transaction' => $trans]);
                break;
        
            default:
                return "No Form Selected";
                break;
        }
   }
   
   
   public function getViewModalData($data, $id)
   {
        switch ($data) {
            case 'view_service':
                $services = CarServiceRequest::where('service_no', $id)->get();
                return view('forms.view-data.service_payment', ['services' => $services]);
                break;
        
            default:
                return "No Form Selected";
                break;
        }
    }

    public function getDeleteModalData($data, $id)
    {
        switch ($data) {
            case 'delete_user':
                return view('forms.delete-forms.delete_user', ['id' => $id]);
                break;

            case 'delete_custom':
                return view('forms.delete-forms.delete_custom', ['id' => $id]);
                break;

            case 'delete_staff':
                return view('forms.delete-forms.delete_staff', ['id' => $id]);
                break;

            case 'delete_customer':
                return view('forms.delete-forms.delete_customer', ['id' => $id]);
                break;

            case 'delete_service':
                return view('forms.delete-forms.delete_service', ['id' => $id]);
                break;

            case 'delete_rent':
                return view('forms.delete-forms.delete_rent', ['id' => $id]);
                break;

            case 'delete_expenditure':
                return view('forms.delete-forms.delete_expenditure', ['id' => $id]);
                break;

            case 'delete_supplier':
                return view('forms.delete-forms.delete_supplier', ['id' => $id]);
                break;

            case 'delete_item':
                return view('forms.delete-forms.delete_item', ['id' => $id]);
                break;

            case 'delete_transaction':
                return view('forms.delete-forms.delete_transaction', ['id' => $id]);
                break;

            case 'delete_transaction_receipt':
                return view('forms.delete-forms.delete_transaction_receipt', ['id' => $id]);
                break;
        
            default:
                return "No Form Selected";
                break;
        }
    }
}
